<?php
// autoload file to inc other files required

include "autoload.php";

$url = str_replace($config['site_url'],'',$_SERVER['REQUEST_URI']);

$url_parts = explode('/',$url);

switch($url_parts[0]){
    case 'todos':
        switch($url_parts[1]){
            case 'get':
                $todo = new Todo;
                $todo->load($url_parts[2]);
                echo $todo->json();
                break;
            case 'delete':
                $todo = new Todo;
                $todo->load($url_parts[2]);
                $todo->delete();
                echo '{"result": "success"}';
                break;
            case 'create':
                $todo = new Todo;
                $properties = ['title', 'list_id', 'date', 'complete'];
                $todo->hydrate($properties, $_POST);
var_dump($_POST);
                $todo->create();
                 echo '{"result": "success"}';
                break;
            case 'update':
                $todo = new Todo;
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
        switch($url_parts[1]){

            case 'get':
                $todo_list = new TodoList;
                $todo_list->load($url_parts[2]);
                echo $todo_list->json();
                break;
            case 'delete':
                $todo_list = new TodoList;
                $todo_list->load($url_parts[2]);
                $todo_list->delete();
                echo '{"result": "success"}';
                break;    
            case 'create':
                $todo_list = new TodoList;
                $properties = ['title'];
                $todo_list->hydrate($properties, $_POST);
                $todo_list->create();
                // debug($todo_list);
                echo '{"result": "success"}';
                break;
            case 'update':
                $todo_list = new TodoList;
                $todo_list->load($url_parts[2]);
                $properties = ['title'];
                $todo_list->hydrate($properties, $_POST);

                $todo_list->update();
                echo '{"result": "success"}';
                break;
        }
        break;
}
