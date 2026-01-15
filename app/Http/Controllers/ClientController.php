<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('clients');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Client::datatable();
        }

        return view('pages.clients.index');
    }

    public function create()
    {
        // precompute next code so the form can show it automatically
        $code = Client::generateNewCode();
        return view('pages.clients.create', compact('code'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'npwp' => 'required|string|max:50',
            'pic_name' => 'required|string|max:100',
            'pic_phone' => 'nullable|string|max:50',
            'pic_email' => 'nullable|email|max:100',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        // store id of currently authenticated user as creator
        if ($request->user()) {
            $data['created_by'] = $request->user()->id;
        }

        Client::create($data);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('pages.clients.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('pages.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'npwp' => 'required|string|max:50',
            'pic_name' => 'required|string|max:100',
            'pic_phone' => 'nullable|string|max:50',
            'pic_email' => 'nullable|email|max:100',
            'description' => 'nullable|string',
        ]);

        $client = Client::findOrFail($id);
        $data = $request->all();
        if ($request->user()) {
            $data['updated_by'] = $request->user()->id;
        }
        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
