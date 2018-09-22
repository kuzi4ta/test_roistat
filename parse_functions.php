<?php

function parse($data)
{
	if (count($data['URL']) !== count($data['CODE']) || count($data['CODE']) !== count($data['TRAFFIC']) ||
		count($data['TRAFFIC']) !== count($data['CRAWLER']))
		return (ERROR_INCORRECT_DATA);

	$parse_length = count($data['URL']);

	$arr_prepare = array(
		"views" => $parse_length,
		"urls" => 0,
		"traffic" => 0,
		"crawlers" => array(
			"Google" => 0,
			"Bing" => 0,
			"Baidu" => 0,
			"Yandex" => 0
		),
		"statusCodes" => array()
	);

	$arr_prepare = fill_array($arr_prepare, $parse_length, $data);
	return (json_encode($arr_prepare, JSON_PRETTY_PRINT));
}

function fill_array($arr_prepare, $length, $data)
{
	$arr_urls = array();

	for ($i = 0; $i < $length; $i++)
	{
		$arr_tmp = explode(" ", $data['URL'][$i]);

		if (!in_array($arr_tmp[1], $arr_urls))
			$arr_urls[] = $arr_tmp[1];

		$arr_prepare['traffic'] += intval($data['TRAFFIC'][$i]);

		if (!array_key_exists($data['CODE'][$i], $arr_prepare['statusCodes']))
			$arr_prepare['statusCodes'][$data['CODE'][$i]] = 1;
		else
			$arr_prepare['statusCodes'][$data['CODE'][$i]]++;

		if (preg_match("/googlebot/i", $data['CRAWLER'][$i], $matches))
			$arr_prepare['crawlers']['Google']++;
		if (preg_match("/bingbot/i", $data['CRAWLER'][$i], $matches))
			$arr_prepare['crawlers']['Bing']++;
		if (preg_match("/baiduspider/i", $data['CRAWLER'][$i], $matches))
			$arr_prepare['crawlers']['Baidu']++;
		if (preg_match("/yandexbot/i", $data['CRAWLER'][$i], $matches))
			$arr_prepare['crawlers']['Yandex']++;
	}
	$arr_prepare['urls'] = count($arr_urls);
	return ($arr_prepare);
}

function prepare($str)
{
	$pattern = "/\"(?<URL>.+?)\" (?<CODE>\d{3}) (?<TRAFFIC>[\d\W]+) \"(?<SITE>.+?)\" \"(?<CRAWLER>.+?)\"/";
	preg_match_all($pattern, $str, $matches);
	return (parse($matches));
}