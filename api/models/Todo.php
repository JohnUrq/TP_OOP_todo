<?php

class Todo extends Model
{
    public $table = 'todos';
    public $complete;
    public $list_id;
    public $db_fields = ['title', 'complete', 'list_id'];

    public function complete() {}

    public function index($list_id)
    {
        $result = query("SELECT * FROM {$this->table} WHERE list_id = '{$list_id}'");
        $todo = [];
        foreach ($result as $value) {
            $todo[] = [
                'id' => $value->id,
                'title' => $value->title,
                'complete' => $value->complete,
                'list_id' => $value->list_id,
            ];
        }

        // debug($todo);
        return $todo;
    }
}
