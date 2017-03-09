<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>home page</title>
	<link href="includes/stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrapper">
		<header>
			<h2>ברוכים הבאים למערכת ניהול האירועים של מארק ומעוז</h2>
			<p>במערכת זו תוכלו לבצע הזמנות לאירועים שונים וניהול פנים ארגוני של החברה</p>
		</header>
		<nav>
			<ul>
				<li> <a href="index.php"> עמוד הבית </a></li>
				<li> <a href="customer.php" class="boldi"> רישום לקוח חדש </a></li>
				<li> <a href="orders.php"> הזמנת אירוע </a></li>
				<li> <a href="employees.php"> ניהול עובדים </a></li>
				<li> <a href="event.php"> ניהול אירועים </a></li>
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
					$sql = "DELETE FROM Customers WHERE Customer_ID=" .$_GET['delete'];
					if ($conn->query($sql) === TRUE) {
					    echo "Records are up to date";
					} else {
					    echo "Error deleting record: " . $conn->error;
					}
		    	}
				// Add Row 
				if (!empty($_POST)){
				    // sql to insert a record
				    $s1 = $_POST['Customer_ID'];
					$s2 = $_POST['First_Name'];
				 	$s3 = $_POST['Last_Name'];
					$s4 = $_POST['Phone_Number'];
					$s5 = $_POST['Address'];
					$s6 = $_POST['Email'];
				    $sql = "INSERT INTO Customers (Customer_ID,First_Name,Last_Name,Phone_Number,Address,Email) VALUES ('$s1','$s2','$s3','$s4','$s5','$s6')";
					if ($conn->query($sql) === TRUE) {
					    echo "Record added successfully";
					} else {
					    echo "Error adding record: " . $conn->error;
					}
		    	}
				
				$sql = "SELECT Customer_ID, First_Name, Last_Name, Phone_Number, Address, Email FROM Customers";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				    echo "<table><tr><th>Customer_ID</th><th>First_Name</th><th>Last_Name</th><th>Phone_Number</th><th>Address</th><th>Email</th></tr>";
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo "<tr>
				        		<td>".$row["Customer_ID"]."</td>
								<td>".$row["First_Name"]."</td>
								<td>".$row["Last_Name"]."</td>
								<td>".$row["Phone_Number"]."</td>
								<td>".$row["Address"]."</td>
								<td>".$row["Email"]."</td>
								<td id=".$row["Customer_ID"]."><a href=customer.php?delete=".$row["Customer_ID"].">Delete</td></tr>";
				    }
				    echo "</table>";
				} else {
				    echo "0 results";
				}				
				$conn->close();
			?>
			<form action="customer.php" method="post">
					<h3> הוספת שורה </h3>
					<h4> יש למלא את כל השדות</h4>
					<p><label>קוד מזהה:<input type="text" name="Customer_ID" value="" placeholder="" required ></label></p>
					<p><label>שם פרטי:<input type="text" name="First_Name" value="" placeholder="" required ></label></p>
					<p><label>שם משפחה:<input type="text" name="Last_Name" value="" placeholder="" required ></label></p>
					<p><label>טלפון:<input type="text" name="Phone_Number" value="" placeholder="" required ></label></p>
					<p><label>כתובת:<input type="text" name="Address" value="" placeholder="" required ></label></p>
					<p><label>אימייל:<input type="text" name="Email" value="" placeholder="" required ></label></p>
					<p><input class="myButton" type="submit" value="שלח ◀"></p>
				</form>
		</main>
		<div class="clear"> </div>
	</div>
    </body>
</html>