<?php

class Curl_model extends CI_Model
{
    // $header must be in array
    // with header name as key and header body as value
    public function curl_get($url, $header = null)
    {
        $my_curl = curl_init();
        curl_setopt($my_curl, CURLOPT_URL, $url);
        curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($my_curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.76 Mobile Safari/537.36");

        if ($header) {
            $header_list = array();
            foreach ($header as $key => $value) {
                $header_list[] = "$key: $value";
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header_list);
        }

        $str = curl_exec($my_curl);
        curl_close($my_curl);

        return $str;
    }

    public function curl_post($url, $data, $header = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        if ($header) {
            $header_list = array();
            foreach ($header as $key => $value) {
                $header_list[] = "$key: $value";
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header_list);
        }

        $str = curl_exec($ch);
        curl_close($ch);

        return $str;
    }
}
