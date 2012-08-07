<?php

class Channel_others
{
    private $channel = 'others';
    function __construct($info = NULL)
    {
    }
    public function fetch_images($url)
    {
        $html = $this->fetch_curl($url);
        $content = stripslashes($html);
        $pattern = "/<img[^>]*[^\.][src|file]\=[\"|\'](([^>]*)(jpg|png|jpeg|JPG|PNG|JPEG))[\"|\']/iU";
        $images = array();
        preg_match_all($pattern, $content, $matches);
        foreach ($matches[1] as $value)
        {
            if (stripos($value, 'http://') === false)
            {
                $parsed_url = parse_url($url);
                $host = isset($parsed_url['host']) ?$parsed_url['host'] : '';
                $port = isset($parsed_url['port']) ?':' . $parsed_url['port'] : '';
                $value = 'http://' . $host . $port . '/' . $value;
            }
            $img['src'] = $value;
            array_push($images, $img);
        }
        $data = array();
        $data['images'] = $images;
        $data['type'] = 'images';
        $data['url'] = $url;
        return $data;
    }
    function fetch_curl($url, $post = null, $retries = 3)
    {
        $curl = curl_init($url);
        if (is_resource($curl) === true)
        {
            curl_setopt($curl, CURLOPT_FAILONERROR, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            if (isset($post) === true)
            {
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, (is_array($post) === true) ?http_build_query($post, '', '&') : $post);
            }
            $result = false;
            while (($result === false) && (--$retries > 0))
            {
                $result = curl_exec($curl);
            }
            curl_close($curl);
        }
        return $result;
    }
    function get_image_size($url)
    {
        $headers = array(
            "Range: bytes=0-32768"
            );
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $raw = curl_exec($curl);
        curl_close($curl);
        $im = @imagecreatefromstring($raw);
        $size['width'] = @imagesx($im);
        $size['height'] = @imagesy($im);
        unset($raw, $im);
        return $size;
    }
    private function fetch_fgc($url, $post = null, $retries = 3)
    {
        $http = array
        (
            'method' => 'GET',
            );
        if (isset($post) === true)
        {
            $http['method'] = 'POST';
            $http['header'] = 'Content-Type: application/x-www-form-urlencoded';
            $http['content'] = (is_array($post) === true) ?http_build_query($post, '', '&') : $post;
        }
        $result = false;
        while (($result === false) && (--$retries > 0))
        {
            $result = @file_get_contents($url, false, stream_context_create(array('http' => $http)));
        }
        return $result;
    }
}

?>