<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['boardID']) && isset($_POST['author']) && isset($_POST['comment'])) {
        $boardID = (int)$_POST['boardID'];
        $author = $_POST['author'];
        $comment = $_POST['comment'];

        // 입력값 검증 (추가적인 검증도 필요할 수 있음)
        if (empty($author) || empty($comment)) {
            echo "작성자와 댓글 내용을 모두 입력해주세요.";
            exit;
        }

        // 댓글 데이터베이스에 추가
        $sql = "INSERT INTO comments (boardID, author, comment, regDate) ";
        $sql .= "VALUES ('{$boardID}', '{$author}', '{$comment}', NOW())";

        if ($dbConnect->query($sql)) {
            header("Location: /php/board/185_view.php?boardID={$boardID}");
            exit;
        } else {
            echo "댓글 추가에 실패했습니다. 다시 시도해주세요.";
            exit;
        }
    } else {
        echo "잘못된 접근입니다.";
        exit;
    }
} else {
    echo "잘못된 접근입니다.";
    exit;
}
?>
