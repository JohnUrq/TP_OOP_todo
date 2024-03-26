<?php

class Todo extends Model{

    public $table = "todos";
    public $date;
    public $complete;
    public $list_id;
    public $db_fields = ['title', 'date', 'complete', 'list_id'];


    public function complete() {



    }

    public function index($list_id){
        $result = query("SELECT * FROM {$this->table} WHERE list_id = '$list_id'");
        $todo =[];
        foreach ($result as $value) {
            $todo[] = [
                "id" => $value->id,
                "title"=> $value->title,
                "date"=> $value->date,
                "complete"=> $value->complete
            ];
        }
        // debug($todo);
        return $todo;
    }


}