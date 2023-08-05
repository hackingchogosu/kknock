
<?php
  include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

  if (isset($_POST['boardID']) && (int)$_POST['boardID'] > 0 && isset($_POST['title']) && isset($_POST['content'])) {
    $boardID = $_POST['boardID'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 게시물 업데이트 처리
    $sql = "UPDATE board SET title = '{$title}', content = '{$content}' WHERE boardID = {$boardID}";
    $result = $dbConnect->query($sql);

    if ($result) {
      echo "게시물이 수정되었습니다. <a href='/php/board/185_view.php?boardID={$boardID}'>게시물 확인하기</a>";
    } else {
      echo "게시물 수정에 실패했습니다. <a href='/php/board/185_view.php?boardID={$boardID}'>이전으로 돌아가기</a>";
    }
  } else {
    echo "잘못된 접근입니다.";
    exit;
  }
?>
