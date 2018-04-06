<?php

/* Author: Michael Hanekom
 * Date: 2018-03-20
 * Class to centralize all processing for alfresco rest API
 */

namespace EONConsulting\Alfresco\Rest;

use GuzzleHttp\Client as GuzzleClient;
use Log;

//use Illuminate\Support\Facades\DB;

class AlfrescoRest {

    protected $client;

    public function __construct(GuzzleClient $client) {
        $this->client = $client;
    }

    /*     * **************************************************************** */
    /*     * ***********  SET OF PUBLIC FUNCTIONS ************************** */

    /**
     * 
     * @param type $parent_node_id
     * @param type $filename
     * @param type $nodetype
     * @return type
     */
    public function CreateFile($parent_node_id, $filename, $nodetype = "cm:content", $relativepath = "") {
        return $this->CreateNode($parent_node_id, $filename, $nodetype, $relativepath);
    }

    /**
     * 
     * @param type $parent_node_id
     * @param type $foldername
     * @param type $relativepath
     */
    public function CreateFolder($parent_node_id, $nodename, $nodetype = "cm:folder", $relativepath = "") {

        // we can check for conflicts but this is nicer
        // check whether there is already a folder, if not create
        $folder_list = $this->GetNodeChildFolderList($parent_node_id);
        $key = array_search($nodename, array_column($folder_list, 'name'));
        if (!empty($key)) {
            $folder_node_id = $key['id'];
        } else {
            // try to recreate the node in case it does not exists
            $folder_node_id = $this->CreateNode($parent_node_id, $nodename, $nodetype, $relativepath); // this will automatically use root node
        }

        return folder_node_id;
    }

    function GetNodeChildFolderList($parent_node_id) {
        $node_list = [];

        if (empty($parent_node_id)) {
            $parent_node_id = config('alfresco.base-dir-node-id');
        }

        $params = [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => config('alfresco.api-auth-header')
            ]
        ];

        //$request_url = printf("%s/nodes/%s/children?where=(isFolder=true)", 
        //        config('alfresco.api-base-url'), $parent_node_id);
        $request_url = sprintf("nodes/%s/children?where=(isFolder=true)", $parent_node_id);

        try {
            $request = $this->client->request("GET", $request_url, $params);
            $result = $request->getBody();
            $jr = json_decode($result);

            if ($jr && $jr->list && $jr->list->entries) {
                foreach ($jr->list->entries as $en) {
                    // this is the new node id of the created folder
                    $node_list[] = [
                        "id" => $en->id,
                        "nodeType" => $en->nodeType,
                        "isFolder" => $en->isFolder,
                        "name" => $en->name
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::debug($e->getMessage() . " URL: [{$request_url}]");
        }

        return $node_list;
    }

    /**
     * 
     * @param type $node_id
     * @param type $content as a binary stream
     */
    public function UpdateContent($node_id, $content) {
        $updated_node_id = null;

        /*$params = [
            'multipart' => [
                'name' => 'somefile',
                'contents' => $content, // can be binary, typically file contents
                'filename' => 'anotherfile'
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => config('alfresco.api-auth-header')
            ]
        ];*/
        
        $params = [
            'body' => $content, // can be binary, typically file contents
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => config('alfresco.api-auth-header')
            ]
        ];

        //$request_url = sprintf("%s/nodes/%s/content", config('alfresco.api-base-url'), $node_id);
        $request_url = sprintf("nodes/%s/content", $node_id);

        try {
            $request = $this->client->request("PUT", $request_url, $params);
            $result = $request->getBody();
            $jr = json_decode($result);

            if ($jr && $jr->entry && $jr->entry->id) {
                // this is the new node id of the created folder
                $updated_node_id = $jr->entry->id;
            }
        } catch (\Exception $e) {
            Log::debug($e->getMessage() . " URL: [{$request_url}]");
        }

        return $updated_node_id;
    }

    /*     * **************************************************************** */
    /*     * ***********  SET OF PRIVATE FUNCTIONS ************************** */

    /**
     * 
     * @return Client
     */
    function CreateClient() {
        return new Client([
            // Base URI is used with relative requests
            'base_uri' => config('alfresco.api-base-url'),
            // You can set any number of default request options.
            'timeout' => 2.0, // 2 minutes
        ]);
    }

    /**
     * 
     * @param type $parent_node_id
     * @param type $nodename
     * @param type $relativepath
     */
    function CreateNode($parent_node_id, $nodename, $nodetype, $relativepath) {
        $new_node_response = null;

        if (empty($parent_node_id)) {
            $parent_node_id = config('alfresco.base-dir-node-id');
        }

        if (empty($relativepath)) {
            $json = [
                "name" => $nodename,
                "nodeType" => $nodetype
            ];
        } else {
            $json = [
                "name" => $nodename,
                "nodeType" => $nodetype,
                "relativePath" => $relativepath
            ];
        }
        
        $params = [
            'json' => $json,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => config('alfresco.api-auth-header')
            ]
        ];

        //$request_url = sprintf("%s/nodes/%s/children", config('alfresco.api-base-url'), $parent_node_id);
        $request_url = sprintf("nodes/%s/children", $parent_node_id);

        try {
            $request = $this->client->request("POST", $request_url, $params);
            $result = $request->getBody();
            $jr = json_decode($result);

            if ($jr && $jr->entry && $jr->entry->id) {
                // this is the new node id of the created folder
                $new_node_response = [
                    "id" => $jr->entry->id,
                    "code" => $request->getStatusCode()
                ];
            }
        } catch (\Exception $e) {
            if ($e->getCode() === 409) // conflict with existing node
            {
                Log::debug("Conflict : 409 : Node exists [" . $e->getMessage() . "] URL: [{$request_url}]");
                // new node id will return null and a file rename must happen
                // this is so that versioning can occur naturally
                $new_node_response = [
                    "id" => null,
                    "code" => 409
                ];
            } else {
                Log::debug($e->getMessage() . " URL: [{$request_url}]");
                throw $e;
            }
        }

        return $new_node_response;
    }

}
