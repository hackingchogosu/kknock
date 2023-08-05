<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물 보기</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        form {
            display: inline-block;
        }

        textarea {
            width: 100%;
        }

        .comment-form {
            margin-top: 20px;
        }

        .comment-list {
            margin-top: 20px;
        }

        .comment-toggle {
            cursor: pointer;
            color: #007bff;
            font-weight: bold;
            margin-top: 20px;
        }

        .comment-container {
            margin-top: 20px;
        }

        .download-btn {
            display: inline-block;
            margin-right: 10px;
        }

        .content-div {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
        }

        .buttons-div {
            margin-bottom: 20px;
        }

        .buttons-div a {
            margin-right: 10px;
        }

        .comment-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/common/171_session.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/common/179_checkSignSession.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/cssControlPanel/163_connection.php';

if (isset($_GET['boardID']) && (int)$_GET['boardID'] > 0) {
    $boardID = $_GET['boardID'];

    // 게시물 정보 가져오기
    $sql = "SELECT b.boardID, b.title, b.content, m.nickName, b.regDate, b.filename FROM board b ";
    $sql .= "JOIN member m ON (b.memberID = m.memberID) WHERE b.boardID = {$boardID}";
    $result = $dbConnect->query($sql);

    if ($result && $result->num_rows > 0) {
        $postInfo = $result->fetch_assoc();
        $title = $postInfo['title'];
        $content = $postInfo['content'];
        $nickName = $postInfo['nickName'];
        $regDate = $postInfo['regDate'];
        $filename = $postInfo['filename'];

        // 게시물 내용 표시
        echo "<h2>{$title}</h2>";
        echo "<p>작성자: {$nickName}</p>";
        echo "<p>게시일: {$regDate}</p>";
        // 본문 내용 표시
        echo "<div class='content-div'>";
        echo "<p>{$content}</p>";
        echo "</div>"; // content-div 닫기
        // 파일 다운로드 버튼
        if (!empty($filename)) {
            echo "<div class='buttons-div'>";
            echo "<a href='/uploads/{$filename}' class='download-btn' download>파일 다운로드</a>";
        }

        // 수정 버튼
        echo "<a href='/php/board/189_editForm.php?boardID={$boardID}'>게시물 수정</a>";
 // 목록으로 이동 링크 추가
        echo "<a href='/php/board/183_list.php'>목록으로 이동</a>";
        echo "</div>"; // buttons-div 닫기
        // 삭제 버튼
        echo "<form action='/php/board/188_delete.php' method='post'>";
        echo "<input type='hidden' name='boardID' value='{$boardID}'>";
        echo "<input type='submit' value='게시물 삭제'>";
        echo "</form>";

       



        // 댓글 컨테이너 시작
        echo "<div class='comment-container'>";
        echo "<h3 class='comment-toggle' onclick='toggleComments()'>댓글</h3>";

        // 댓글 작성 폼
        echo "<div class='comment-form'>";
        echo "<h3>댓글 작성</h3>";
        echo "<form action='/php/board/192_addComment.php' method='post'>";
        echo "<input type='hidden' name='boardID' value='{$boardID}'>";
        echo "작성자: <input type='text' name='author'><br>";
        echo "댓글 내용: <textarea name='comment' rows='3' cols='30'></textarea><br>";
        echo "<input type='submit' value='댓글 작성'>";
        echo "</form>";
        echo "</div>"; // comment-form 닫기

        // 댓글 목록
        echo "<div class='comment-list'>";
        echo "<h3>댓글 목록</h3>";
        // 댓글 목록을 출력하는 코드 작성

        // 댓글 조회
        $sql = "SELECT * FROM comments WHERE boardID = {$boardID} ORDER BY regDate DESC";
        $result = $dbConnect->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($commentInfo = $result->fetch_assoc()) {
                $commentID = $commentInfo['commentID'];
                $author = $commentInfo['author'];
                $comment = $commentInfo['comment'];
                $commentDate = $commentInfo['regDate'];

                // 댓글 내용 표시
                echo "<div class='comment-item'>";
                echo "<p><strong>{$author}</strong> ({$commentDate}): {$comment}</p>";
                // 댓글 수정 버튼
                echo "<form action='/php/board/194_editComment.php' method='post'>";
                echo "<input type='hidden' name='commentID' value='{$commentID}'>";
                echo "<input type='hidden' name='boardID' value='{$boardID}'>";
                echo "수정 내용: <input type='text' name='comment'><br>";
                echo "<input type='submit' value='댓글 수정'>";
                echo "</form>";
                // 댓글 삭제 버튼
                echo "<form action='/php/board/193_deleteComment.php' method='post'>";
                echo "<input type='hidden' name='commentID' value='{$commentID}'>";
                echo "<input type='hidden' name='boardID' value='{$boardID}'>";
                echo "<input type='submit' value='댓글 삭제'>";
                echo "</form>";
                echo "</div>"; // comment-item 닫기
            }
        } else {
            echo "<p>등록된 댓글이 없습니다.</p>";
        }

        echo "</div>"; // comment-list 닫기

        echo "</div>"; // 댓글 컨테이너 닫기

    } else {
        echo "해당하는 게시물을 찾을 수 없습니다.";
    }
} else {
    echo "잘못된 접근입니다.";
    exit;
}
?>

<script>
    // 댓글 목록 토글 함수
    function toggleComments() {
        const commentList = document.querySelector('.comment-list');
        const commentForm = document.querySelector('.comment-form');
        const commentToggle = document.querySelector('.comment-toggle');

        if (commentList.style.display === 'none') {
            commentList.style.display = 'block';
            commentForm.style.display = 'block';
            commentToggle.textContent = '댓글 닫기';
        } else {
            commentList.style.display = 'none';
            commentForm.style.display = 'none';
            commentToggle.textContent = '댓글';
        }
    }
</script>
</body>
</html>

