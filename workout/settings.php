<?php
    session_start();
    $db = new PDO("mysql:host=localhost;dbname=mydata;charset=UTF8", "db_user", "gh!044PPT", array(PDO::ATTR_PERSISTENT=>true));
?>