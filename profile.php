<?php 
session_start();
	if(!isset($_SESSION['user_id'])||$_SESSION['user_id']==''){
		header('Location: login_form.php');
	}
?>
<?php
require_once "config.php";
require_once "function.php";
$id_user = $_SESSION['user_id'];
$events = get_events($id_user);
$events = get_json($events);

if (!empty($_POST['clickDate'])){
	print_r($_POST);
	die;
}

if(isset($_POST['addEvent'])){
	//записываем данные в переменные
		$ntitle = htmlspecialchars(strip_tags($_POST['title']));
		$nstart = htmlspecialchars(strip_tags($_POST['start']));
		$nend = htmlspecialchars(strip_tags($_POST['end']));
		if(($nstart !="")&&($ntitle!="") )
		{
			if($nend=="" || ($nend<$nstart))
					{
						$nend = $nstart;
					}
			$events = set_events($ntitle,$nstart,$nend,$id_user);
			$events = get_json($events);
		}	
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>FullCalendar</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
	<link rel="stylesheet" href="fc/fullcalendar.css" />
	<link rel="stylesheet" href="fc/fullcalendar.print.css" / media="print">
	<link rel="stylesheet" href="css/jquery-ui.css" />
    <link rel="stylesheet" href="css/style.css" />
	<script src="fc/lib/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
</head>
<body>
	<?php if(isset($_POST['logout'])){
		//очищаем переменную пользователя
				$_SESSION['user_id'] = '';
				header('Location: login_form.php');
	}
	?>
<form action="" method="post">
		<input type="submit"  class="btn btn-primary" name="logout" value="Выход">
	</form>
<div id="calendar" style="max-width: 700px;"></div>
<script> var events = <?php echo $events ?>;</script>

<div id="dialog"  >
	  	<form method="post" >
			  <div class="form-group">
				    <label for="title">Название события:</label>
				    <input type="text" class="form-control" id="title" name="title"  placeholder="Название события">
			  </div>
			    <div class="form-group">
				    <label for="start">Начало события:</label>
				    <input type="text" class="form-control datepicker" id="start" name="start" placeholder="Начало события">
			  </div>
			    <div class="form-group">
				    <label for="end">Конец события:</label>
				    <input type="text" name="end" class="form-control datepicker" id="end" placeholder="Конец события ">
			  </div>
			  <button type="submit" class="btn btn-success" name="addEvent">Добавить событие</button>
	</form>
</div>


<script src="fc/lib/moment.min.js"></script>
<script src="fc/fullcalendar.js"></script>
<script src="fc/locale-all.js"></script>
<script src="js/main.js"></script>
</body>
</html>