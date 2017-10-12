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
        
        $breadcrumbs = [
            'title' => 'Data Maintenance',
            'child' => [
                'title' => 'Metadata'
            ]
        ];
        
        $Metadata = MetadataStore::get();
        return view('eon.roles::metadata-store', ['metadatas' => $Metadata], ['breadcrumbs' => $breadcrumbs]);
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
    
    public function update(Request $request,$id) {
            
        $validator = Validator::make($request->all(), [
                    'metadata_type' => 'required',
                    'description' => 'required',
        ]);

        if ($validator->passes()) {
            $Metadata = MetadataStore::find($id);
            $Metadata->metadata_type = $request->get('metadata_type');
            $Metadata->description = $request->get('description');
            $Metadata->classification = $request->get('classification');
            $Metadata->sequence = $request->get('sequence');
            $Metadata->save();
            return response()->json(['success'=>'Metadata has been updated successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function delete($id) {
        $Metadata = MetadataStore::find($id);
        if($Metadata->delete()){
           return response()->json(['success'=>'Metadata has been delete successfully.']); 
        }
        return response()->json(['error' => 'An error occured, please try again.']);
    }

    

}
