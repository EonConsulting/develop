<?php

/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/20
 * Time: 5:43 PM
 */

namespace EONConsulting\RolesPermissions\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use App\Models\User;
use EONConsulting\RolesPermissions\Models\Department;
use EONConsulting\RolesPermissions\Models\Group;
use EONConsulting\RolesPermissions\Models\Permission;
use EONConsulting\RolesPermissions\Models\Role;
use App\Models\MetadataStore;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Validator;

class MetadataController extends Controller {

    public function index() {
        $Metadata = MetadataStore::get();
        return view('eon.roles::metadata-store', ['metadatas' => $Metadata]);
    }

    public function create() {
        return view('eon.roles::metadata-store-create');
    }
    
    public function edit($id) {
        $Metadata = MetadataStore::find($id);
        return view('eon.roles::metadata-store-edit',['metadata' => $Metadata]);
    }

    public function save(Request $request) {

        $validator = Validator::make($request->all(), [
                    'metadata_type' => 'required',
                    'description' => 'required',
        ]);

        if ($validator->passes()) {
            $crud = new MetadataStore([
                'metadata_type' => $request->get('metadata_type'),
                'description' => $request->get('description'),
                'classification' => $request->get('classification'),
                'sequence' => $request->get('sequence')
            ]);
            $crud->save();
            return response()->json(['success'=>'Metadata has been added successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function update(User $user, Role $role, Group $group) {
        $obj = DB::table('users_roles')->where('user_id', $user->id)->where('role_id', $role->id)->where('group_id', $group->id)->first();
        if ($obj) {
            DB::table('users_roles')->where('user_id', $user->id)->where('role_id', $role->id)->where('group_id', $group->id)->delete();
        } else {
            DB::table('users_roles')->insert(['user_id' => $user->id, 'role_id' => $role->id, 'group_id' => request()->get('group_id')]);
        }

        return response()->json(['success' => true]);
    }

}
