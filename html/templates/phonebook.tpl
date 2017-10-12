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
            <div class="col-sm-12">
                <h1 class="header"> Телефонный справочник </h1>
{*                <form class="form-horizontal">*}
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="card">
                                <div class="card-action">   </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-phonebook">
                                            <thead>
                                                <tr>
                                                    <th>n/n</th>
                                                    <th>ФИО</th>
                                                    <th>Номер телефона</th>
                                                    <th>Комментарий</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {foreach from=$data.result key=k item=v}
                                                    <tr class="odd gradeX" id="{$v.cid}">
                                                        <td>{$k+1}</td>
                                                        <td name="fio">{$v.fio}</td>
                                                        <td name="phone">{$v.phone}</td>
                                                        <td name="remark">{$v.remark}</td>
                                                    </tr>
                                                {/foreach}
                                            </tbody>
                                            <tfoot>
                                                <tr class="odd gradeX">
                                                    <td colspan="4">
                                                        <form class="form-horizontal">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="input-group">
                                                                        <input name="fio" type="text" class="form-control col-sm-offset-1" id="inputFio" placeholder="ФИО">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="input-group">
                                                                        <input name="phone" type="text" class="form-control col-sm-offset-1" id="inputPhone" placeholder="Контактный телефон">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="input-group">
                                                                        <input name="remark" type="text" class="form-control col-sm-offset-1" id="inputRemark" placeholder="Комментарий">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="input-group">
                                                                        <button type="submit" class="btn btn-success col-sm-offset-1"><span class="glyphicon glyphicon-ok"></span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
{*                </form>*}
            </div>
        </div>

        <script src="/vendor/jquery 3.2.0/jquery.min.js"></script>
        <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/html/js/dataTables/jquery.dataTables.js"></script>
        <script src="/html/js/dataTables/dataTables.bootstrap.js"></script>
        <script src="/html/js/dataTables/common.js"></script>
{*        <script src="/html/js/common.js"></script>*}
        <script>
            $(document).ready(function () {
                $('#dataTables-phonebook').dataTable();
            });
        </script>

    </body>
</html>