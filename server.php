<?php

$url = $_REQUEST['url'];
echo checkStatus($url);

/**
 * @param $url
 * @return int
 * Return codes:
 * 2 = invalid url
 * 1 = site is up
 * 0 = site is down
 */

function checkStatus($url) {
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return 2;
    }
    $userAgent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36";
    // do curl get request
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($curl,CURLOPT_HEADER,true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    // return code
    return intval($status >= 200 && $status < 400);
}
