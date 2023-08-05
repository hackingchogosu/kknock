<?php
    $host = "localhost";
    $user = "root";  // 본인의 아이디로 설정
    $pw = "1234";  // 본인의 비밀번호로 설정

    $dbConnect = new mysqli($host, $user, $pw);

    $dbConnect->set_charset("utf8");

    if (mysqli_connect_errno()) {
      echo "데이터베이스 접속 실패";
    } else {
      $sql = "CREATE DATABASE phpexample";
      $result = $dbConnect->query($sql);

      if ($result) {
        echo "데이터베이스 생성 완료";
      } else {
        echo "데이터베이스 생성 실패";
      }
    }
?>
