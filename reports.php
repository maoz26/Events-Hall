<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>reports</title>
	<link href="includes/stylesheet.css" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
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
				<li> <a href="customer.php"> רישום לקוח חדש </a></li>
				<li> <a href="orders.php"> הזמנת אירוע </a></li>
				<li> <a href="employees.php"> ניהול עובדים </a></li>
				<li> <a href="event.php" > ניהול אירועים </a></li>
				<li> <a href="hall.php"> ניהול אולמות </a></li>
				<li> <a href="reports.php" class="boldi"> דוחות </a></li>
			</ul>
		</nav>
		<main>
			<?php
			
				$dbhost = "127.0.0.1"; $dbuser = "root"; $dbpass = "maoz1t"; $dbname = "Events-Hall";   //create a mySQL DB connection
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);  								//testing connection success
				if ($conn->connect_error) {
    				die("Connection failed: " . $conn->connect_error);
				}
			?>
			<form id="place_reports" action="reports.php" method="post">
				<h3> בסלקטור הזה ניתן יהיה לבחור הצגה של מספר דוחות </h3>
				<br>
				<p><label>בחר דו״ח <select id="reports">
										<option value=""> </option>
										<option value="1">סידור לפי האירוע הגדול ביותר</option>
										<option value="2"> סידור לפי התאריך הקרוב ביותר</option>
										<option value="3"> סה״כ אירועים, סידור לפי אולמות</option>
										<option value="4"> אילו עובדים עבדו באירוע ואיזה אולם</option>
								 </select>
					</label>
				</p>
			</form>
			<div id="results"> </div>
			<?php
				$dbhost = "127.0.0.1"; $dbuser = "root"; $dbpass = "1"; $dbname = "Events-Hall";   //create a mySQL DB connection
				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);  								//testing connection success
				if ($conn->connect_error) {
    				die("Connection failed: " . $conn->connect_error);
				}
			?>

			<div id="sub1" style="display:none">
			<?php //דוח לאירוע הגדול ביותר לפי מספר משתתפים
							$sql = "SELECT Order_ID, Participants FROM orders ORDER BY Participants";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
							    echo "<table><tr>
							    				<th>Order_ID</th>
							    				<th>Participants</th>
							    			</tr>";
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							        echo "<tr>
							        		<td>".$row["Order_ID"]."</td>
							        		<td>".$row["Participants"]."</td>
										</tr>";
							    }
							    echo "</table>";
							} else {
							    echo "0 results";
							}				
			?>
			</div>
			
			<div id="sub2" style="display:none">			
			<?php //דוח לאירוע הקרוב ביותר לפי תאריך 
							$sql = "SELECT Order_ID, Date FROM orders ORDER BY Date";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
							    echo "<table><tr>
							    				<th>Order_ID</th>
							    				<th>Date</th>
							    			</tr>";
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							        echo "<tr>
							        		<td>".$row["Order_ID"]."</td>
							        		<td>".$row["Date"]."</td>
										</tr>";
							    }
							    echo "</table>";
							} else {
							    echo "0 results";
							}				
			?>
			</div>
			
			<div id="sub3" style="display:none">		
			<?php //כל האירועים לפי אולומות 
							$sql = "SELECT Order_ID, Hall_ID FROM orders ORDER BY Hall_ID";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
							    echo "<table><tr>
							    				<th>Order_ID</th>
							    				<th>Hall_ID</th>
							    			</tr>";
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							        echo "<tr>
							        		<td>".$row["Order_ID"]."</td>
							        		<td>".$row["Hall_ID"]."</td>
										</tr>";
							    }
							    echo "</table>";
							} else {
							    echo "0 results";
							}				
			?>
			</div>
			
			<div id="sub4" style="display:none">					
			<?php //אילו עובדים עבדו באירועים ובאיזה אולם 
							$sql = "SELECT Employs.Hall_ID, E_ID, EventHall.Event_ID  FROM Employs, EventHall
									WHERE Employs.Hall_ID = EventHall.Hall_ID";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
							    echo "<table><tr>
							    				<th>Hall_ID</th>
							    				<th>E_ID</th>
							    				<th>Event_ID</th>
							    			</tr>";
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							        echo "<tr>
							        		<td>".$row["Hall_ID"]."</td>
							        		<td>".$row["E_ID"]."</td>
							        		<td>".$row["Event_ID"]."</td>
										</tr>";
							    }
							    echo "</table>";
							} else {
							    echo "0 results";
							}				
			?>
			</div>
			<script>
      			$("#reports").on("change", function(res){
	       			var selected = $(this).val();
	       			$('#sub1, #sub2, #sub3, #sub4').hide();
   					$('#sub' + $(this).val()).show();
					makeAjaxRequest(selected);
				});
   			</script>
		</main>
		<div class="clear"> </div>
	</div>
    </body>
</html>