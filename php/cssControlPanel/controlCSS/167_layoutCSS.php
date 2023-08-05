<?php
    header("Content-type: text/css");

    include_once $_SERVER['DOCUMENT_ROOT'] . '/php/csscontrolpanel/163_connection.php';

    $sql = "SELECT * FROM controlCSS";
    $result = $dbConnect->query($sql);

    $dataCount = $result->num_rows;

    $cssSource = '';

    for ($i = 0; $i < $dataCount; $i++) {
      $cssInfo = $result->fetch_array(MYSQLI_ASSOC);
      $cssSource .= "#" . $cssInfo['selectorName'] . "{float:" . $cssInfo['floata'] . "; width:" . $cssInfo['width'] . "px; ";
      $cssSource .= "height:" . $cssInfo['height'] . "px; background:" . $cssInfo['background'] . "; margin-yop:" . $cssInfo['marginTop'] . "px; ";
      $cssSource .= "margin-right:" . $cssInfo['marginRight'] . "px; margon-bottom:" . $cssInfo['marginBottom'] . "px; ";
      $cssSource .= "margin-left:" . $cssInfo['marginLeft'] . "px;}";
    }

    echo $cssSource;
?>
