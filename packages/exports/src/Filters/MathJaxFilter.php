<?php

namespace EONConsulting\Exports\Filters;

use Exception;
use EONConsulting\Exports\Filters\FilterContract;
use EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler;
use EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom;

class MathJaxFilter implements FilterContract
{

    /*
     * Hold the html dom
     *
     * @var EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom
     */
    protected $html;

    /*
     * Colors to replace with defined values in the template file
     */
    protected $colors = [
        '#4E7FBB' => 'pandoc_color_1',
        '#BB8A4E' => 'pandoc_color_2',
        '#078446' => 'pandoc_color_3',
        '#9D18C2' => 'pandoc_color_4',
        '#1196b3' => 'pandoc_color_5',
    ];

    /**
     * Mathjax constructor.
     *
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->createHtmlDom($content);
    }

    /*
     * Run Filter
     */
    public function handle()
    {
        $spans = $this->getMathJax();

        foreach($spans as $span)
        {
            if($this->hasColor($span->innertext))
            {
                $span->innertext = str_replace(array_keys($this->colors), array_values($this->colors), $span->innertext);
            }
        }
    }

    /*
     * Get the assets from the html dom
     */
    protected function getMathJax()
    {
        if( ! $matjax = $this->getHtml()->find("span[class='math-tex']"))
        {
            throw new Exception('No mathjax found in content!');
        }

        return $matjax;
    }

    /**
     * Create a Html Dom and set it
     *
     * @param $content
     */
    protected function createHtmlDom($content) : MathJaxFilter
    {
        if( ! $html = HtmlHandler::strGetHtml($content))
        {
            throw new Exception('No assets found in content!');
        }

        return $this->setHtml($html);
    }

    /**
     * Set the html Dom
     *
     * @param SimpleHtmlDom $html
     * @return AssetFilter
     */
    protected function setHtml(SimpleHtmlDom $html) : MathJaxFilter
    {
        $this->html = $html;
        return $this;
    }

    /**
     * Get The html Dom
     *
     * @return SimpleHtmlDom $html
     */
    public function getHtml() : SimpleHtmlDom
    {
        return $this->html;
    }

    /*
     * Check to see if MatJax has a color var
     *
     * @param string $mathax
     * @return bool
     */
    protected function hasColor(string $mathjax) : string
    {
        return str_contains($mathjax, '\color');
    }

}