<?php

namespace EONConsulting\Storyline2\Transformers;

use League\Fractal\TransformerAbstract;
use EONConsulting\Storyline2\Models\Template;
use EONConsulting\Storyline2\Transformers\TemplateTransformer;

class TemplateTransformer extends TransformerAbstract
{


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Template $template = null)
    {
        
        return [
            'id' => $template['id'],
            'name' => $template['name'],
            'css' => $this->json_to_css($template['styles'])
        ];

    }

    protected function json_to_css($style_JSON){

        $style_array = json_decode($style_JSON);

        $style_string = "";

        foreach($style_array as $element => $styles){
            $style_string .= '.content-body ' . $element . ' {';

            foreach($styles as $style => $value){
                $style_string .= $style . ': ' . $value . ';';
            }

            $style_string .= '} ';
        }
        
        return $style_string;

    }

}