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
<div class="container-fluid">
    <div class="row justify-content-center py-2">
        <div class="col-4">
            <h1>Загрузите файл csv</h1>
            <a href="/index">Посмотреть данные</a>
            <br>
            <br>
            <form action="/parseCsv" METHOD="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
                    <input name="userfile" type="file">
                </div>
                <br>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Отправить">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>