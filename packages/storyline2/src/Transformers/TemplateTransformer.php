<?php

namespace EONConsulting\Storyline2\Transformers;

use League\Fractal\TransformerAbstract;
use EONConsulting\Storyline2\Models\Template;

class TemplateTransformer extends TransformerAbstract
{


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Template $template)
    {
        $style_array = json_decode($template->styles);

        $styles = "";

        foreach($style_array as $style => $value){
            //TODO: add transformation code
        }
        
        $template->styles = $styles;

        return $template;
    }


}