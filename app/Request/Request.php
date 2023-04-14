<?php

namespace App\Request;

class Request
{
    private string $url;
    private string $method;
    private array $params;
    private array $file;
    private array $args;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $this->method === "GET" ? $_GET : $_POST;
        $this->file = $_FILES;
        $this->args = [];
    }

    public function hasFile(): bool
    {
        if (isset($this->file['userfile']['tmp_name'])) {
            return true;
        }
        return false;
    }

    public function getFile(): bool|string
    {
        if ($this->hasFile()) {
            return $this->file['userfile']['tmp_name'];
        }

        return false;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    public function setArgs($args)
    {
        $this->args = $args;
    }
    public function getArgs(){
        return $this->args;
    }
}