<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionException;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function sync()
    {
        $files = File::files(base_path('app/Http/Controllers/Admin'));
        $permissions = [];
        foreach ($files as $item) {
            $file = basename($item, '.php');
            $classPath = "App\Http\Controllers\Admin\\$file";
            try {
                $class = new $classPath;
                $fireClass = new ReflectionClass($class);
                foreach ($fireClass->getMethods() as $method) {
                    if ($method->class == $classPath) {
                        $permissions[] = strtolower(
                            str_replace('Controller','',$file).'_'.$method->name
                        );
                    }
                }
            } catch (ReflectionException $e) {
                return $e->getMessage();
            }
        }
        Permission::query()->delete();
        foreach ($permissions as $permission) {
            Permission::create([
                'name'=>$permission,
                'guard_name'=>'admin',
            ]);
        }

        return $permissions;
    }
}
