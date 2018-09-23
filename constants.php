<?php

define ("SUCCESS", 0);

define ("ERROR_FGETS", -1);
define ("ERROR_NO_ARG", 1);
define ("ERROR_FILE_NOT_FOUND", 2);
define ("ERROR_FAILED_TO_CREATE", 3);
define ("ERROR_INCORRECT_DATA", 4);

define ("MAX_BUFFER_SIZE", 50 * 1024 * 1024);

define ("ERROR_FILE_NOT_FOUND_TEXT", "Ошибка открытия файла, проверьте существование файла и его права доступа\n");
define ("ERROR_FAILED_TO_CREATE_TEXT", "Ошибка создания файла, проверьте права доступа\n");
define ("ERROR_INCORRECT_DATA_TEXT", "Ошибка! Некорректные данные в файле\n");
define ("ERROR_NO_ARG_TEXT", "Нечего парсить. Передайте файл как аргумент\n");
define ("ERROR_FGETS_TEXT", "Ошибка fgets()\n");
