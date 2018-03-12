<?php

namespace EONConsulting\Core\Helpers\ContentImporter;

use EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler;
use EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom;
use EONConsulting\Core\Services\HttpClient\HttpClientException;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use tidy;

use Facades\ {
    EONConsulting\Core\Services\HttpClient
};

class Importer
{
    /*
     * Store the html dom
     */
    protected $html;

    /**
     * Store a Html dom object from the provided dom class
     *
     * @param $html
     * @return \EONConsulting\Exports\Services\ContentImporter
     * @throws \Exception
     */
    public function fromDom($html)
    {
        if( ! $html instanceof SimpleHtmlDom)
        {
            throw new Exception('Dom can not be set from the input value!');
        }

        $this->html = $html;

        return $this;
    }

    /**
     * Read the content from a string and create a html dom class
     *
     * @param null $content
     * @return \EONConsulting\Exports\Services\ContentImporter
     * @throws \Exception
     */
    public function fromContent($content = null)
    {
        if(is_null($content))
        {
            throw new Exception('Content may not be null');
        }

        $this->html = HtmlHandler::strGetHtml($this->repairHtml($content));

        return $this;
    }

    /**
     * Read the content from a file and create a Html Dom class
     *
     * @param null $file
     * @return \EONConsulting\Exports\Services\ContentImporter
     * @throws \Exception
     */
    public function fromFile($file = null)
    {
        if(is_null($file))
        {
            throw new Exception('Unable to read from file!');
        }

        $content = Storage::disk('local')->get($file);

        return $this->fromContent($content);
    }

    /**
     * Read from url and create a html dom class
     *
     * @param null $url
     * @return \EONConsulting\Exports\Services\ContentImporter
     * @throws \Exception
     */
    public function fromUrl($url = null)
    {
        if(is_null($url))
        {
            throw new Exception('Url may not be null');
        }

        $content = HttpClient::get($url);

        return $this->fromContent($content);
    }

    /**
     * Make sure the content has proper html tags
     *
     * @param $content
     * @return string
     */
    public function repairHtml($content)
    {
        $tidy = new tidy();
        return $tidy->repairString($content);
    }

    /*
     * Get the page id from a html tag
     *
     *  @return string
     */
    public function getPageId()
    {
        if( ! $name = optional($this->html->find("a[class=section_anchor]", 0))->name)
        {
            return '0';
        }

        return str_after($name, 'wb_');
    }

    /*
     * Get the title from the first H3 tag
     *
     * @return string
     */
    public function getTitle()
    {
        if( ! $title = optional($this->html->find("h3[class=Heading2]", 0))->innertext)
        {
            $title = 'No Title';
        }

        return str_replace('&nbsp;', ' ', $title);
    }

    /*
     * Get the text of a link
     *
     * @param object $element
     * @return string
     */
    public function getLinkText($element)
    {
        return trim(optional($element->find('a', 0))->plaintext);
    }

    /*
     * Get the href of a link
     *
     * @param object $element
     * @return string
     */
    public function getLinkUrl($element)
    {
        return trim(optional($element->find('a', 0))->href);
    }

    /*
     * Return true if this page should be removed from the import
     *
     * @return bool
     */
    public function shouldIgnoreTopic($title)
    {
        return str_contains($title, 'instructions before proceeding');
    }

    /*
     * Remove all the classes from html tags
     *
     * @return $this
     */
    public function cleanFbnClasses()
    {
        if($tags = $this->html->find('h1, h2, h3, h4, h5, h6, table, p, div, br, span[class!=math-tex]'))
        {
            foreach($tags as $tag)
            {
                $tag->removeAttribute('class');
            }
        }

        return $this;
    }

    /*
     * Add the url onto any links that does not have it
     *
     * @return string
     */
    protected function getBaseUrl($url, $path)
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $host = parse_url($url, PHP_URL_HOST);
        $path = parse_url($path, PHP_URL_PATH);
        $path = str_replace("//", '/', $path);

        return "{$scheme}://{$host}{$path}";
    }

    /*
     * Get a collection of topics from the ul menu
     *
     * @return collection
     */
    public function getTopics()
    {
        $topics = [];

        foreach($this->html->find('div[class=col-md-12 col-sm-12] div[class=feature-wrap]') as $div)
        {
            if($heading = $div->find('h2', 0))
            {
                $heading_name = $heading->plaintext;

                $topics[$heading_name] = [
                    'name' => $heading->plaintext,
                ];

                continue;
            }

            $name = $this->getLinkText($div);
            $link = $this->getLinkUrl($div);

            if($this->shouldIgnoreTopic($name))
            {
                continue;
            }

            $topics[$heading_name]['children'][] = [
                'name' => $name,
                'link' => $link,
                'children' => self::fromUrl($link)->getMenuLinks(),
            ];
        }

        return collect($topics)->recursive();
    }

    /*
     * Get a list of the sub menu items
     *
     * @return collection
     */
    public function getMenuLinks()
    {
        $pages = [];

        $counter = 0;

        if( ! $menu_links = $this->html->find('ul[class=side_menu]', 0))
        {
            return $pages;
        }

        foreach($menu_links->children() as $li)
        {
            if($li->find('a', 0))
            {
                $pages[$counter] = [
                    'name' => $this->getLinkText($li),
                    'link' => $this->getLinkUrl($li),
                ];
            }

            foreach($li->find('ul[class=subnav] li') as $sub_ul)
            {
                if($sub_ul->find('a', 0))
                {
                    $pages[$counter]['children'][] = [
                        'name' => $this->getLinkText($sub_ul),
                        'link' => $this->getLinkUrl($sub_ul),
                    ];
                }
            }

            $counter++;
        }

        return $pages;
    }

    /*
     * Get the body of the content page
     *
     * @return string
     */
    public function getBody()
    {
        $javascript = $this->getInlineJavascript();

        $body = optional($this->html->find("div[id=activity_content]", 0))->innertext;

        $content = $body . $javascript;

        return $content;
    }

    /*
     * Get all the javascript blocks in the content
     *
     * @return string
     */
    protected function getInlineJavascript()
    {
        $javascript = [];

        foreach($this->html->find("script") as $js)
        {
            if( ! $js->hasAttribute('src'))
            {
                $code = $js->innertext;

                preg_match("/function (.*?)\(\)/", $code, $preg_match);

                $function_name = array_get($preg_match, '1');

                $javascript[$function_name] = $code;

                $js->outertext = '';
            }
        }

        $response = "<script>\n\n";

        foreach(array_flatten($javascript) as $code)
        {
            $response.= $code . "\n\n";
        }

        $response.= "</script>\n";

        return $response;
    }

    /*
     * Loop through all the assets on the page and save them and rewrite with the new file path
     */
    public function storeAssets($base_url)
    {
        foreach($this->html->find('video, img, iframe') as $asset)
        {
            $url = $this->getBaseUrl($base_url, $asset->src);

            try {

                if( ! $src = $this->saveAsset($url))
                {
                    $asset->outertext = '<img src="' . url('uploads/image/unknown-file.jpg') . '" width="350px" height="350px">';
                    continue;
                }

            } catch(\Exception $e)
            {
                $asset->outertext = '<img src="' . url('uploads/image/unknown-file.jpg') . '" width="350px" height="350px">';
                continue;
            }

            $asset->src = $src;
        }

        return $this;
    }

    /*
     * Download the asset from the remote server and store
     *
     * @return string $file_path
     */
    protected function saveAsset($url)
    {
        try {

            $content = HttpClient::download($url);

        } catch(HttpClientException $e)
        {
            return false;
        }

        $file_path = "imports/{$this->generateFolder()}/{$this->generateFilename($url)}";

        Storage::disk('uploads')->put($file_path, $content);

        return Storage::disk('uploads')->url($file_path);
    }

    /*
     * Generate a unique filename with the file extension in the url
     *
     * @return string
     */
    protected function generateFilename($url)
    {
        return Str::random(10) . "." . Str::lower(str_after(basename($url), '.'));
    }

    /*
     * Generate a folder path using the date
     *
     * @return string
     */
    protected function generateFolder()
    {
        $dt = \Carbon\Carbon::now();

        return "{$dt->year}/{$dt->day}/{$dt->hour}";
    }

    /*
     * Remove any elements that should not be imported
     */
    public function removeElements()
    {
        if($anchor = $this->html->find('a[class=section_anchor]', 0))
        {
            $anchor->outertext = '';
        }

        if($back_image = $this->html->find('div/a/img[src*=back_arrow.jpg]', 0))
        {
            $back_image->parent()->parent()->outertext = '';
        }

        if($forward_image = $this->html->find('div/a/img[src*=forward_arrow.jpg]', 0))
        {
            $forward_image->parent()->parent()->outertext = '';
        }

        return $this;
    }

    /*
     * Fetch all mathjax spans and run transformer on them
     *
     * @return \EONConsulting\Exports\Services\ContentImporter
     */
    public function fixMathJax()
    {
        if($jax = $this->html->find('span[class=math-tex]'))
        {
            array_filter($jax, array($this, 'transformMathJax'));
        }

        return $this;
    }

    /*
     * Loop through array of of values to replace mathjax with
     *
     * @return bool
     */
    protected function transformMathJax($jax)
    {
        $tex_replacements = [
            '\PalAa' => '\color{#4E7FBB}',
            '\PalAb' => '\color{#BB8A4E}',
            '\PalBa' => '\color{#1196b3}',
            '\PalBb' => '\color{#9D18C2}',
            '\PalBc' => '\color{#078446}',
            '\PalCa' => '\color{#1196b3}',
            '\PalCb' => '\color{#9D18C2}',
            '\PalCc' => '\color{#078446}',
            '\PalCd' => '\color{#4E7FBB}',
            '\Answ' => '\color{#ff0000}{\\bf #1}',
            '\Const' => '\color{#7D7D7D}{\\bf #1}',
            '\BlackText' => '\color{#000000}{\\bf #1}',
            '\Cdp' => '\text{,}',
            '\Ndp' => '\text{,}',
            '\Cur' => '\text{R}',
            '\Tsp' => '\:',
            '\begin{align}' => '',
            '\begin {align}' => '',
            '\end{align}' => '',
            '\end {align}' => '',
            '&amp;' => '',
        ];

        foreach($tex_replacements as $search => $replace)
        {
            $jax->innertext = str_replace($search, $replace, $jax->innertext);
        }

        return true;
    }

    /*
     * Return the object
     *
     */
    public function getHtmlDom()
    {
        return $this->html;
    }

    /**
     * Cleanup when done
     */
    function __destruct()
    {
        $this->html->clear();
    }
}