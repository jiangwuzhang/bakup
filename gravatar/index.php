<?php
$URI = preg_match('|/a/(.*)|is', $_SERVER['REQUEST_URI'], $matches);
$origin = 'http://www.gravatar.com/avatar/'.$matches[1];
$cache_id = sha1($matches[1]);
$cache_folder = sprintf("cache/%s/%s/", substr($cache_id, 0, 3), substr($cache_id, 3, 3));
$location = $cache_folder.substr(md5($cache_id), 5, 10).'.gif';
if (!file_exists($location)){
	if (!is_dir($cache_folder)){
                mkdir($cache_folder, 0777, true);
        }
        $binary = file_get_contents($origin);
        file_put_contents($location, $binary);
} else {
	$binary = file_get_contents($location);
}
header('Content-Type:image/png');
echo $binary;
