<html>
<head>
<link rel='stylesheet' href='css/style.css'>
<!-- Include JQuery for Bar animation -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<?php
//Start Session to enable user login
session_start();
//Include Database connection. For future Features
include('db.php');
//Include functions for calling them later
include('functions.php');
//Verwerk dit nog naar een te callen functie,  ook moet loginsysteem afgemaakt worden zodat dit per user gedaan kan worden.
if(!empty($_POST['submit']))
{
	$plantype = mysqli_real_escape_string($conn, $_POST['plantype']);
	$btcaddress = mysqli_real_escape_string($conn, $_POST['btcaddress']);
	$goal = mysqli_real_escape_string($conn, $_POST['goal']);
	$goal = $goal * 100000000;//Maak Satoshi Amount om als INT op te slaan
	$descr = mysqli_real_escape_string($conn, $_POST['descr']);

	
	$sql = "INSERT INTO plans (plantype, btcaddress, goal, descr, creation)
	VALUES ('$plantype', '$btcaddress', '$goal', '$descr', NOW())";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	logAction("Plan added: ".$descr);
}
else
{
	//echo 'No DATA';
}

?>
<!-- Display the page! -->
</head>
<body>
<?php include('menu.php'); ?>
<div id="wrap">
<h2>New Plan</h2>
<table>
<form action="newplan.php" method="POST">
<tr><td>Track as Saving: </td><td><input type="radio" name="plantype" value=0 checked/></td></tr>
<tr><td>Track as Investment: </td><td><input type="radio" name="plantype" value=1/></td></tr>
<tr><td>Bitcoin Address: </td><td><input type="text" name="btcaddress" pattern=".{26,34}" required title="A Valid Bitcoin Public Key"/></td></tr>
<tr><td>Goal/Invested (BTC): </td><td><input type="number" min="0" max="21000000" step="0.00000001" name="goal"/></td></tr>
<tr><td>Description: </td><td><input type="text" name="descr"/></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="submit"/></td></tr>
</form>
</table>

</div>
</body>
</html>   