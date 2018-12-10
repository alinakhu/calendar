<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
          href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
          integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js">
    </script>
</head>
<body>

<?php

//если форма открылась
//isset Определяет, была ли установлена переменная значением отличным от NULL
if (isset($_POST['register'])) {
    /* Подключение к серверу MySQL */
    $link = mysqli_connect(
        'localhost',  /* Хост, к которому мы подключаемся */
        'root',       /* Имя пользователя */
        'usbw',   /* Используемый пароль */
        'calendar'); /* База данных для запросов по умолчанию */

    //записываем данные в переменные
    $login = htmlspecialchars(strip_tags($_POST['login']));
    $result = mysqli_query($link, "SELECT id FROM users WHERE login = '$login' ");
    $s = mysqli_fetch_assoc($result);
    echo $s['id'];
    if ($s['id'] != '') {
        echo '<b style=" color:red; position: absolute; top:40px; left:437px;" >Ошибка! Данный логин используется другим пользователем.</b>';

    } else {
        $password = htmlspecialchars(strip_tags($_POST['password']));
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $surname = htmlspecialchars(strip_tags($_POST['surname']));

        if (!$link) {
            printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
            exit;
        } else {

            //mysqli_real_escape_string — Экранирует специальные символы в строке для использования в SQL-выражении, используя текущий набор символов соединения
            $query = "INSERT INTO users (name, surname, login, password) VALUES ('" . mysqli_real_escape_string($link, $_POST['name']) . "', '" . mysqli_real_escape_string($link, $_POST['surname']) . "', '" . mysqli_real_escape_string($link, $_POST['login']) . "', '" . mysqli_real_escape_string($link, $_POST['password']) . "')";
            if (!mysqli_set_charset($link, "utf8")) {
                printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error());
            } else {
                mysqli_query($link, $query);
                echo '<b style=" color:green; position: absolute; top:40px; left:545px;" >Поздравляем с регистрацией!</b>';
            }
            /* Закрываем соединение */
            mysqli_close($link);

        }


    }
}

?>
<div class="container">
    <div id="myForm_r" class="panel panel-primary">
        <div class="panel-heading bg"><h1> Регистрация</h1></div>
        <div class="panel-body">
            <form method="post" data-toggle="validator" role="form">

                <div class="form-group">
                    <label for="inputName">Имя:</label>
                    <input class="form-control" type="text" class="form-control" name="name" id="inputName"
                           placeholder="Введите имя" data-error="Поле обязательное" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputSurame">Фамилия:</label>
                    <input class="form-control" type="text" class="form-control" name="surname" id="inputSurname"
                           placeholder="Введите фамилию" data-error="Поле обязательное" required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputLogin">Логин:</label>

                    <input class="form-control" type="text" class="form-control" name="login" id="inputLogin"
                           placeholder="Введите логин" data-error="Поле обязательное" required/>
                    <div class="help-block with-errors"></div>
                </div>


                <div class="form-group">
                    <label class="control-label" for="inputPassword">Пароль:</label>
                    <div class="form-group">
                        <input type="password" name="password" data-minlength="5" class="form-control"
                               id="inputPassword" data-error="Введите минимум 5 символов"
                               placeholder="Введите пароль" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="register">Регистрация</button>
                </div>

                <div class="form-group">
                    <p> Вы уже зарегистрированы? <br/> Авторизация по <a href="login_form.php">Ссылке</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>