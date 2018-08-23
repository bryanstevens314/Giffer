<?php
require_once 'phpMyAdmin/class.order.php';
include_once 'phpMyAdmin/orderconfig.php';
require_once 'phpMyAdmin/class.url.php';
include_once 'phpMyAdmin/URLConfig.php';
$newURL = new URL();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
echo "Hello World!";
$url = $_REQUEST['firstName'];

    echo $url;
    $newURL->newURL($url);
    header("Location: https://giffer-stevens-apps.c9users.io/add.php");
  }
?>


