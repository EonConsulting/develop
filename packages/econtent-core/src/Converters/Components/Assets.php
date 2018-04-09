<?php

namespace EONConsulting\Core\Converters\Components;

use EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler;
use EONConsulting\Core\Converters\Components\Image;
use Exception;
use Storage;

class Assets
{
    /**
     * @var
     */
    protected $html;

    /**
     * @var
     */
    protected $assets;

    /**
     * @var
     */
    protected $tmp_folder;

    /**
     * @var
     */
    protected $level;

    /**
     * @param $content
     * @param $tmp_folder
     * @param int $level
     * @return $this
     * @throws \Exception
     */
    public function load($content, $tmp_folder, $level = 1)
    {
        if( ! $this->html = HtmlHandler::strGetHtml($content))
        {
            throw new Exception('No assets found in content!');
        }

        if( ! $assets = $this->html->find('video, img, iframe'))
        {
            throw new Exception('No assets found in content!');
        }

        $this->assets = $assets;
        $this->tmp_folder = $tmp_folder;
        $this->level = $level;

        return $this;
    }

    /**
     * @return null
     */
    public function handle()
    {
        foreach($this->assets as $asset)
        {
            try {

                $dest_path = $this->getDestPath($asset->tag, $asset->src);

                if( ! $tmp_path = $this->copyFile($asset->src, $dest_path))
                {
                    // handle file can not be found.
                    continue;
                }

                if($this->getAssetType($asset->tag) == 'images')
                {
                    $path = Storage::disk('storage')->path($dest_path);

                    try {
                        $image = Image::load($path);

                        $asset->height = $image->getHeight();
                        $asset->width = $image->getWidth();
                        $asset->style = "width: {$image->getWidth()}px; height: {$image->getHeight()}px;";
                    } catch(\Exception $e) { }
                }

                $asset->src = $this->getRelativePath($asset->tag, $asset->src);

            } catch(\Exception $e)
            {
                var_dump($asset->getAllAttributes());
                return null;
            }
        }

        return $this->html;
    }

    /**
     * @param $tag
     * @param $src
     * @return string
     */
    protected function getDestPath($tag, $src)
    {
        return "{$this->tmp_folder}/assets/{$this->getAssetType($tag)}/{$this->getFileName($src)}";
    }

    /**
     * @param $tag
     * @param $src
     * @return string
     */
    protected function getRelativePath($tag, $src)
    {
        return str_repeat('../', $this->level) . "assets/{$this->getAssetType($tag)}/{$this->getFileName($src)}";
    }

    /**
     * @param $src
     * @param $dest
     * @return bool
     */
    protected function copyFile($src, $dest)
    {
        if($this->isBase64($src))
        {
            $data = explode( ',', $src);
            Storage::disk('storage')->put($dest, base64_decode( array_get($data, '1')));
        }

        if($content = $this->getFromFile($src))
        {
            return Storage::disk('storage')->put($dest, $content);
        }

        return false;
    }

    /**
     * @param $src
     * @return string
     */
    protected function extensionFromBase64($src)
    {
        preg_match("/data\:(.*?)\;base64/", $src, $type);

        switch(array_get($type, '1'))
        {
            case 'image/gif':
                return '.gif';
                break;
        }

        return '.jpg';
    }

    /**
     * @param $src
     * @return bool
     */
    protected function getFromFile($src)
    {
        if( ! Storage::disk('uploads')->exists($this->getFilePath($src)))
        {
            return false;
        }

        return Storage::disk('uploads')->get($this->getFilePath($src));
    }

    /**
     * @param $src
     * @return string
     */
    protected function getFileName($src)
    {
        if($this->isBase64($src))
        {
            return $this->randomFileName() . $this->extensionFromBase64($src);
        }

        return basename($src);
    }

    /**
     * @return string
     */
    protected function randomFileName()
    {
        return str_random(20);
    }

    /**
     * @param $src
     * @return string
     */
    protected function getFilePath($src)
    {
        return str_after($src, env('APP_URL') . '/uploads/');
    }

    /**
     * @param $src
     * @return false|int
     */
    protected function isBase64($src)
    {
        return preg_match("/data\:/", $src);
    }

    /**
     * Get the type of file
     *
     * @param $tag
     * @return string
     */
    protected function getAssetType($tag)
    {
        switch($tag)
        {
            case 'img':
                return 'images';
                break;

            case 'video':
                return 'videos';
                break;

            default:
                return 'other';
                break;
        }

        return 'other';
    }

}