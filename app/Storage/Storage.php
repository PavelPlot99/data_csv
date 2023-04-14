<?php

namespace App\Storage;

class Storage
{
    private  string $filepath;
    private string $updload_dir;
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
        $this->updload_dir = $_SERVER['DOCUMENT_ROOT']."/uploads";
    }

    public static function uploadFile($filepath):self
    {
        return new self($filepath);
    }

    public function saveFile(string|null $filename): null|string
    {
        $upploadfile = $this->updload_dir."/".$filename;

        if(move_uploaded_file($this->filepath, $upploadfile)){
            return $upploadfile;
        }
        return  null;
    }
}