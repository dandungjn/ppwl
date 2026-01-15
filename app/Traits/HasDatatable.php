<?php

namespace App\Traits;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

trait HasDatatable
{
    public static function datatable($query = null, $config = [])
    {
        $query = $query ?: static::query();

        // Default Config
        $config = array_merge([
            'index' => true,
            'action' => true,
            'extra_columns' => [], // ['country' => fn($row) => $row->country->name]
            'raw_columns' => [], // columns that should be treated as raw HTML
        ], $config);

        $datatable = DataTables::of($query);

        // Index column
        if ($config['index']) {
            $datatable->addIndexColumn();
        }

        // Extra custom columns
        foreach ($config['extra_columns'] as $key => $callback) {
            $datatable->addColumn($key, $callback);
        }

        // Action column
        if ($config['action']) {
            $datatable->addColumn('action', fn($row) => static::defaultActions($row));
        }

        // Raw columns from config (always include 'action' when action column is enabled)
        $rawCols = [];
        if ($config['action']) {
            $rawCols[] = 'action';
        }
        if (!empty($config['raw_columns'])) {
            $rawCols = array_merge($rawCols, (array) $config['raw_columns']);
        }
        if (!empty($rawCols)) {
            $datatable->rawColumns(array_values(array_unique($rawCols)));
        }

        return $datatable->make(true);
    }


    /**
     * Default actions (can be overridden in Model)
     */
    protected static function defaultActions($row)
    {
        $modelName = class_basename($row);

        $kebab = Str::kebab($modelName);

        $plural = Str::plural($kebab);

        $user = auth()->user();
        $html = '';

        $canEdit = $user->can("$plural.edit");
        $canDelete = $user->can("$plural.delete");

        if ($canEdit) {
            $editUrl = route("$plural.edit", $row->id);
            $html .= '
            <a href="' . $editUrl . '" class="h3 text-info mb-0 me-2">
                <i class="mdi mdi-pencil"></i>
            </a>
        ';
        }

        if ($canDelete) {
            $deleteUrl = route("$plural.destroy", $row->id);
            $html .= '
            <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                ' . csrf_field() . method_field('DELETE') . '
                <button type="submit" class="h3 border-0 bg-transparent text-danger mb-0 btn-confirm"
                    data-title="Delete ' . ucfirst($kebab) . '"
                    data-text="Are you sure you want to delete this ' . $kebab . '?"
                >
                    <i class="mdi mdi-delete"></i>
                </button>
            </form>
        ';
        }

        return $html ?: '-';
    }
}
