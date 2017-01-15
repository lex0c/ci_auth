<?php

/**
 *
 */
if(file_exists(__DIR__ . '/.appdata')) {

    /**
     * PHP Alias for Starting Local Server
     * ...
     */
    if(is_dir((__DIR__) . '/public') && (file_exists((__DIR__) . '/public/index.php'))) {
        echo "Press Ctrl-C to quit.\n";
        echo "Server started on 'http://localhost:9000/'\n";
        shell_exec('php -S localhost:9000 -t public/');
    } else {
        echo "Public directory not found.\n";
    }

} else {
    echo "Installing project dependencies ...\n";
    shell_exec('composer install');

    echo "Creating file '.appdata'...\n";
    shell_exec("php -r \"file_exists('.appdata') || copy('.appdata.example', '.appdata');\"");

    echo "Starting the server, now...\n";
    echo "Server started on 'http://localhost:9000/'\n";
    shell_exec('php -S localhost:9000 -t public/');
}
