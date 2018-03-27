#!/usr/bin/php
<?PHP

if ($argc <= 1)
	return;
function get_data($url)
{
	$fd = curl_init();
	curl_setopt($fd, CURLOPT_URL, $url);
	curl_setopt($fd, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($fd);
	curl_close($fd);
	return ($data);
}
$data = get_data($argv[1]);
$images = array();
$target = preg_replace('#^https?://#', '', $argv[1]);
$target = explode('/', $target)[0];
mkdir($target);
preg_match_all('/<img(.*?)src="(.*?)"/', $data, $images);
foreach($images[2] as $url)
{
	if (strpos($url, "http") == false)
		$url = "http://$target/$url";
	echo "$url\n";
	$image = get_data($url);
	$name = explode('/', $url);
	$name = $name[count($name) - 1];
	file_put_contents("./" . $target . "/" . $name, $image);
}

?>
