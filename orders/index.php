<?php  
    session_start();
    $db = new PDO("mysql:host=localhost;dbname=mydata;charset=UTF8", "db_user", "gh!044PPT", array(PDO::ATTR_PERSISTENT=>true));
    $session_on = false;
    if (isset($_SESSION["email"])){
        $session_on = true;
    }
    if(isset($_GET["order"])){
        $name = $_GET["name"];
        $phone = $_GET["phone"];
        $time = $_GET["date"]." ".$_GET["select"];
        $stt = $db->prepare("INSERT INTO orders (name, phone, time) VALUES (?,?,?)");
        $stt->bindParam(1, $name);
        $stt->bindParam(2, $phone);
        $stt->bindParam(3, $time);
        $stt->execute();
    }
    elseif(isset($_GET["delete"])){
        $delete = $_GET["delete"];
        $stt = $db->prepare("DELETE FROM orders WHERE id = ?");
        $stt->bindParam(1, $delete);
        $stt->execute();
    }
    $stt = $db->prepare("SELECT * FROM orders");
    $stt->execute();
    $data = $stt->fetchAll(PDO::FETCH_NUM);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
     <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
            <img src="/img/logo8.png" alt="">
                <h1>Детский центр Лисёнок Ники</h1>
            </div>
        </div>
    </header>
    <main class="container">
        <h2>Дни приёма: <span>Вторник, Четверг</span></h2>
        <h3>Время приёма: <span>17:00-19:00</span></h3>
        <hr>
        <div class="main-content">
            <div class="left">
                <form action="">
                    <h2>Запись</h2>
                    <input type="hidden" name="order" value="1">
                    <input type="text" placeholder="Ваше имя" name="name">
                    <input type="text" placeholder="Номер телефона" name="phone">
                    <label for="date">Выберите дату</label>
                    <input type="date" id="date" name="date">
                    <label for="select">Выберите время</label>
                    
                    <select name="select" id="select">
                        <option value="18:00:00">15:00</option>
                        <option value="18:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                        <option value="18:00:00">18:00</option>
                    </select>
                    <button>Отправить</button>
                </form>
            </div>
            <div class="right">
                <h2>Записи</h2>
                <ol class="list">
                    <?php for($i = 0; $i < count($data); $i++): ?>
                        <li>
                            <?php if($session_on):  ?>
                            <?php echo $data[$i][1]." ".$data[$i][2]."<br>".date("d.m.Y H:i", strtotime($data[$i][3])) ?>
                            <a href="?delete=<?php echo $data[$i][0]?>"> &times; </a>
                            <?php else: ?>
                            <?php echo date("d.m.Y H:i", strtotime($data[$i][3]))?> <br>

                            <?php endif; ?>
                        </li>
                    <?php endfor; ?>
                </ol>
            </div>
        </div>
        
    </main>
</body>
</html>