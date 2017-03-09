<?php
		$dbhost = "127.0.0.1"; $dbuser = "root"; $dbpass = "1"; $dbname = "Events-Hall";   //create a mySQL DB connection
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);  								//testing connection success
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
          <title>home page</title>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css"> </head>
<body>
	<div id="wrapper">
		<header>
			<h2>ברוכים הבאים למערכת ניהול האירועים של מארק ומעוז</h2>
			<p>במערכת זו תוכלו לבצע הזמנות לאירועים שונים וניהול פנים ארגוני של החברה</p>
		</header>
		<nav>
			<ul>
				<li> <a href="index.php" class="boldi"> עמוד הבית </a></li>
				<li> <a href="customer.php"> רישום לקוח חדש </a></li>
				<li> <a href="orders.php"> הזמנת אירוע </a></li>
				<li> <a href="employees.php"> ניהול עובדים </a></li>
				<li> <a href="event.php"> ניהול אירועים </a></li>
				<li> <a href="hall.php"> ניהול אולמות </a></li>
				<li> <a href="reports.php"> דוחות </a></li>
			</ul>
		</nav>
		<main>
			<section class="hall_pic">
				<img src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("images/Hall.jpg")); ?>'>
			</section>
		</main>
		<div class="clear"> </div>
	</div>
    </body>
</html>

<?php
//close DB connection mysqli_close($connection);
?>