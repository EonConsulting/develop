<?php

namespace EONConsulting\Exports\Services;

use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler;
use EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use tidy;
use Exception;

class FbnImporter
{
    protected $html;

    protected function __construct($html)
    {
        $this->html = $html;
        return $this;
    }

    /**
     * Store a Html dom object from the provided dom class
     *
     * @param $html
     * @return \EONConsulting\Exports\Services\FbnImporter
     * @throws \Exception
     */
    static public function fromDom($html)
    {
        if( ! $html instanceof SimpleHtmlDom)
        {
            throw new Exception('Dom can not be set from the input value!');
        }

        return new self($html);
    }

    /**
     * Read the content from a file and create a Html Dom class
     *
     * @param null $file
     * @return \EONConsulting\Exports\Services\FbnImporter
     * @throws \Exception
     */
    static public function fromFile($file = null)
    {
        if(is_null($file))
        {
            throw new Exception('Unable to read from file!');
        }

        $html = HtmlHandler::strGetHtml(self::repairHtml(Storage::disk('local')->get($file)));

        return new self($html);
    }

    /**
     * Read the content from a string and create a html dom class
     *
     * @param null $content
     * @return \EONConsulting\Exports\Services\FbnImporter
     * @throws \Exception
     */
    static public function fromContent($content = null)
    {
        if(is_null($content))
        {
            throw new Exception('Content may not be null');
        }

        return new self(HtmlHandler::strGetHtml(self::repairHtml($content)));
    }

    /**
     * Read from url and create a html dom class
     *
     * @param null $url
     * @return \EONConsulting\Exports\Services\FbnImporter
     * @throws \Exception
     */
    static public function fromUrl($url = null)
    {
        if(is_null($url))
        {
            throw new Exception('Url may not be null');
        }

        $content = \Cache::rememberForever(str_slug($url), function () use ($url) {
            return self::repairHtml(self::guzzleFetch($url));
        });

        $html = HtmlHandler::strGetHtml($content);

        //$html = HtmlHandler::strGetHtml(self::repairHtml(self::guzzleFetch($url)));

        return new self($html);
    }

    /**
     * Make sure the content has proper html tags
     *
     * @param $content
     * @return string
     */
    static public function repairHtml($content)
    {
        $tidy = new tidy();
        return $tidy->repairString($content);
    }



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

            $name = trim($div->find('a', 0)->plaintext);
            $link = $div->find('a', 0)->getAttribute('href');

            if(str_contains($name, 'Please click here for instructions before proceeding'))
            {
                continue;
            }

            $topics[$heading_name]['children'][] = [
                'name' => $name,
                'link' => $link,
                'children' => self::fromUrl($link)->getMenuLinks(),
            ];
        }

        return collect($topics);
    }





    public function isMainLink($element)
    {
        return str_contains($element->getAttribute('class'), 'menu-expand');
    }

    public function isSubLink($element)
    {
        return ! str_contains($element->getAttribute('class'), 'menu-expand') && str_contains($element->getAttribute('class'), 'menu-child');
    }

    public function getLinkText($element)
    {
        return trim($element->find('a', 0)->plaintext);
    }

    public function getLinkUrl($element)
    {
        return trim($element->find('a', 0)->getAttribute('href'));
    }

    protected function getPathFromLink($element, $files)
    {
        $link = $this->getLinkUrl($element);

        $path_link = $files->filter(function($file) use ($link)
        {
            $link = str_replace('../', '', $link);
            return str_contains($file, str_before($link, '?parent_id'));
        })->first();

        return $path_link;
    }

    public function getHtmlDom()
    {
        return $this->html;
    }

    public function getMenuLinks()
    {
        $pages = [];

        $counter = 0;

        foreach($this->html->find('ul[class=side_menu]', 0)->children() as $li)
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

    static public function CreateContent($params)
    {
        return Content::updateOrCreate([
            'title' => $params['title'],
            'description' => $params['title'],
            'creator_id' => 2,
        ],[
            'title' => $params['title'],
            'description' => $params['title'],
            'body' => $params['body'],
            'creator_id' => 2,
        ]);
    }















    public function getPageId()
    {
        $current = 0;

        if($current = $this->html->find("a[class=section_anchor]", 0))
        {
            $current = $current->name;
        }

        $current = str_replace('wb_', '', $current);

        return $current;
    }

    public function getBody()
    {
        $body = optional($this->html->find("div[id=activity_content]", 0))->innertext;

        $javascript = '';

        foreach($this->html->find("script") as $js)
        {
            if($js->getAttribute('src') != '')
            {
                continue;
            }

            $javascript .= $js->outertext;
        }

        $content = $body . $javascript;

        return $content;
    }

    public function getTitle()
    {
        $title = optional($this->html->find("h3[class=Heading2]", 0))->innertext;

        $title = str_replace('&nbsp;', ' ', $title);

        return $title;
    }









    protected function cleanLink($string)
    {
        $string = explode('?parent_id=', $string);

        $string = str_replace('../', '', $string[0]);

        return $string;
    }


    public function storeAssets($url)
    {
        foreach($this->html->find('video, img, iframe') as $asset)
        {
            $asset->src = $this->saveAsset($asset->src);
        }

        return $this;
    }

    protected function saveAsset($url)
    {
        if( ! array_key_exists('host', parse_url($url)))
        {
            $url = 'https://dev.unisaonline.net/' . $url;
        }

        if ( ! $stream = @fopen($url, 'r'))
        {
            return false;
        }

        $tmpFile = tempnam(sys_get_temp_dir(), 'unisa_');

        file_put_contents($tmpFile, $stream);

        $file_path = Storage::putFile('media/' . $this->createAssetFolder(), new File($tmpFile));

        @unlink($tmpFile);

        return Storage::disk('public')->url($file_path);
    }

    protected function createAssetFolder()
    {
        $dt = \Carbon\Carbon::now();

        return "{$dt->year}/{$dt->month}/{$dt->day}/{$dt->hour}";
    }


    public function removeElements()
    {
        @$this->html->find('a[class=section_anchor]', 0)->outertext = '';

        if($parent_back = $this->html->find("img[src*=back_arrow.jpg]", 0))
        {
            $parent_back->parent()->parent()->outertext = '';
        }

        if($parent_next = $this->html->find("img[src*=forward_arrow.jpg]", 0))
        {
            $parent_next->parent()->parent()->outertext = '';
        }

        return $this;
    }

    public function fixMathJax()
    {
        foreach($this->html->find('span[class=math-tex]') as $span)
        {
            $span->outertext = $this->transformMathJax($span->outertext);
        }

        return $this;
    }

    protected function transformMathJax($content)
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
            $content = str_replace($search, $replace, $content);
        }

        return $content;
    }


    static public function guzzleFetch($url)
    {
        $client = new GuzzleClient;

        try {

            $res = $client->request('GET', $url);

        } catch(\Exception $e)
        {
            \Log::debug($e->getMessage());
            return;
        }

        if($res->getStatusCode() != 200)
        {
            \Log::debug('Unable to fetch content!');
            return;
        }

        return $res->getBody();
    }








    function __destruct()
    {
        $this->html->clear();
    }
}

