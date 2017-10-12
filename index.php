<?php

require_once './vendor/smarty/smarty/libs/Smarty.class.php';

$smarty = new Smarty;

$smarty->template_dir = 'html/templates';
$smarty->compile_dir = 'html/compile';
$smarty->config_dir = 'html/config';
$smarty->cache_dir = 'html/cache';

$title = 'Test task';
$author = 'Oleg';

$smarty->assign('title', $title);
$smarty->assign('author', $author);

$template_variable = filter_input(INPUT_GET, 'tmpt', FILTER_SANITIZE_MAGIC_QUOTES);

switch ($template_variable) {
    case 'gen':
        $smarty->display('gen.tpl');
        break;

    case 'phonebook':
        require './middleware/functions.php';
        require './middleware/TConnection.php';

        $tconnection = TConnection::getInstance();
        $check_schema = $tconnection->CHECK_SCHEMA_FOR_EXIST();
        if (!isset($check_schema) || empty($check_schema)) {
            $tconnection->CREATE_SCHEMA();
            $data['clients'] = file_get_contents('./resources/csv/cl.csv');
            $data['setup_phone'] = file_get_contents('./resources/csv/phone.csv');
            foreach ($data as $key => $value) {
                $tconnection->CREATE_TABLE($key);
                $tconnection->INSERT_DATA_TABLE($key, $value);
            }
        }
        $result = ['result' => $tconnection->FREE_SQL()];
        $smarty->assign(data, $result);
        $smarty->display('phonebook.tpl');
        break;

    default:
        $smarty->display('main.tpl');
        break;
}


