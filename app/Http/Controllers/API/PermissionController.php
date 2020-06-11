<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Permission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api');    
    }

    public function index()
    {
        // abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return Permission::all();
    }

    public function store(StorePermissionRequest $request)
    {
        $request['guard_name'] = 'web';

        return Permission::create($request->all());
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
    }

    public function countPermissions()
    {
        return count(Permission::all());
    }
}
