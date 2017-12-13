<?php

namespace EONConsulting\TaoClient;

use DOMDocument;

class Helpers
{
    /**
     * Clean the tao launch url
     *
     * @param $launch_url
     * @return bool|string
     */
    static public function sanitizeTaoLaunchUrl($launch_url)
    {
        $parts = parse_url($launch_url);

        if( ! array_key_exists('path', $parts))
        {
            return false;
        }

        $path = $parts['path'];

        if(substr($path, 0, 1) != '/')
        {
            $path = '/' . $path;
        }

        $explode = explode('&height=', $path);

        $path = $explode[0];

        $tao_url = str_before(config('tao-client.api_url'), '/tao');

        return $tao_url . trim($path);
    }

    /**
     * Check if the url is a tao url
     *
     * @param $url
     * @return bool
     */
    static public function isTaoLink($url)
    {
        return ! preg_match('/DeliveryTool\/launch\//', $url);
    }

    /**
     * Get the tao url
     *
     * @param $content
     * @return bool|string
     */
    static public function getLaunchUrl($content)
    {
        if(! $tao_iframe_src = self::getTaoIframe($content))
        {
            return false;
        }

        if(self::isTaoLink($tao_iframe_src))
        {
            return false;
        }

        $launch_url = explode('?launch_url=', $tao_iframe_src);
        $delivery_url = explode('?delivery_url=', $tao_iframe_src);

        if(isset($launch_url[1]))
        {
            return self::sanitizeTaoLaunchUrl($launch_url[1]);
        }

        if(isset($delivery_url[1]))
        {
            return self::sanitizeTaoLaunchUrl($delivery_url[1]);
        }

        return false;
    }

    /**
     * Get the tao url from the iframe in the content
     *
     * @param $content
     * @return bool|string
     */
    static public function getTaoIframe($content)
    {

        try {
            $dom = new DOMDocument;

            @$dom->loadHTML($content);

            $iframes = $dom->getElementsByTagName('iframe');
        } catch(\Exception $e) {
            return false;
        }

        foreach($iframes as $iframe) {
            return $iframe->getAttribute('src');
        }

        return false;
    }

}