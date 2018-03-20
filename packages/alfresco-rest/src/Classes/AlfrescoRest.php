<?php

/* Author: Michael Hanekom
 * Date: 2018-03-20
 * Class to centralize all processing for alfresco rest API
 */

namespace EONConsulting\Alfresco\Rest\Classes;

use GuzzleHttp\Client;
use Log;

//use Illuminate\Support\Facades\DB;

class AlfrescoRest {

    /**
     * Alfresco config content
     * @var
     */
    protected $config;
    protected $client;

    public function __construct() {
        $this->config = config('alfresco-rest');
        $this->client = $this->CreateClient();
    }

    /*     * **************************************************************** */
    /*     * ***********  SET OF PUBLIC FUNCTIONS ************************** */

    /**
     * 
     * @return Client
     */
    public function CreateClient() {
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
     * @param type $filename
     * @param type $nodetype
     * @return type
     */
    public function CreateFile($parent_node_id, $filename, $nodetype = "cm:content") {
        return $this->CreateNode($parent_node_id, $filename, $nodetype, null);
    }

    /**
     * 
     * @param type $parent_node_id
     * @param type $foldername
     * @param type $relativepath
     */
    public function CreateFolder($parent_node_id, $nodename, $nodetype = "cm:folder", $relativepath = '') {
        return $this->CreateNode($parent_node_id, $nodename, $nodetype, $relativepath);
    }

    /**
     * 
     * @param type $node_id
     * @param type $content as a binary stream
     */
    public function UpdateContent($node_id, $content) {
        $updated_node_id = null;
        
        $params = [
            'body' => $content, // byte stream
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
     * @param type $parent_node_id
     * @param type $nodename
     * @param type $relativepath
     */
    function CreateNode($parent_node_id, $nodename, $nodetype, $relativepath) {
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
        }

        return $new_node_id;
    }

}
