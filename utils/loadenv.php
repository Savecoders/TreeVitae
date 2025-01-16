<?php

function loadEnv($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("El archivo .env no existe: $filePath");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // ignore commentaries
        if (str_starts_with(trim($line), '#')) {
            continue;
        }

        // split key and values
        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            continue; // Ignorar líneas mal formateadas
        }

        $key = trim($parts[0]);
        $value = trim($parts[1]);

        // remove " '
        if (str_starts_with($value, '"') && str_ends_with($value, '"')) {
            $value = substr($value, 1, -1);
        }

        // define values
        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
}

?>