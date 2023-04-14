<?php

namespace App\Services;


class ParseCsvService
{
    private $connection;
    private array $row_names = [
        'Код' => 'code',
        'Наименование' => 'title',
        'Уровень1' => 'level_1',
        'Уровень2' => 'level_2',
        'Уровень3' => 'level_3',
        'Цена' => 'price',
        'ЦенаСП' => 'priceSP',
        'Количество' => 'count',
        'Поля свойств' => 'rows_properties',
        'Совместные покупки' => 'together_buy',
        'Единица измерения' => 'unit',
        'Картинка' => 'image',
        'Выводить на главной' => 'view_on_main',
        'Описание' => 'description',

    ];

    public static function parceCsv($path)
    {
        $parser = new self();
        $parser->getStream($path);

        $first_row = $line = fgetcsv($parser->connection, 0, ";", "\r", '"');
        foreach ($first_row as $key => $item) {
            $first_row[$key] = trim($item, ',"');
        }


        $result = [];
        while (($line = fgetcsv($parser->connection, 0, ";", "\r", '"')) !== false) {
            $tmp_arr = [];
            while (count($line) > count($parser->row_names)) {
                $line[count($line) - 2] .= $line[count($line) - 1];
                unset($line[count($line) - 1]);
            }
            foreach ($line as $key => $item_line) {

                $tmp_arr[$parser->row_names[$first_row[$key]]] = trim($item_line, ',"') === "" ? null : str_replace('"', "", trim($item_line, ',"/'));

            }
            $result[] = $tmp_arr;
        }

        return $result;
    }

    private function getStream($path)
    {
        $this->connection = fopen($path, 'r');
    }

    private function closeConnection()
    {
        $this->connection = null;
    }
}