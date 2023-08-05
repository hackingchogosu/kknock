<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

if (isset($_GET['boardID']) && (int)$_GET['boardID'] > 0) {
    $boardID = $_GET['boardID'];

    // 게시물 정보 가져오기
    $sql = "SELECT b.boardID, b.title, b.content, m.nickName FROM board b ";
    $sql .= "JOIN member m ON (b.memberID = m.memberID) WHERE b.boardID = {$boardID}";
    $result = $dbConnect->query($sql);

    if ($result && $result->num_rows > 0) {
        $postInfo = $result->fetch_assoc();
        $title = $postInfo['title'];
        $content = $postInfo['content'];
        $nickName = $postInfo['nickName'];

        // 수정 폼 표시
        echo "<h2>게시물 수정</h2>";
        echo "<form action='/php/board/190_update.php' method='post'>";
        echo "<input type='hidden' name='boardID' value='{$boardID}'>";
        echo "제목: <input type='text' name='title' value='{$title}'><br>";
        echo "내용: <textarea name='content' rows='5' cols='50'>{$content}</textarea><br>";
        echo "<input type='submit' value='수정'>";
        echo "</form>";

        // 취소 링크 추가
        echo "<a href='/php/board/185_view.php?boardID={$boardID}'>취소</a>";
    } else {
        echo "해당하는 게시물을 찾을 수 없습니다.";
    }
} else {
    echo "잘못된 접근입니다.";
    exit;
}
?>
