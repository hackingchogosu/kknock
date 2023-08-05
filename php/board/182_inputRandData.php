<?php
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

  for($i = 1; $i <= 50; $i++) {
    $time = time();
    $sql = "INSERT INTO board (memberID, title, content, regDate) ";
    $sql .= "VALUES (5, '{$i}번째 제목', '{$i}번째 내용', {$time})";
    $result = $dbConnect->query($sql);
    if($result) {
      echo "{$i}번째 데이터 입력완료";
    } else {
      echo "{$i}번째 데이터 입력실패";
    }
  }
?>
