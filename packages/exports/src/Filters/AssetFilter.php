<?php

namespace EONConsulting\Exports\Filters;

use Exception;
use EONConsulting\Exports\Filters\FilterContract;
use EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler;
use EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Facades\ {
    EONConsulting\Core\Services\HttpClient
};

class AssetFilter implements FilterContract
{

    /*
     * Hold the html dom
     *
     * @var EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom
     */
    protected $html;

    /*
     * Set the temp folder name
     *
     * @var string $temp_folder
     */
    protected $temp_folder;

    /*
     * Set the level for assets to be stored
     *
     * @var string $path_level
     */
    protected $path_level;

    /*
     * Image intervention package
     *
     * @var Intervention\Image\ImageManager
     */
    protected $image_manager;

    /**
     * Asset constructor.
     *
     * @param string $content
     * @param string $tmp_folder
     * @param int $level
     */
    public function __construct(string $content, string $tmp_folder, $level = 1)
    {
        $this->createHtmlDom($content);
        $this->setTempFolder($tmp_folder);
        $this->setPathLevel($level);
        $this->setImageManager();
    }

    /*
     * Run Filter
     */
    public function handle()
    {
        $assets = $this->getAssets();

        foreach($assets as $asset)
        {
            try {

                if($this->getAssetType($asset->tag) == 'images')
                {
                    $asset = $this->saveImage($asset);
                }

                if($this->getAssetType($asset->tag) == 'videos')
                {
                    $asset = $this->saveVideo($asset);
                }

                if($this->getAssetType($asset->tag) == 'link')
                {
                    $asset = $this->saveOtherFiles($asset);
                }

            } catch(\Exception $e)
            {
                Log::debug('Asset Import Failed: ' . $e->getMessage());
                Log::debug('Asset Information: ');
                Log::debug($asset->tag);
                Log::debug($asset->getAllAttributes());

                continue;
            }
        }
    }

    /*
     * Get the assets from the html dom
     */
    protected function getAssets()
    {
        if( ! $assets = $this->getHtml()->find('video, img, iframe, a'))
        {
            throw new Exception('No assets found in content!');
        }

        return $assets;
    }

    /*
     * Save a image asset
     *
     * @param  $asset
     * @return $asset
     */
    /**
     * @param $asset
     * @return mixed
     */
    protected function saveImage($asset)
    {

        if($this->isRemoteFile($asset->src) && $this->isUnisaFile($asset->src))
        {
            $image = $this->getImageManager()->make($asset->src);

        } elseif( ! $this->isBase64($asset->src))
        {
            $image = $this->getImageManager()->make(base_path('../') . $asset->src);

        } else {
            return $asset;
        }

        if($this->getFileTypeFromUrl($asset->src) == 'svg')
        {
            $src_filename = str_replace_first('svg', 'png', $asset->src);
        }
        else
        {
            $src_filename = $asset->src;
        }

        $store_path = Storage::disk('storage')->path($this->getDestPath($asset->tag, $src_filename));

        $asset->src = $this->getRelativePath($asset->tag, $src_filename);
        $asset->height = $image->height();
        $asset->width = $image->width();
        $asset->style = "width: {$image->width()}px; height: {$image->height()}px;";

        $image->save($store_path);
        $image->destroy();

        return $asset;
    }

    /*
     * Save a Video asset
     *
     * @param  $asset
     * @return $asset
     */
    protected function saveVideo($asset)
    {
        $dest_path = $this->getDestPath($asset->tag, $asset->src);

        if($this->isRemoteFile($asset->src) && $this->isUnisaFile($asset->src))
        {
            if( ! $content = $this->getContentFromUrl($asset->src))
            {
                return $asset;
            }

            Storage::disk('storage')->put($dest_path, $content);

            $asset->src = $this->getRelativePath($asset->tag, $asset->src);

            return $asset;

        } else {

            if( ! $content = $this->getContentFromFile($asset->src))
            {
                return $asset;
            }

            Storage::disk('storage')->put($dest_path, $content);

            $asset->src = $this->getRelativePath($asset->tag, $asset->src);

            return $asset;
        }

        return $asset;
    }

    /*
     * Save other assets, like pdfs etc
     *
     * @param  $asset
     * @return $asset
     */
    protected function saveOtherFiles($asset)
    {
        if($this->getFileTypeFromUrl($asset->href) == 'pdf')
        {
            $dest_path = $this->getDestPath('other', $asset->href);

            if($this->isRemoteFile($asset->href) && $this->isUnisaFile($asset->href))
            {
                if( ! $content = $this->getContentFromUrl($asset->href))
                {
                    return $asset;
                }

                Storage::disk('storage')->put($dest_path, $content);

                $asset->href = $this->getRelativePath('other', $asset->href);

                return $asset;

            } else {

                if( ! $content = $this->getContentFromFile($asset->href))
                {
                    return $asset;
                }

                Storage::disk('storage')->put($dest_path, $content);

                $asset->href = $this->getRelativePath('other', $asset->src);

                return $asset;
            }
        }

        return $asset;
    }

    /*
     * Get content from a remote url
     *
     * @param string $url
     * @return string $content
     */
    protected function getContentFromUrl(string $url)
    {
        try {

            $content = HttpClient::download($url);

            return $content;

        } catch(HttpClientException $e)
        {
            throw new Exception('Unable to connect to ' . $url);
        }

        return false;
    }

    /**
     * Get content from a local file
     *
     * @param string $src
     * @return bool|string
     */
    protected function getContentFromFile($path)
    {
        if( ! Storage::disk('uploads')->exists($this->getFilePath($path)))
        {
            return false;
        }

        return Storage::disk('uploads')->get($this->getFilePath($path));
    }


    /**
     * Get the filepath for local hosted files
     *
     * @param string $src
     * @return string $path
     */
    protected function getFilePath($src) : string
    {
        return str_after($src, env('APP_URL') . '/uploads/');
    }

    /**
     * Create a Html Dom and set it
     *
     * @param $content
     */
    protected function createHtmlDom($content) : AssetFilter
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
    protected function setHtml(SimpleHtmlDom $html) : AssetFilter
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

    /**
     * Set the image_manager
     *
     * @return AssetFilter
     */
    public function setImageManager() : AssetFilter
    {
        $this->image_manager = new ImageManager(array('driver' => 'imagick'));
        return $this;
    }

    /**
     * Get the Image Manager
     *
     * @return Intervention\Image\ImageManager
     */
    public function getImageManager() : ImageManager
    {
        return $this->image_manager;
    }

    /**
     * Set the temp folder path
     *
     * @param string $temp_folder
     * @return AssetFilter
     */
    protected function setTempFolder(string $temp_folder) : AssetFilter
    {
        $this->temp_folder = $temp_folder;
        return $this;
    }

    /**
     * Get the temp folder path
     *
     * @return mixed
     */
    protected function getTempFolder() : string
    {
        return $this->temp_folder;
    }

    /**
     * Set the level path for assets
     *
     * @param string $path_level
     * @return AssetFilter
     */
    protected function setPathLevel(string $path_level) : AssetFilter
    {
        $this->path_level = $path_level;
        return $this;
    }

    /**
     * Get the Path Level
     *
     * @return string
     */
    protected function getPathLevel() : string
    {
        return $this->path_level;
    }

    /*
     * Check to see if the file is from a external source
     *
     * @param string $src
     * @return bool
     */
    protected function isRemoteFile($src)
    {
        return str_contains($src, 'http://') || str_contains($src, 'https://');
    }

    /**
     * Check to see if the image is a base64 image
     *
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

            case 'a':
                return 'link';
                break;

            default:
                return 'other';
                break;
        }

        return 'other';
    }

    /**
     * Get the path to save the tmp asset too
     *
     * @param $tag
     * @param $src
     * @return string
     */
    protected function getDestPath($tag, $src)
    {
        return "{$this->getTempFolder()}/assets/{$this->getAssetType($tag)}/{$this->getFileName($src)}";
    }

    /**
     * Get the filename of the asset
     *
     * @param string $src
     * @return string
     */
    protected function getFileName(string $src) : string
    {
        return basename($src);
    }

    /**
     * Get the relative path to the assets folder
     *
     * @param string $tag
     * @param string $src
     * @return string
     */
    protected function getRelativePath(string $tag, string $src) : string
    {
        return str_repeat('../', $this->getPathLevel()) . "assets/{$this->getAssetType($tag)}/{$this->getFileName($src)}";
    }

    /*
     * Check to see if the file is stored on unisa's servers
     *
     * @param string $src
     * @return bool
     */
    protected function isUnisaFile($src)
    {
        return str_contains($src, 'unisaonline.net');
    }

    protected function getFileTypeFromUrl($href)
    {
        switch(pathinfo($href, PATHINFO_EXTENSION))
        {
            case 'pdf':
                return 'pdf';
                break;

            case 'svg':
                return 'svg';
                break;

            default:
                return 'other';
                break;
        }

        return 'other';
    }
}