<?php

namespace App\View;

class View
{
    private $templatePath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function renderHtml(string $templateName, array $vars = [])
    {
        extract($vars);

        include  $this->templatePath.'/'.$templateName;
    }
}