<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
    unset($_SESSION['memberID']);
    unset($_SESSION['nickName']);
    echo "로그아웃 되었습니다.";
    echo "<a href='/php/joinLogin/index.php'>메인으로 이동</a>";
?>
