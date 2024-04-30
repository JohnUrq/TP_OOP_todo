<?php

class Model
{
    public $table;
    public $id;
    public $title;
    public $db_fields = [];

    public function create()
    {
        // The :title placeholder indicates that a value will be supplied for the title column when executing the query.
        $values = [];
        $query_placeholders = [];

        foreach ($this->db_fields as $field) {
            $values[$field] = $this->{$field};
            $query_placeholders[] = ':'.$field;
        }

        $query_keys = implode(',', $this->db_fields);
        $query_placeholders = implode(',', $query_placeholders);

        $this->id = query(
            "INSERT INTO {$this->table} ({$query_keys}) VALUES ({$query_placeholders})",
            $values
        );
        // debug($this->id);
    }

    public function update()
    {
        $values = ['id' => $this->id];
        $query_placeholders = [];
        foreach ($this->db_fields as $field) {
            $values[$field] = $this->{$field};
            $query_placeholders[] = $field.' = :'.$field;
        }
        $query_placeholders = implode(',', $query_placeholders);

        query(
            "UPDATE {$this->table} SET {$query_placeholders} WHERE id = :id",
            $values
        );
    }

    public function delete()
    {
        query("DELETE FROM {$this->table} WHERE id = :id", ['id' => $this->id]);
    }

    public function load($id)
    {
        $result = query("SELECT * FROM {$this->table} WHERE id = :id", ['id' => $id]);

        foreach ($result[0] as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function json()
    {
        $json_array = [];
        if ($this->id) {
            $json_array['id'] = $this->id;
        }
        foreach ($this->db_fields as $field) {
            $json_array[$field] = $this->{$field};
        }

        return json_encode($json_array);
    }

    public function hydrate($properties, $values)
    {
        foreach ($properties as $property) {
            if (isset($values[$property])) {
                $this->{$property} = $values[$property];
            }
        }
    }
}
