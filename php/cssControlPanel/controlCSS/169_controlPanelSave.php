<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/php/csscontrolpanel/163_connection.php';

    $selectorName = $_POST['selectorName'];

    if ($selectorName == '') {
      echo '값을 입력하세요.';
    } else {
      $float = $_POST['float'];
      $width = (int) $_POST['width'];
      $height = (int) $_POST['height'];
      $background = $_POST['background'];
      $marginTop = (int) $_POST['marginTop'];
      $marginRight = (int) $_POST['marginRight'];
      $marginBottom = (int) $_POST['marginBottom'];
      $marginLeft = (int) $_POST['marginLeft'];

      // upload 할것
      $sql = "UPDATE controlCSS SET floata='{$float}', width='{$width}', height='{$height}', ";
      $sql .= "background='{$background}', marginTop='{$marginTop}', marginRight='{$marginRight}', ";
      $sql .= "marginBottom='{$marginBottom}', marginLeft='{$marginLeft}' WHERE selectorName='{$selectorName}'";

      $result = $dbConnect->query($sql);

      if ($result) {
        echo "변경 완료";
      } else {
        echo "변경 실패";
      }
    }

    echo '<br>';
    echo "<a href='./index.php'>CSS 디자인 페이지로 이동</a>";
    echo '<br>';
    echo "<a href='./168_controlPanel.php'>CSS 컨트롤 페이지로 이동</a>";
?>
