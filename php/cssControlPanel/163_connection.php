<?php
    $host = "localhost";
    $user = "userid";
    $pw = "1234";
    $dbName = "your_database_name";
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect->set_charset("utf8");

    if (mysqli_connect_errno()) {
      echo "데이터베이스 접속 실패";
    }
?>
