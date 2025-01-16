<?php

/**
 * main model class
 */
class model extends database
{
    protected $table = "";

    public function insert($data){
        if (!empty($this->queryColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->queryColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);

        $query = "insert into " . $this->table;
        $query .= " (".implode(',',$keys).") values (:".implode(',:',$keys).")";

        $this->query($query, $data);
    }
    public function update($id, $data){
        if (!empty($this->queryColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->queryColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "update " . $this->table . " set ";
        foreach ($keys as $key) {
            $query .= $key . ' = :' . $key . ",";
        }
        $query = trim($query, ",");
        $query .= " where user_id = :user_id";
        
        $data["user_id"] = $id;
        $this->query($query, $data);
    }
    public function where($data){
        $keys = array_keys($data);

        $query = "select * from " . $this->table . " where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        $query = trim($query, "&& ");
        $res = $this->query($query, $data);
        if (is_array($res)) {
            return $res;
        }
        return false;
    }
    public function first($data){
        $keys = array_keys($data);

        $query = "select * from " . $this->table . " where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        $query = trim($query, "&& ");
        $query .= " order by user_id desc limit 1";
        $res = $this->query($query, $data);
        if (is_array($res)) {
            return $res[0];
        }
        return false;
    }
}
