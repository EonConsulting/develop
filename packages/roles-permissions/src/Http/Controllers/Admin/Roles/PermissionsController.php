<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/20
 * Time: 5:56 PM
 */

namespace EONConsulting\RolesPermissions\Http\Controllers\Admin\Roles;


use App\Http\Controllers\Controller;
use EONConsulting\RolesPermissions\Http\Requests\StorePermissionRequest;
use EONConsulting\RolesPermissions\Http\Requests\UpdatePermissionRequest;
use EONConsulting\RolesPermissions\Models\Permission;
use Validator;
use Symfony\Component\HttpFoundation\Request;

class PermissionsController extends Controller {

    public function index() {
        $permissions = Permission::get();

        $breadcrumbs = [
            'title' => 'Permissions',
            'child' => [
                'title' => 'View'
            ]
        ];

        return view('eon.roles::permissions', ['permissions' => $permissions], ['breadcrumbs' => $breadcrumbs]);
    }

    public function show(Permission $permission) {

        $breadcrumbs = [
            'title' => 'Roles and Permissions',
            'child' => [
                'title' => 'Permissions',
                'href' => route("eon.admin.permissions"),
                'child' => [
                    'title' => $permission->name
                ]
            ]
        ];

        return view('eon.roles::permission', ['permission' => $permission], ['breadcrumbs' => $breadcrumbs]);
    }

    public function create() {

        return view('eon.roles::create-permission');
    }

    public function store(StorePermissionRequest $request) {
         $validator = Validator::make($request->all(), [
                    'name' => 'required',
        ]);

        if ($validator->passes()) {
            $crud = new Permission([
                'name' => $request->get('name')
            ]);
            $crud->save();
            return response()->json(['success'=>'Permission has been added successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function edit($id) {
        $Metadata = Permission::find($id);
        return view('eon.roles::permission-edit',['metadata' => $Metadata]);
    }

    public function update(Request $request,$id) {
            
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
        ]);

        if ($validator->passes()) {
            $Metadata = Permission::find($id);
            $Metadata->name = $request->get('name');
            $Metadata->save();
            return response()->json(['success'=>'Permission has been updated successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function delete($id) {
        $Metadata = Permission::find($id);
        if($Metadata->delete()){
           return response()->json(['success'=>'Permission has been delete successfully.']); 
        }
        return response()->json(['error' => 'An error occured, please try again.']);
    }

}
