<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{$author}">

        <title>{$title}</title>

        <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="col-sm-7">
                <h1 class="header"> Генератор чисел </h1>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputMin" class="col-sm-2 control-label">Min</label>
                        <div class="col-sm-10">
                            <input name="min" type="number" class="form-control" id="inputMin" placeholder="начало диапазона">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMax" class="col-sm-2 control-label">Max</label>
                        <div class="col-sm-10">
                            <input name="max" type="number" class="form-control" id="inputMax" placeholder="конец диапазона">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="output" class="col-sm-2 control-label">Результат</label>
                        <div class="col-sm-10">
                            <input name="result" type="text" class="form-control" id="output" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Отправить</button>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <a class="btn btn-default" href="/" role="button">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script src="/vendor/jquery 3.2.0/jquery.min.js"></script>
        <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/html/js/common.js"></script>

    </body>
</html>