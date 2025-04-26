<?php

// Enable error reporting (uncomment during development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log errors to a specific file
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/your/project/error_log.log');

// config file $config creates a variable
//
// Include the configuration file_exists

if ('todos.john-urquhart.co.uk' !== $_SERVER['SERVER_NAME']) {
    $config = include 'config-local.php';
} else {
    $config = include 'config-production.php';
}

// Include the setup file
include 'setup.php';

// include 'models/Model.php';

// include 'models/Todo.php';

// include 'models/TodoList.php';

// Autoload function to automatically include class files
spl_autoload_register(function ($class_name) {
    // Define an array of directories where the classes might be located
    $directories = [
        __DIR__.'/models/',
        __DIR__.'/controllers/',
        __DIR__.'/helpers/',
    ];

    // Loop through the directories to find the class file
    foreach ($directories as $directory) {
        $file = $directory.$class_name.'.php';
        if (file_exists($file)) {
            include $file;

            return;
        }
    }
});

// Now you can use the classes without explicitly including them

// $todoList = new TodoList();
