<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
          <title>event</title>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css"> </head>
<body>
	<div id="wrapper">
		<header>
			<h2>ברוכים הבאים למערכת ניהול האירועים של מארק ומעוז</h2>
			<p>במערכת זו תוכלו לבצע הזמנות לאירועים שונים וניהול פנים ארגוני של החברה</p>
		</header>
		<nav>
			<ul>
				<li> <a href="index.php"> עמוד הבית </a></li>
				<li> <a href="customer.php"> רישום לקוח חדש </a></li>
				<li> <a href="orders.php"> הזמנת אירוע </a></li>
				<li> <a href="employees.php"> ניהול עובדים </a></li>
				<li> <a href="event.php" class="boldi"> ניהול אירועים </a></li>
				<li> <a href="hall.php"> ניהול אולמות </a></li>
				<li> <a href="reports.php"> דוחות </a></li>
			</ul>
		</nav>
		<main>
			<?php
			
				$dbhost = "127.0.0.1"; $dbuser = "root"; $dbpass = "1"; $dbname = "Events-Hall";   //create a mySQL DB connection
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);  								//testing connection success
				if ($conn->connect_error) {
    				die("Connection failed: " . $conn->connect_error);
				}
				// Delete Row
				if ($_GET['delete'] != NULL){
				    // sql to delete a record
					$sql = "DELETE FROM Events WHERE Event_ID=" .$_GET['delete'];
					if ($conn->query($sql) === TRUE) {
					    echo "Records are up to date";
					} else {
					    echo "Error deleting record: " . $conn->error;
					}
		    	}
				// Add Row 
				if (!empty($_POST)){
				    // sql to insert a record
				    $s1 = $_POST['Event_ID'];
					$s2 = $_POST['Event_Price'];
				 	$s3 = $_POST['Event_Name'];
				    $sql = "INSERT INTO Events (Event_ID,Event_Price,Event_Name) VALUES ('$s1','$s2','$s3')";
					if ($conn->query($sql) === TRUE) {
					    echo "Record added successfully";
					} else {
					    echo "Error adding record: " . $conn->error;
					}
		    	}
				
				$sql = "SELECT Event_ID, Event_Price, Event_Name FROM Events";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				    echo "<table><tr><th>Event_ID</th><th>Event_Price</th><th>Event_Name</th></tr>";
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo "<tr>
				        		<td>".$row["Event_ID"]."</td>
								<td>".$row["Event_Price"]."</td>
								<td>".$row["Event_Name"]."</td>
								<td id=".$row["Event_ID"]."><a href=event.php?delete=".$row["Event_ID"].">Delete</td>
							</tr>";
				    }
				    echo "</table>";
				} else {
				    echo "0 results";
				}				
				$conn->close();
			?>
			<form action="event.php" method="post">
					<h3> הוספת שורה </h3>
					<h4> יש למלא את כל השדות</h4>
					<p><label>קוד מזהה:<input type="text" name="Event_ID" value="" placeholder="" required ></label></p>
					<p><label>מחיר:<input type="text" name="Event_Price" value="" placeholder="" required ></label></p>
					<p><label>שם מלא:<input type="text" name="Event_Name" value="" placeholder="" required ></label></p>
					<p><input class="myButton" type="submit" value="שלח ◀"></p>
				</form>
		</main>
		<div class="clear"> </div>
	</div>
    </body>
</html>