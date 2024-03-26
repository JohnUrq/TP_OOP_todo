<?php

// NB create() Method:

// The create() method is a public method that allows creating a new todo list.
// It takes a parameter $title, which represents the title of the new todo list.
// Inside the method, the $title parameter is assigned to the class property $title using $this->title = $title.
// (Remember the => for arrays)
// Then, a database query is executed using the query() function from setup.php
// The query inserts the $title value into a database table named todo_lists using a parameterized query to prevent SQL injection.


class TodoList extends Model {
    public $table = 'todo_lists';
    public $todos;
    public $db_fields = ['title'];

    public function index(){
        $result = query("SELECT * FROM {$this->table}");
        $todo_lists =[];
        foreach ($result as $value) {
            $todo_lists[] = [
                "id" => $value->id,
                "title"=> $value->title
            ];
        }
        // debug($todo_lists);
        return $todo_lists;
    }
}
