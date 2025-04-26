<?php

// Report all PHP errors
error_reporting(E_ALL);

// Log errors to a specific file
ini_set('log_errors', 'On');
ini_set('error_log', 'error_log.log');

// Trigger an error (undefined variable) to test logging
// echo $undefined_variable;

// debug(query('select * from todos'));
// autoload file to inc other files required

include 'autoload.php';

if (empty($_POST)) {
    $_POST = json_decode(file_get_contents('php://input'), true);
}

$url = str_replace($config['site_url'], '', $_SERVER['REQUEST_URI']);

$url_parts = explode('/', $url);

switch ($url_parts[0]) {
    case 'todos':
        switch ($url_parts[1]) {
            case 'index':
                $todo = new Todo();
                $result = $todo->index($url_parts[2]);
                echo json_encode($result);

                break;

            case 'get':
                $todo = new Todo();
                $todo->load($url_parts[2]);
                echo $todo->json();

                break;

            case 'delete':
                $todo = new Todo();
                $todo->load($url_parts[2]);
                $todo->delete();
                echo '{"result": "success"}';

                break;

            case 'create':
                $todo = new Todo();
                $properties = ['title', 'list_id', 'date', 'complete'];
                $todo->hydrate($properties, $_POST);
                $todo->create();
                echo $todo->json();

                break;

            case 'update':
                $todo = new Todo();
                $todo->load($url_parts[2]);
                $properties = ['title', 'list_id', 'date', 'complete'];
                /*
            NB : Hydration refers to the process of filling an object with data. An object which has not yet been hydrated has been instantiated and represents an entity that does have data, but the data has not yet been loaded into the object. This is something that is done for performance reasons.
            Additionally, the term hydration is used when discussing plans for loading data from databases or other data sources.
                */
                $todo->hydrate($properties, $_POST);
                $todo->update();
                echo '{"result": "success"}';

                break;
        }

        break;

    case 'todo-lists':
        switch ($url_parts[1]) {
            case 'index':
                $todo_list = new TodoList();
                $result = $todo_list->index();
                echo json_encode($result);

                break;

            case 'get':
                $todo_list = new TodoList();
                $todo_list->load($url_parts[2]);
                echo $todo_list->json();

                break;

            case 'delete':
                $todo_list = new TodoList();
                $todo_list->load($url_parts[2]);
                $todo_list->delete();
                echo '{"result": "success"}';

                break;

            case 'create':
                $todo_list = new TodoList();
                $properties = ['title'];
                $todo_list->hydrate($properties, $_POST);
                $todo_list->create();
                // debug($todo_list);
                echo $todo_list->json();

                break;

            case 'update':
                $todo_list = new TodoList();
                $todo_list->load($url_parts[2]);
                $properties = ['title'];
                $todo_list->hydrate($properties, $_POST);

                $todo_list->update();
                echo '{"result": "success"}';

                break;
        }

        break;

    default:
        exit('No matching URL found!');

        break;
}
