<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

    $email = $_POST['userEmail'];
    $pw = $_POST['userPw'];

    function goSignInPage($alert) {
      echo $alert.'<br>';
      echo "<a href='./175_signInForm.php'>로그인 폼으로 이동</a>";
      return;
    }

    // 유효성 검사
    // 이메일 검사
    if(!filter_Var($email, FILTER_VALIDATE_EMAIL)) {
      goSignInPage('올바른 이메일이 아닙니다.');
      exit;
    }

    // 비밀번호 검사
    if($pw == null || $pw == '') {
      goSignInPage('비밀번호를 입력해 주세요.');
      exit;
    }

    $pw = sha1('php200'.$pw);

    $sql = "SELECT email, nickName, memberID FROM member WHERE email = '{$email}' AND pw = '{$pw}'";
    $result = $dbConnect->query($sql);

    if($result) {
      if($result->num_rows == 0) {
        goSignInPage('로그인 정보가 일치하지 않습니다.');
        exit;
      } else {
        $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['memberID'] = $memberInfo['memberID'];
        $_SESSION['nickName'] = $memberInfo['nickName'];
        Header("Location:../index.php");
      }
    } 
?>
