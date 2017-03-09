<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
          <title>orders</title>
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
				<li> <a href="orders.php" class="boldi"> הזמנת אירוע </a></li>
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
			?>
			<form action="orders.php" method="post" >
					<h3> הזמנת אירוע </h3>
					<h4> יש לדייק בפרטים כדי להנות מאירוע מושלם </h4>
					
					<p><label>מספר הזמנה:<input type="number" name="Order_ID" value="" placeholder="" required ></label></p>
					<p><label>בחר לקוח:<select name='Customer_ID'>
							<?php
								$sql = "SELECT Customer_ID, First_Name FROM Customers";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								        echo "<option value='".$row["Customer_ID"]."'>".$row["First_Name"]."</option>";
									}
								} echo "0 results";		
							?>					
					</select></label></p>
					
					<p><label>בחר אירוע:<select name='Event_ID'>
							<?php
								$sql = "SELECT Event_ID, Event_Name FROM Events";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								        echo "<option value='".$row["Event_ID"]."'>".$row["Event_Name"]."</option>";
									}
								} echo "0 results";		
							?>					
					</select></label></p>
					
					<p><label>בחר אולם:<select name='Hall_ID'>
							<?php
								$sql = "SELECT Hall_ID, Hall_Name FROM halls";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								        echo "<option value='".$row["Hall_ID"]."'>".$row["Hall_Name"]."</option>";
									}
								} echo "0 results";		
							?>					
					</select></label></p>
					
					<p><label>בחר תפריט:<select name='Menu_ID'>
							<?php
								$sql = "SELECT Menu_ID, Menu_Name FROM menus";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								        echo "<option value='".$row["Menu_ID"]."'>".$row["Menu_Name"]."</option>";
									}
								} echo "0 results";		
							?>					
					</select></label></p>
	
					<p><label>הזן תאריך:<input type="date" name="Date" value="" placeholder="" required ></label></p>
					<p><label>כמות אורחים:<input type="number" name="Participants" value="" placeholder="" required ></label></p>
					<p><input class="myButton" type="submit" value="שלח ◀"></p>
			</form>
			<?php
			// Delete Row
				if ($_GET['delete'] != NULL){
				    // sql to delete a record
					$sql = "DELETE FROM orders WHERE Order_ID=" .$_GET['delete'];
					if ($conn->query($sql) === TRUE) {
					    echo "Records are up to date";
					} else {
					    echo "Error deleting record: " . $conn->error;
					}
		    	}
				// Add Row 
				if (!empty($_POST)){
				    // sql to insert a record
				    $s1 = $_POST['Order_ID'];
					$s2 = $_POST['Customer_ID'];
				 	$s3 = $_POST['Event_ID'];
				 	$s4 = $_POST['Hall_ID'];
					$s5 = $_POST['Menu_ID'];
					$s6 = $_POST['Date'];
					$s7 = $_POST['Participants'];
				    $sql = "INSERT INTO orders (Order_ID,Customer_ID,Event_ID,Hall_ID,Menu_ID,Date,Participants) VALUES ('$s1','$s2','$s3','$s4','$s5','$s6','$s7')";
					if ($conn->query($sql) === TRUE) {
					    echo "Record added successfully";
					} else {
					    echo "Error adding record: " . $conn->error;
					}
		    	}
				
				$sql = "SELECT Order_ID, Customer_ID, Event_ID, Hall_ID, Menu_ID, Date, Participants FROM orders";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				    echo "<table><tr>
				    				<th>Order_ID</th>
				    				<th>Customer_ID</th>
				    				<th>Event_ID</th>
				    				<th>Hall_ID</th>
				    				<th>Menu_ID</th>
				    				<th>Date</th>
				    				<th>Participants</th>
				    			</tr>";
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo "<tr>
				        		<td>".$row["Order_ID"]."</td>
								<td>".$row["Customer_ID"]."</td>
								<td>".$row["Event_ID"]."</td>
								<td>".$row["Hall_ID"]."</td>
								<td>".$row["Menu_ID"]."</td>
								<td>".$row["Date"]."</td>
								<td>".$row["Participants"]."</td>
								<td id=".$row["Order_ID"]."><a href=orders.php?delete=".$row["Order_ID"].">Delete</td>
							</tr>";
				    }
				    echo "</table>";
				} else {
				    echo "0 results";
				}				
				$conn->close();
			?>
		</main>
		<div class="clear"> </div>
	</div>
    </body>
</html>

<?php
//close DB connection mysqli_close($connection);
?>