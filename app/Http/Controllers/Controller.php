<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function applyResourcePermissions()
    {
        $name = Str::of($this->getControllerName())
            ->replace('Controller', '')
            ->kebab();

        $resource = Str::plural($name);

        $this->middleware("permission:$resource.view")->only(['index', 'show']);
        $this->middleware("permission:$resource.create")->only(['create', 'store']);
        $this->middleware("permission:$resource.edit")->only(['edit', 'update']);
        $this->middleware("permission:$resource.delete")->only(['destroy']);
    }


    private function getControllerName()
    {
        return class_basename(static::class);
    }
}
