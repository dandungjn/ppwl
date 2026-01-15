<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('roles');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->datatable();
        }

        return view('pages.roles.index');
    }

    public function create()
    {
        $permissions = $this->groupPermissions(Permission::all());
        return view('pages.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
        ]);
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $this->groupPermissions(Permission::all());

        return view('pages.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    private function datatable()
    {
        $query = Role::with('permissions');

        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('permissions', function ($role) {
                $groups = $role->permissions
                    ->groupBy(function ($perm) {
                        return explode('.', $perm->name)[0];
                    });

                $html = '<div class="d-flex flex-wrap gap-2">';

                foreach ($groups as $group => $perms) {

                    $actions = $perms->map(function ($p) {
                        return strtoupper(explode('.', $p->name)[1] ?? $p->name);
                    })->implode(' • ');

                    $html .= "
                        <div class='card shadow-sm' style='min-width: 120px; max-width: 100%; border-radius: 10px;'>
                            <div class='card-body p-2 bg-primary rounded'>
                                <h6 class='mb-1 text-white text-uppercase' style='font-size: 12px; font-weight: 700;'>
                                    $group
                                </h6>
                                <div style='font-size: 11px;' class='text-white'>$actions</div>
                            </div>
                        </div>
                    ";
                }

                $html .= '</div>';

                return $html;
            })

            ->addColumn('action', fn($role) => $this->actionsColumn($role))

            ->rawColumns(['action', 'permissions'])
            ->make(true);
    }

    private function actionsColumn($role)
    {
        $plural = 'roles';
        $model  = 'role';
        $html   = '';

        $canEdit   = auth()->user()->can('roles.edit');
        $canDelete = auth()->user()->can('roles.delete');

        // EDIT
        if ($canEdit) {
            $editUrl = route("$plural.edit", $role->id);
            $html .= '
            <a href="' . $editUrl . '" class="h3 text-info mb-0 me-2">
                <i class="mdi mdi-pencil"></i>
            </a>
        ';
        }

        // DELETE
        if ($canDelete) {
            $deleteUrl = route("$plural.destroy", $role->id);
            $html .= '
            <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                ' . csrf_field() . method_field('DELETE') . '
                <button type="submit"
                    class="h3 border-0 bg-transparent text-danger px-0 mb-0 btn-confirm"
                    data-title="Delete ' . ucfirst($model) . '"
                    data-text="Are you sure you want to delete this ' . $model . '?"
                >
                    <i class="mdi mdi-delete"></i>
                </button>
            </form>
        ';
        }

        return $html;
    }

    private function groupPermissions($permissions)
    {
        return $permissions->groupBy(function ($perm) {
            return explode('.', $perm->name)[0];
        });
    }
}
