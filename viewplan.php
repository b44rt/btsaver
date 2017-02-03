<html>
<head>
	<!-- Styling for Progression Bar and Centering Page. -->
	<link rel='stylesheet' href='css/style.css'>
	<!-- Include JQuery for Bar animation -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
	<!-- Bar animation Script -->
	<script>
		$(function() {
			$(".meter > span").each(function() {
				$(this)
					.data("origWidth", $(this).width())
					.width(0)
					.animate({
						width: $(this).data("origWidth")
					}, 1200);
			});
		});
	</script>
<?php
//Start Session to enable user login
session_start();
//Include Database connection. For future Features
include('db.php');
//Include functions for calling them later
include('functions.php');
//Fetch Plan ID from GET Variable
if(!empty($_GET['pid'])){
	
	$pid = $_GET['pid'];
	$intpid = mysql_real_escape_string($pid);

	//debug shit
	//echo 'PID Received: '.$pid;
	//echo 'intPID Received: '.$intpid;
	//exit();
	//Bouw hier een check om te kijken of het PID private is, en weiger een private PID aan een ander account dan de eigenaar.
	//Ophalen informatie van opgevraagde PID.
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM plans WHERE id='$pid'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			//echo "id: " . $row["id"]. " - Type: " . $row["plantype"]. " Address: " . $row["btcaddress"]. "<a href='viewplan.php?pid=".$row["id"]."'>Go</a><br>";
			$id = $row['id'];
			$plantype = $row["plantype"];
			$address = $row["btcaddress"];
			$goal = $row["goal"];
			$oms = $row["descr"];
			$dtm = $row["creation"];
		}
	} 
	else {
		echo "0 results";
	}
	$conn->close();
	
	
	
}
else{
	echo  'No pid found';
}
//Fetch Bitcoin USD Rate
$UsdPrice = getBtcPrice();
//Get Balance from address
$have = getBalance($address);
//Set a target
$target = $goal;
//Get the progression in %
$goal = $have / $target * 100;
//Turn it into a animation
$stylegoal = '<span style="width: '.$goal.'%"></span>';
//Set the Goal and Targets in BTC for display purpose.
$btcHave = convertToBTCFromSatoshi($have);
$btcGoal = convertToBTCFromSatoshi($target);
$UsdHave = $btcHave * $UsdPrice;
$UsdHave = round($UsdHave, 2);
logAction("Plan loaded ID: ".$id);
?>
<!-- Display the page! -->
</head>
<body>
<?php include('menu.php'); ?>
<div id="wrap">
<h2>ROI/TARGET:</h2><p> <?php echo $btcGoal ?></p>
<h3>Gespaard:</h3><p><b> <?php echo $btcHave." </b>BTC  <br/><b>".$UsdHave."</b> USD <br/> <b>"; echo round($goal,2); ?></b> % of Total</p>
<h4>Description:</h4> <p><?php echo $oms ?></p>
<h4>Tracking Since:</h4><p> <?php echo $dtm ?></p>
<h4>Progression: </h4>
	<div class="meter">
		<?php echo $stylegoal; ?>
	</div>
	<h4>BTC/USD:</h4>
	<p><?php  echo $UsdPrice;?></p>
	
</div>
</body>
</html>   