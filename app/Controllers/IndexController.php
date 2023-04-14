<?php

namespace App\Controllers;

use App\Models\DataCSV;
use App\Services\ParseCsvService;
use App\Storage\Storage;
use App\View\View;

class IndexController
{
    private View $view;
    private DataCSV $csvModel;
    public function __construct()
    {
        $this->view = new View($_SERVER['DOCUMENT_ROOT']."/app/Templates");
        $this->csvModel = new DataCSV();

    }

    public function create():void
    {
        $this->view->renderHtml('Main/main.php');
    }

    public function parseCsv($request):void
    {
        if($request->hasFile()){
            $file = Storage::uploadFile($request->getFile('myfilename.csv'));
            $path = $file->saveFile('mycsv.csv');
            if(isset($path)){
                $data = ParseCsvService::parceCsv($path);
                foreach ($data as $row){
                    $this->csvModel->create($row);
                }
            }
        }
        $this->view->renderHtml('Main/main.php');

    }

    public function index($request):void
    {
        $page = isset($request->getArgs()['page']) ? (int)$request->getArgs()['page'] : 1;
        $limit = 10;
        $count = $this->csvModel->count();
        $count_page = (int)($count / $limit);

        $data_csv = $this->csvModel->get($limit, $page);

        $this->view->renderHtml('Main/dataList.php',['data' => $data_csv, 'page' => $page, 'count_page' => $count_page]);

    }
}