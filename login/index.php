<?php
    session_start();
    $db = new PDO("mysql:host=localhost;dbname=mydata;charset=UTF8", "db_user", "gh!044PPT", array(PDO::ATTR_PERSISTENT=>true));
    if (isset($_POST["login"])){
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        $stt = $db->prepare("SELECT password FROM users WHERE email = ?");
        $stt->bindParam(1, $email);
        $stt->execute();
        $data = $stt->fetch();
        if (count($data) > 0){
            if ($data[0] == $password){
                $_SESSION["email"] = $email;
                header("Location: /orders/");
            }
        } 
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
        <div class="container">
            <div class="header-content">
            <img src="/img/logo8.png" alt="">
                <h1>Детский центр Лисёнок</h1>
            </div>
        </div>
    </header>
    <main class="container">
        <form action="" method="POST" class="login">
            <input type="email" name="email" placeholder="Ваш email" id="email">
            <input type="password" name="password" placeholder="Ваш пароль" id="password">
            <input type="submit" value="Войти">
            <input type="hidden" name="login" value="1">
        </form>
    </main>
</body>
</html>