<?php
  // 로그인하지 않은 경우
  if(!isset($_SESSION['memberID'])){
    // 회원가입 또는 로그인 필요
    Header("Location: /php/joinLogin/index.php");
    exit;
  }
?>
