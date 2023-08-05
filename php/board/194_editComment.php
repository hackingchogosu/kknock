<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['commentID']) && (int)$_POST['commentID'] > 0 && isset($_POST['comment'])) {
        $commentID = (int)$_POST['commentID'];
        $comment = $_POST['comment'];

        // 댓글 수정
        $sql = "UPDATE comments SET comment = '{$comment}' WHERE commentID = {$commentID}";

        if ($dbConnect->query($sql)) {
            // 댓글이 수정되면 댓글이 속한 게시물의 페이지로 이동
            header("Location: /php/board/185_view.php?boardID={$_POST['boardID']}");
            exit;
        } else {
            echo "댓글 수정에 실패했습니다. 다시 시도해주세요.";
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
