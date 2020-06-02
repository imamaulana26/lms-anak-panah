<?php defined('BASEPATH') or exit('No direct script access allowed');

$ver = "envi"; // envi or prod or maintenance

switch ($ver) {
    case "maintenance":
        $config = array(
            'version' => 'maintenance',
            'hostname' => 'localhost',
            'username' => 'indn4117_adminbukuinduk',
            'password' => '4dm1nbuku1nduk',
            'database' => 'indn4117_bukuinduk',
            'dbdriver' => 'mysqli'
        );
        break;
    case "prod":
        $config = array(
            'version' => 'prod',
            'hostname' => 'localhost',
            'username' => 'indn4117_adminbukuinduk',
            'password' => '4dm1nbuku1nduk',
            'database' => 'indn4117_bukuinduk',
            'dbdriver' => 'mysqli'
        );
        break;
    default:
        $config = array(
            'version' => 'envi',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'db_bukuinduk',
            'dbdriver' => 'mysqli'
        );
        break;
}
