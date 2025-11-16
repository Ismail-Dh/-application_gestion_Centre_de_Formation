<?php

  $db_conn = mysqli_connect('localhost', 'root', '','centre_de_formation');

  if (!$db_conn) {
    echo 'Connection echoe';
    exit;
  }
  
?>