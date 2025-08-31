<?php

/**
 * Main Model trait
 */
Trait Model
{
    protected $limit        = 10;
    protected $offset       = 0;
    protected $order_type   = "desc";
    
    public $errors          = [];

    public function findAll()
    {
        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        return $this->query($query);
    }

    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :". $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :". $key . " && ";
        }
        
        $query = trim($query," && ");

        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :". $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :". $key . " && ";
        }
        
        $query = trim($query," && ");

        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);
        
        $result = $this->query($query, $data);
        if($result)
            return $result[0];

        return false;
    }

    public function insert($data)
    {
        /** remove unwanted data **/
        if(!empty($this->allowedColumns))
        {
            foreach ($data as $key => $value) {
                if(!in_array($key, $this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";
        $this->query($query, $data);

        return false;
    }

    public function update($id, $data)
    {
        /** remove unwanted data **/
        if(!empty($this->allowedColumns))
        {
            foreach ($data as $key => $value) {
                if(!in_array($key, $this->allowedColumns))
                {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . " = :". $key . ", ";
        }

        $query = trim($query,", ");

        // FIX: Add a space before 'where'
        $primaryKey = property_exists($this, 'primaryKey') ? $this->primaryKey : 'id';
        $query .= " where {$primaryKey} = :id";

        $data['id'] = $id;

        $result = $this->query($query, $data);
        return $result !== false;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        error_log("SQL: $sql | id: $id");
        $stm = $this->query($sql, ['id' => $id]);
        $rowCount = $stm->rowCount();
        error_log("Delete rowCount: " . $rowCount);
        return $rowCount > 0;
    }

    public function query($query, $data = [])
    {
        $pdo = Database::connect();
        $stm = $pdo->prepare($query);
        $stm->execute($data);

        // Try to fetch results, if any
        if (stripos($query, 'select') === 0) {
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $stm;
    }
}