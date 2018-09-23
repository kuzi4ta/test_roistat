<?php

include('constants.php');
include('parse_functions.php');
include('files_functions.php');

function main($argc, $argv)
{
	if ($argc == 1)
	{
		echo ERROR_NO_ARG_TEXT;
		return (ERROR_NO_ARG);
	}

	switch (($data = open_log($argv[1])))
	{
		case ERROR_FILE_NOT_FOUND: echo ERROR_FILE_NOT_FOUND_TEXT; return (ERROR_FILE_NOT_FOUND);
		case ERROR_FGETS: echo ERROR_FGETS_TEXT; return (ERROR_FGETS);
	}

	$json = prepare($data);

	if ($json === ERROR_INCORRECT_DATA)
	{
		echo ERROR_INCORRECT_DATA_TEXT;
		return (ERROR_INCORRECT_DATA);
	}

	if (write_output($json) === ERROR_FAILED_TO_CREATE)
	{
		echo ERROR_FAILED_TO_CREATE_TEXT;
		return (ERROR_FAILED_TO_CREATE);
	}

	return (SUCCESS);
}

main($argc, $argv);
