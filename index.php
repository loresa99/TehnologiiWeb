<html>
<head>
	<title>GLAMMY</title>
	<?php
		session_start();
		include 'db_connection.php';
		initializeDatabase();
		if (!isset($_SESSION['tw_id'])) {
			header("location: http://localhost/TehnologiiWeb/header/login.php");
		}
	?>
</head>
	<frameset rows="50px,*" border="0">
		<frame name="header" src="header/header.php"> </frame>
		<frame name="content" src="content.php"> </frame>
	</frameset>
</html>