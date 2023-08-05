<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

$title = $_POST['title'];
$content = $_POST['content'];

if ($title != null && $title != '') {
    $title = $dbConnect->real_escape_string($title);
} else {
    echo "제목을 입력하세요.";
    echo "<a href='./180_writeForm.php'>작성 페이지로 이동</a>";
    exit;
}

if ($content != null && $content != '') {
    $content = $dbConnect->real_escape_string($content);
} else {
    echo "내용을 입력하세요.";
    echo "<a href='./180_writeForm.php'>작성 페이지로 이동</a>";
    exit;
}

$memberID = $_SESSION['memberID'];
$regDate = time();

// 파일 업로드 처리
$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
$targetFile = $targetDir . basename($_FILES['fileToUpload']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// 파일 업로드 확인
if (!empty($_FILES['fileToUpload']['tmp_name'])) {
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if ($check !== false) {
        echo "파일은 이미지 형식입니다. - " . $check['mime'] . ".";
        $uploadOk = 1;
    } else {
        echo "파일은 이미지 형식이 아닙니다.";
        $uploadOk = 0;
    }
}

// 파일 업로드 크기 제한 (5MB로 설정)
if ($_FILES['fileToUpload']['size'] > 5000000) {
    echo "파일 크기가 너무 큽니다.";
    $uploadOk = 0;
}

// 허용된 파일 형식 (이미지 파일만 허용)
$allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
if (!in_array($imageFileType, $allowedTypes)) {
    echo "허용되지 않는 파일 형식입니다. JPG, JPEG, PNG, GIF 파일만 허용됩니다.";
    $uploadOk = 0;
}

// 파일 업로드 성공 여부 확인
if ($uploadOk == 0) {
    echo "파일 업로드에 실패하였습니다.";
} else {
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
        echo "파일이 성공적으로 업로드 되었습니다.";
    } else {
        echo "파일 업로드 중 오류가 발생하였습니다.";
    }
}

// 파일 이름 저장
$filename = basename($_FILES['fileToUpload']['name']);

// 게시물 저장
$sql = "INSERT INTO board (memberID, title, content, regDate, filename) ";
$sql .= "VALUES ('$memberID', '$title', '$content', '$regDate', '$filename')";
$result = $dbConnect->query($sql);

if ($result) {
    echo "저장 완료<br>";
    echo "<a href='./183_list.php'>게시글 목록으로 이동</a>";
    exit;
} else {
    echo "저장 실패<br>";
    echo "<a href='./183_list.php'>게시글 목록으로 이동</a>";
    exit;
}
?>
