<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

$email = $_POST['userEmail'];
$nickName = $_POST['userNickName'];
$pw = $_POST['userPw'];
$birthYear = (int) $_POST['birthYear'];
$birthMonth = $_POST['birthMonth'];
$birthDay = $_POST['birthDay'];

function goSignUpPage($alert) {
  echo $alert.'<br>';
  echo "<a href='./173_signUpForm.php'>회원가입 폼으로 이동</a>";
  return;
}

// 유효성 검사
// 이메일 검사
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  goSignUpPage('올바른 이메일이 아닙니다.');
  exit;
}

// 한글로 구성되어 있는지 정규식 검사
$nickNameRegPattern = '/^[가-힣]{1,}$/';
  if (!preg_match($nickNameRegPattern, $nickName, $matches)) {
  goSignUpPage('닉네임은 한글로만 입력해 주세요.');
  exit;
}

// 비밀번호 검사
if ($pw == null || $pw == '') {
  goSignUpPage('비밀번호를 입력해 주세요');
  exit;
}

$pw = sha1('php200'.$pw);

// 생년 검사
if($birthYear == 0) {
  goSignUpPage('태어난 해를 정확히 입력해 주세요.');
  exit;
}

// 태어난 월 검사
if($birthMonth == 0) {
  goSignUpPage('태어난 달을 정확히 입력해 주세요.');
  exit;
}

// 태어난 날 검사
if($birthDay == 0) {
  goSignUpPage('태어난 일을 정확히 입력해 주세요.');
  exit;
}

$birth = $birthYear.'-'.$birthMonth.'-'.$birthDay;

// 이메일 중복 검사
$isEmailCheck = false;

$sql = "SELECT email FROM member WHERE email = '{$email}'";
$result = $dbConnect->query($sql);

if($result) {
  $count = $result->num_rows;
  if($count == 0) {
    $isEmailCheck = true;
  } else {
    echo "이미 존재하는 이메일 입니다.";
    goSignUpPage();
    exit;
  }
} else {
  echo "에러발생 : 관리자 문의 요망";
  exit;
}

// 닉네임 중복 검사
  $isNickNameCheck = false;

  $sql = "SELECT nickName FROM member WHERE nickname = '{$nickName}'";
  $result = $dbConnect->query($sql);

  if($result) {
    $count = $result->num_rows;
    if($count == 0) {
      $isNickNameCheck = true;
    } else {
      goSignUpPage('이미 존재하는 닉네임 입니다.');
      exit;
    }
  } else {
      echo "에러발생 : 관리자 문의 요망.";
      exit;
    }

    if($isEmailCheck == true && $isNickNameCheck == true) {
      $regDate = time();
      $sql = "INSERT INTO member(email, nickName, pw, birthday, regDate)";
      $sql .= "VALUES('{$email}', '{$nickName}', '{$pw}', '{$birth}', {$regDate})";
      $result = $dbConnect->query($sql);

      if($result) {
        $_SESSION['memberID'] = $dbConnect->insert_id;
        $_SESSIOn['nick Name'] = $nickName;
        Header("Location:../index.php");
      } else {
        goSignUpPage('회원가입 실패 - 관리자엑 문의');
        exit;
      }
    } else {
      goSignUpPage('이메일 또는 닉네임이 중복값입니다.');
      exit;
    }
    ?>
