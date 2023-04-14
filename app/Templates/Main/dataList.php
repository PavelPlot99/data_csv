<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="description" content="Описание страницы"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center py-2">
        <div class="col-3">
            <h1>Вывод данных</h1>

        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Код</th>
                <th scope="col">Наименование</th>
                <th scope="col">Уровень 1</th>
                <th scope="col">Уровень 2</th>
                <th scope="col">Уровень 3</th>
                <th scope="col">Цена</th>
                <th scope="col">ЦенаСП</th>
                <th scope="col">Количетсво</th>
                <th scope="col">Поля свойств</th>
                <th scope="col">Совместные покупки</th>
                <th scope="col">Еденица измерения</th>
                <th scope="col">Картинка</th>
                <th scope="col">Выводить на главной</th>
                <th scope="col">Описание</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $key => $item){?>
            <tr>

                <th scope="row"><?=$key?></th>
                <td><?=$item->code?></td>
                <td><?=$item->title?></td>
                <td><?=$item->level_1?></td>
                <td><?=$item->level_2?></td>
                <td><?=$item->level_3?></td>
                <td><?=$item->price?></td>
                <td><?=$item->priceSP?></td>
                <td><?=$item->count?></td>
                <td><?=$item->rows_properties?></td>
                <td><?=$item->together_buy?></td>
                <td><?=$item->unit?></td>
                <td><?=$item->image?></td>
                <td><?=$item->view_on_main?></td>
                <td><?=$item->description?></td>
            </tr>

            </tbody>
            <?php }?>
        </table>
        <div class="row justify-content-center">
            <div class="col" align="center"><a href="<?=$page === 1 ? "http://".$_SERVER['HTTP_HOST']."/index/$count_page" : "http://".$_SERVER['HTTP_HOST']."/index/".$page - 1 ?>">Назад</a></div>
            <div class="col" align="center"><?="Страница $page из $count_page"?></div>
            <div class="col" align="center"><a href="<?=$page === $count_page ? "http://".$_SERVER['HTTP_HOST']."/index/1" : "http://".$_SERVER['HTTP_HOST']."/index/".$page + 1 ?>">Вперед</a></div>
        </div>
    </div>
</div>
</body>
</html>