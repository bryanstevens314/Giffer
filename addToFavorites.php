<?php
require_once 'phpMyAdmin/class.order.php';
include_once 'phpMyAdmin/orderconfig.php';
require_once 'phpMyAdmin/class.url.php';
include_once 'phpMyAdmin/URLConfig.php';
$URLs = new URL();
date_default_timezone_set('America/Los_Angeles');


  if (is_numeric($_GET['url'])) {
      $url = $_GET['url'];
      $pageNum = $_GET['pageNum'];
      $uid = $_GET['id'];
      
    echo $url;
    $newURL->addFavorite($url,$uID);
    header("Location: https://giffer-stevens-apps.c9users.io/index.php/pageNum=" + $pageNum);
  }
  ?>