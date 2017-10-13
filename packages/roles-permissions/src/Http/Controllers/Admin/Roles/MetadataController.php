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
use App\Models\MetadataType;

class MetadataController extends Controller {

    public function itemIndex() {
        
        $breadcrumbs = [
            'title' => 'Data Maintenance',
            'child' => [
                'title' => 'Metadata Items'
            ]
        ];
        
        $Metadata = MetadataStore::get();
        return view('eon.roles::metadata-item', ['metadatas' => $Metadata], ['breadcrumbs' => $breadcrumbs]);
    }

    public function createItem() {
        return view('eon.roles::metadata-store-create');
    }
    
    public function editItem($id) {
        $Metadata = MetadataStore::find($id);
        return view('eon.roles::metadata-store-edit',['metadata' => $Metadata]);
    }

    public function saveItem(Request $request) {

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
            return response()->json(['success'=>'Metadata item has been added successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function updateItem(Request $request,$id) {
            
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
            return response()->json(['success'=>'Metadata item has been updated successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function deleteItem($id) {
        $Metadata = MetadataStore::find($id);
        if($Metadata->delete()){
           return response()->json(['success'=>'Metadata item has been delete successfully.']); 
        }
        return response()->json(['error' => 'An error occured, please try again.']);
    }
    
    public function typeIndex() {
        
        $breadcrumbs = [
            'title' => 'Data Maintenance',
            'child' => [
                'title' => 'Metadata Types'
            ]
        ];
        
        $Metadata = MetadataType::get();
        return view('eon.roles::metadata-type', ['metadatas' => $Metadata], ['breadcrumbs' => $breadcrumbs]);
    }

    public function createType() {
        return view('eon.roles::metadata-type-create');
    }
    
    public function editType($id) {
        $Metadata = MetadataType::find($id);
        return view('eon.roles::metadata-type-edit',['metadata' => $Metadata]);
    }

    public function saveType(Request $request) {

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
        ]);

        if ($validator->passes()) {
            $crud = new MetadataType([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ]);
            $crud->save();
            return response()->json(['success'=>'Metadata type has been added successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function updateType(Request $request,$id) {
            
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
        ]);

        if ($validator->passes()) {
            $Metadata = MetadataType::find($id);
            $Metadata->name = $request->get('name');
            $Metadata->description = $request->get('description');
            $Metadata->save();
            return response()->json(['success'=>'Metadata type has been updated successfully.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function deleteType($id) {
        $Metadata = MetadataType::find($id);
        if($Metadata->delete()){
           return response()->json(['success'=>'Metadata type has been delete successfully.']); 
        }
        return response()->json(['error' => 'An error occured, please try again.']);
    }

    

}
