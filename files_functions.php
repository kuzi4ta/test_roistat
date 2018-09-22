<?php

function open_log($file_name)
{
	$handle = fopen($file_name, "r");
	$length = 1024;
	$tmp_str = "";

	if (!$handle)
		return (ERROR_FILE_NOT_FOUND);
	else
	{
		while (($buffer = fgets($handle, $length)) !== false)
		{
			if ($length < MAX_BUFFER_SIZE)
				$length *= 2;
			$tmp_str .= $buffer;
		}
		if (!feof($handle))
			return ERROR_FGETS;
		fclose($handle);
		return ($tmp_str);
	}
}

function write_output($json)
{
	$handle = fopen("output.json", "w");

	if (!$handle)
		return (ERROR_FAILED_TO_CREATE);
	else
		echo "Файл output.json успешно создан";

	fwrite($handle, $json);
	fclose($handle);
}