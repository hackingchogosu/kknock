<?php
if(isset($_GET['filename']) && !empty($_GET['filename'])) {
    $filename = $_GET['filename'];
    $filepath = $_SERVER['DOCUMENT_ROOT'] . '/var/www/html/uploads/' . $filename;

    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "파일이 존재하지 않습니다.";
    }
} else {
    echo "파일 정보가 없습니다.";
}
?>
