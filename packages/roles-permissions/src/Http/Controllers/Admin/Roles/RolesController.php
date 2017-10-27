<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/20
 * Time: 5:49 PM
 */

namespace EONConsulting\RolesPermissions\Http\Controllers\Admin\Roles;


use App\Http\Controllers\Controller;
use EONConsulting\RolesPermissions\Http\Requests\StoreRoleRequest;
use EONConsulting\RolesPermissions\Http\Requests\UpdateRoleRequest;
use EONConsulting\RolesPermissions\Models\Permission;
use EONConsulting\RolesPermissions\Models\Role;
use Validator;
use Symfony\Component\HttpFoundation\Request;

class RolesController extends Controller {

    public function index() {
        $roles = Role::with('permissions')->with('users')->get();

        $breadcrumbs = [
            'title' => 'Roles',
            'child' => [
                'title' => 'View',
            ]
        ];

        return view('eon.roles::roles', ['roles' => $roles, 'breadcrumbs' => $breadcrumbs]);
    }

    public function show(Role $role) {
        $permissions = $role->permissions;
        $unheld = Permission::whereNotIn('id', $role->permissions()->pluck('id')->toArray())->get()->pluck('name', 'id');
        $all_permissions = Permission::get()->pluck('name', 'id');

        $breadcrumbs = [
            'title' => 'Roles and Permissions',
            'child' => [
                'title' => 'Roles',
                'href' => route("eon.admin.roles"),
                'child' => [
                    'title' => $role->name
                ]
            ]
        ];

        return view('eon.roles::role', ['role' => $role, 'permissions' => $permissions, 'unheld' => $unheld, 'all_permissions' => $all_permissions, 'breadcrumbs' => $breadcrumbs]);
    }

    public function create() {
        return view('eon.roles::create-role');
    }

    public function store(StoreRoleRequest $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
        ]);

        if ($validator->passes()) {
            $Role = new Role([
                'name' => $request->get('name')
            ]);
            
            $Role->save();
            return response()->json(['success'=>'Role has been added successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function edit($id) {
        $Role = Role::find($id);
        return view('eon.roles::role-edit',['role' => $Role]);
    }

    public function update(Request $request,$id) {
            
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
        ]);

        if ($validator->passes()) {
            $Role = Role::find($id);
            $Role->name = $request->get('name');
            $Role->description = $request->get('description');
            $Role->save();
            return response()->json(['success'=>'Role has been updated successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function delete($id) {
        $Metadata = Role::find($id);
        if($Metadata->delete()){
           return response()->json(['success'=>'Role has been delete successfully.']); 
        }
        return response()->json(['error' => 'An error occured, please try again.']);
    }

}
