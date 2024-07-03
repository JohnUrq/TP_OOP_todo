<?php

// config file $config creates a variable
//
// Include the configuration file
$config = include 'config.php';

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
// For example, if you have a TodoList class in models/TodoList.php, you can just instantiate it:
// $todoList = new TodoList();
