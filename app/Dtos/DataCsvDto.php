<?php

namespace App\Dtos;

class DataCsvDto
{
    public int $id;
    public string $code;
    public string $title;
    public  string|null $level_1;
    public string|null $level_2;
    public string|null $level_3;
    public float|null $price;
    public float|null $priceSP;
    public int|null $count;
    public string|null $rows_properties;
    public string|null$together_buy;
    public string|null $unit;
    public string|null $image;
    public int $view_on_main;
    public string|null $description;

    public function __construct($data){
        foreach ($data as $key => $item){
            $this->{$key} = $item;
        }
    }

    public static function fromArray($data):self
    {
        return new self($data);
    }
}