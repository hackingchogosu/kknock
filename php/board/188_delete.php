<?php
  include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
  include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

  if (isset($_POST['boardID']) && (int)$_POST['boardID'] > 0) {
    $boardID = $_POST['boardID'];

    // 삭제 쿼리 실행
    $sql = "DELETE FROM board WHERE boardID = {$boardID}";
    $result = $dbConnect->query($sql);

    if ($result) {
      echo "게시물이 삭제되었습니다. <a href='/php/board/183_list.php?page=1'>목록으로 이동</a>";
    } else {
      echo "게시물 삭제에 실패했습니다. <a href='/php/board/185_view.php?boardID={$boardID}'>이전으로 돌아가기</a>";
    }
  } else {
    echo "잘못된 접근입니다.";
    exit;
  }
?>


