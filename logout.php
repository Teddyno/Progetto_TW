<html>
<head>
	<title>Logout</title>
</head>
<body>
<?php
 	/* attiva la sessione */
	session_start();

	/* sessione attiva, la distrugge */
	$sname = session_name();
	$uname = $_SESSION["email"];

	session_unset();
	session_destroy();

	/* ed elimina il cookie corrispondente */
	if (isset($_COOKIE[$sname])) {
		setcookie($sname,'', time()-3600,'/');
	}
?>
<script>
	window.location.href = "index.php";
</script>
</body>
</html>
