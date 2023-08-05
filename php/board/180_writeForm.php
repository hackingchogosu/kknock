<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
</head>
<body>
  <form name="boardWrite" method="POST" action="181_saveBoard.php" enctype="multipart/form-data">
    제목
    <br>
    <br>
    <input type="text" name="title" required />
    <br>
    <br>
    내용
    <br>
    <br>
    <textarea name="content" cols="80" rows="10" required></textarea>
    <br>
    <br>
    파일 첨부
    <br>
    <br>
    <input type="file" name="fileToUpload">
    <br>
    <br>
    <input type="submit" value="저장" />
  </form>  
</body>
</html>
