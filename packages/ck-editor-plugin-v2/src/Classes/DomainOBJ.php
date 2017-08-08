<?php

/**
 * Created by PhpStorm.
 * User: Peace-N || J Harrington
 * Date: 3/27/2017
 * Time: 11:22 AM
 */

namespace EONConsulting\CKEditorPluginV2\Classes;

use EONConsulting\LaravelLTI\Models\LTIDomain;

class DomainOBJ {
    /**
     * @return array
     */
    static public function listDomains() {
        $domains_obj = LTIDomain::with('context')->with('key')->get();
        $domains = [];

        foreach($domains_obj as $domain) {

            $obj = [
                'title' => ($domain->context) ? $domain->context->title : '',
                'description' => '',
                'launch_url' => $domain->domain,
                'key' => ($domain->key) ? $domain->key->key_key : null,
                'secret' => ($domain->key) ? $domain->key->secret : null,
                'context_id' => $domain->context_id,
                'icon' => '',
                'selection_height' => '',
                'selection_width' => '',
                'logo_url' => $domain->logo_uri

            ];

            if($domain->json) {
                $xml = json_decode($domain->json, true);

                if($xml) {
                    $arr = (array) $xml;

//                    dd($arr);

                    foreach ($arr as $innerarr){
//                        dd($arr);

                        if(array_key_exists('bltidescription', $innerarr)) {
                            if($innerarr['bltidescription']) {
                                $obj['description'] = $innerarr['bltidescription'];
                            }
                        }

                        if(array_key_exists('bltidescription', $innerarr)) {
                            if($innerarr['bltidescription']) {
                                $obj['description'] = $innerarr['bltidescription'];
                            }
                        }

                        if(array_key_exists('selection_height', $innerarr)) {
                            if($innerarr['selection_height']) {
                                $obj['selection_height'] = $innerarr['selection_height'];
                            }
                        }

                        foreach ($innerarr as $key=>$value) {

                            if (str_contains($key, 'selection_height')) {
                                $obj['selection_height'] = $value;
                                $selection_height = $obj['selection_height'];
                            }
                        }

                    }


                }
            }

            $domains[] = $obj;
        }
        return $domains;
    }

}