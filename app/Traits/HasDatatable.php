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
            'extra_columns' => [],
            'raw_columns' => [],
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
            $datatable->addColumn('action', fn ($row) => static::defaultActions($row));
        }

        // Raw columns
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
     * Default actions
     */
    protected static function defaultActions($row)
    {
        $modelName = class_basename($row);
        $kebab = Str::kebab($modelName);
        $plural = Str::plural($kebab);

        $editUrl = route("$plural.edit", $row->id);
        $deleteUrl = route("$plural.destroy", $row->id);

        return '
            <a href="' . $editUrl . '" class="h3 text-info mb-0 me-2">
                <i class="mdi mdi-pencil"></i>
            </a>

            <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                ' . csrf_field() . method_field('DELETE') . '
                <button type="submit"
                    class="h3 border-0 bg-transparent text-danger mb-0 btn-confirm"
                    data-title="Delete ' . ucfirst($kebab) . '"
                    data-text="Are you sure you want to delete this ' . $kebab . '?"
                >
                    <i class="mdi mdi-delete"></i>
                </button>
            </form>
        ';
    }
}
