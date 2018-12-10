<?php 
session_start(); 
?> 
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <title>Авторизация</title>
   <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-1.12.4.js">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js">
        </script>
 
</head>
<body>
	
	<?php 
		if(isset($_POST['loginb'])){

		//записываем данные в переменные
			$login = htmlspecialchars(strip_tags($_POST['login']));
			$password = htmlspecialchars(strip_tags($_POST['password']));

			$isError = false;
			

			if(!$isError){
					
				/* Подключение к серверу MySQL */ 
				$link = mysqli_connect( 
			      	'localhost',  /* Хост, к которому мы подключаемся */ 
			        'root',       /* Имя пользователя */ 
			        'usbw',   /* Используемый пароль */ 
			        'calendar'); /* База данных для запросов по умолчанию */ 
				
				//очищаем переменную пользователя
				$_SESSION['user_id'] = '';
				/*посылаем запрос к серверу*/
				if($result = mysqli_query($link,"SELECT id FROM users WHERE login ='".mysqli_real_escape_string($link,$_POST['login'])."' AND password='".mysqli_real_escape_string($link,$_POST['password'])."' ")){

					/*выборка результатов запроса*/
					while( $row = mysqli_fetch_assoc($result)){
					$_SESSION['user_id'] = $row['id'];
					}

					/*освобождаем используемую память*/
					if($_SESSION['user_id']!=''){
						header('Location: profile.php');
					} else {
						echo'<b style=" color:red; position: absolute; top:40px; left:490px;" >Ошибка! Повторите попытку или зарегистрируйтесь.</b>';
					}
				}
			}
					
		}
	?>
		<div class="container">
   		  <div id="myForm_l" class="panel panel-primary" >
        	 <div class="panel-heading bg"><h1> Авторизация</h1></div>
         		<div class="panel-body">
  				  <form method="post" data-toggle="validator" role="form">

  				  	<div class="form-group" >
				          <label for="inputLogin">Логин:</label>

				          <input class="form-control" type="text" class="form-control" name="login" id="inputLogin" placeholder="Введите логин" data-error="Поле обязательное" required />
				          <div class="help-block with-errors"></div>
			        </div>

			        
			        <div class="form-group">
				          <label class="control-label" for="inputPassword">Пароль:</label>
				          <div class="form-group">
				            <input type="password" name="password" data-minlength="5" class="form-control" id="inputPassword" data-error="Введите минимум 5 символов" placeholder="Введите пароль" required>
			             	<div class="help-block with-errors"></div>
			           	</div>
			        </div>
	
			
			  		<button type="submit" class="btn btn-primary" name="loginb" >Вход</button>

			  		 <div class="form-group">
                         <p> Вы еще не зарегистрированы?<br/>
                         Регистрация по <a href="index.php">Ссылке</a></p>
				        </div>
			</form>
     </div>
    </div>
  </div>
</body>
</html>