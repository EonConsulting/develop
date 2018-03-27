<?php

/* Author: Michael Hanekom
 * Date: 2018-03-20
 * Class to centralize all processing for alfresco rest API
 */

namespace EONConsulting\Alfresco\Rest;

use GuzzleHttp\Client;
use Log;

//use Illuminate\Support\Facades\DB;

class AlfrescoRest {

    protected $client;
    protected $config;

    public function __construct(Client $client, $config) {
        $this->client = $client;
        $this->config = $config;
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
<<<<<<< HEAD
    public function CreateFolder($parent_node_id, $nodename, $nodetype = "cm:folder", $relativepath = '') {
=======
    public function CreateFolder($parent_node_id, $nodename, $nodetype = "cm:folder", $relativepath = "") {
>>>>>>> 80d37a10a31bc918632f7d91270355fdb34388e8

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
            $parent_node_id = $this->config['base-dir-node-id'];
        }

        $params = [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $this->config['api-auth-header']
            ]
        ];

        $request_url = printf("nodes/%s/children?where=(isFolder=true)", $parent_node_id);

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

        $params = [
            'body' => $content, // can be binary, typically file contents
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $this->config['api-auth-header']
            ]
        ];

        $request_url = printf("nodes/%s/content", $node_id);

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
            'base_uri' => $this->config['api-base-url'],
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
        dd($this->config);
        $new_node_id = null;

        if (empty($parent_node_id)) {
            $parent_node_id = $this->config['base-dir-node-id'];
        }

        if (empty($relativepath)) {
            $body = [
                "name" => $nodename,
                "nodeType" => $nodetype
            ];
        } else {
            $body = [
                "name" => $nodename,
                "nodeType" => $nodetype,
                "relativePath" => $relativepath
            ];
        }

        $params = [
            'body' => $body,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $this->config['api-auth-header']
            ]
        ];

        $request_url = printf("nodes/%s/children", $parent_node_id);

        try {
            $request = $this->client->request("POST", $request_url, $params);
            $result = $request->getBody();
            $jr = json_decode($result);

            if ($jr && $jr->entry && $jr->entry->id) {
                // this is the new node id of the created folder
                $new_node_id = $jr->entry->id;
            }
        } catch (\Exception $e) {
            Log::debug($e->getMessage() . " URL: [{$request_url}]");
            throw $e;
        }

        return $new_node_id;
    }

}
