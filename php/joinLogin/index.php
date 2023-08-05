<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/common/171_session.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
</head>
<body>
  <?php
  if (!isset($_SESSION['memberID'])) {
  ?>
  <a href="signUp/173_signUpForm.php">회원가입</a>
  <br>
  <a href="signIn/175_signInForm.php">로그인</a>

  <?php
  } else {
  ?>
  <a href="../board/183_list.php">게시판</a>
  <br>
  <a href="signIn/177_signOut.php">로그아웃</a>
  <?php
  }
  ?>
</body>
</html>
