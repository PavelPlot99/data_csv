<?php

namespace App\Models;

use App\Dtos\DataCsvDto;

class Model
{
    protected string $table;
    protected $connection;

    public function __construct()
    {
        $this->connection = new \mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
        $this->connection->set_charset("utf8");
    }

    public function create($data)
    {
        $keys = [];
        $values = [];

        foreach ($data as $key => $value) {
            $keys[] = $key;
            if (is_null($value)) {
                $values[] = null;
            } else {
                $values[] = str_replace(',', '.', $this->connection->real_escape_string($value));
            }
        }
        $types = str_repeat('s', count($values));

        $stmt = $this->connection->prepare("INSERT INTO $this->table (" . implode(',', $keys) . ") VALUES (" . implode(',', array_fill(0, count($values), '?')) . ")");

        $stmt->bind_param($types, ...$values);
        $stmt->execute();
    }

    public function get($limit, $page):array
    {
        $count = $this->count();
        $result = [];
        if($count === 0){
            return [];
        }
        if($count < $limit){
            $result = $this->connection->query("SELECT * FROM $this->table");
        }else {
            $offset = ($page - 1) * $limit;
            $result = $this->connection->query("SELECT * FROM $this->table LIMIT $offset , $limit");
        }
        $result_array_dto = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $result_array_dto[] = DataCsvDto::fromArray($row);
        }

        return  $result_array_dto;
    }

    public function count(){
        $count = $this->connection->query("SELECT COUNT(*) FROM $this->table")->fetch_array();
        return (int)$count[0];

    }

    public function __destruct()
    {
        $this->connection->close();
    }


}