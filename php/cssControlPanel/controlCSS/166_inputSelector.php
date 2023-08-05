<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/php/csscontrolpanel/163_connection.php';

    $selectorList = array();
    $selectorList = ['wrap', 'header', 'leftArea', 'rightArea', 'footer'];

    foreach ($selectorList as $sl) {
      $sql = "INSERT INTO controlCSS (selectorName, floata, width, height, background, ";
      $sql .= "marginTop, marginRight, marginBottom, marginLeft) ";
      $sql .= "VALUES ('{$sl}', 'unset',0,0,'',0,0,0,0)";
      $result = $dbConnect->query($sql);

      if ($result) {
        echo "셀렉터 {$sl} 입력 성공";
      } else {
        echo "셀렉터 {$sl} 입력 실패";
      }
      echo "<br>";
    }
?>
