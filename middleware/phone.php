<?php

require './functions.php';
require './TConnection.php';

$tconnection = TConnection::getInstance();

switch (filter_input(INPUT_GET, 'method')) {
    case 'add':
        $fio = explode(' ', filter_input(INPUT_GET, 'fio'));
        $data['client']['lname'] = $fio[0] ?? '';
        $data['client']['fname'] = $fio[1] ?? '';
        $data['client']['mname'] = $fio[2] ?? '';
        $data['phone']['phone'] = filter_input(INPUT_GET, 'phone');
        $data['phone']['remark'] = filter_input(INPUT_GET, 'remark');

        $tconnection->INSERT_DATA_SQL($data);
        break;

    case 'upd';
        $data['cid'] = filter_input(INPUT_GET, 'cid');
        $column_name = filter_input(INPUT_GET, 'name');

        if ($column_name == 'fio') {
            $table_name = 'clients';
            $fio = explode(' ', filter_input(INPUT_GET, 'value'));
            $fio_once['lname'] = $fio[0] ?? '';
            $fio_once['fname'] = $fio[1] ?? '';
            $fio_once['mname'] = $fio[2] ?? '';
            foreach ($fio_once as $key => $value) {
                $data['field'] = $key;
                $data['value'] = $value;
                $tconnection->UPDATE_DATA_SQL($data, $table_name);
            }
        } else {
            $table_name = 'setup_phone';
            $data['field'] = $column_name;
            $data['value'] = filter_input(INPUT_GET, 'value');
            $tconnection->UPDATE_DATA_SQL($data, $table_name);
        }
        break;

    default:
        break;
}