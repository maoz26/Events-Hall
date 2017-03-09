<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
          <title>hall</title>
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
				<li> <a href="event.php"> ניהול אירועים </a></li>
				<li> <a href="hall.php" class="boldi"> ניהול אולמות </a></li>
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
					$sql = "DELETE FROM halls WHERE Hall_ID=" .$_GET['delete'];
					if ($conn->query($sql) === TRUE) {
					    echo "Records are up to date";
					} else {
					    echo "Error deleting record: " . $conn->error;
					}
		    	}
				// Add Row 
				if (!empty($_POST)){
				    // sql to insert a record
				    $s1 = $_POST['Hall_ID'];
					$s2 = $_POST['Hall_Name'];
				 	$s3 = $_POST['Hall_Capacity'];
				 	$s4 = $_POST['Hall_Address'];
					$s5 = $_POST['Hall_Price'];
				    $sql = "INSERT INTO halls (Hall_ID,Hall_Name,Hall_Capacity,Hall_Address,Hall_Price) VALUES ('$s1','$s2','$s3','$s4','$s5')";
					if ($conn->query($sql) === TRUE) {
					    echo "Record added successfully";
					} else {
					    echo "Error adding record: " . $conn->error;
					}
		    	}
				
				$sql = "SELECT Hall_ID, Hall_Name, Hall_Capacity, Hall_Address, Hall_Price FROM halls";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				    echo "<table><tr>
				    				<th>Hall_ID</th>
				    				<th>Hall_Name</th>
				    				<th>Hall_Capacity</th>
				    				<th>Hall_Address</th>
				    				<th>Hall_Price</th>
				    			</tr>";
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo "<tr>
				        		<td>".$row["Hall_ID"]."</td>
								<td>".$row["Hall_Name"]."</td>
								<td>".$row["Hall_Capacity"]."</td>
								<td>".$row["Hall_Address"]."</td>
								<td>".$row["Hall_Price"]."</td>
								<td id=".$row["Hall_ID"]."><a href=hall.php?delete=".$row["Hall_ID"].">Delete</td>
							</tr>";
				    }
				    echo "</table>";
				} else {
				    echo "0 results";
				}				
				$conn->close();
			?>
			<form action="hall.php" method="post">
					<h3> הוספת שורה </h3>
					<h4> יש למלא את כל השדות</h4>
					<p><label>קוד מזהה:<input type="number" name="Hall_ID" value="" placeholder="" required ></label></p>
					<p><label>שם:<input type="text" name="Hall_Name" value="" placeholder="" required ></label></p>
					<p><label>כמות מקומות:<input type="number" name="Hall_Capacity" value="" placeholder="" required ></label></p>
					<p><label>כתובת:<input type="text" name="Hall_Address" value="" placeholder="" required ></label></p>
					<p><label>מחיר:<input type="number" name="Hall_Price" value="" placeholder="" required ></label></p>
					<p><input class="myButton" type="submit" value="שלח ◀"></p>
				</form>
		</main>
		<div class="clear"> </div>
	</div>
    </body>
</html>