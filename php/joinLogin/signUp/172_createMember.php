<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/php/cssControlPanel/163_connection.php';

    $sql = "CREATE TABLE member (memberID int(10) unsigned NOT NULL AUTO_INCREMENT, ";
    $sql .= "email varchar(40) UNIQUE NOT NULL, nickname varchar(20) NOT NULL, ";
    $sql .= "pw varchar(100) DEFAULT NULL, birthday varchar(10) NOT NULL, ";
    $sql .= "regDate int(11) NOT NULL, PRIMARY KEY (memberID)) CHARSET = utf8";

    $result = $dbConnect->query($sql);

    if ($result) {
      echo "테이블 생성 완료";
    } else {
      echo "테이블 생성 실패";
    }
?>
