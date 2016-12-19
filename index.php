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

include('functions.php');
//Get Balance from address
$have = getBalance('1F2FtaA3SWSJjUwsmPqRYNpunjVpqJFJhK');
//Set a target
$target = 100000000;
//Get the progression in %
$goal = $have / $target * 100;
//Turn it into a animation
$stylegoal = '<span style="width: '.$goal.'%"></span>';
//Set the Goal and Targets in BTC for display purpose.
$btcHave = convertToBTCFromSatoshi($have);
$btcGoal = convertToBTCFromSatoshi($target);

?>
<!-- Display the page! -->
</head>
<body>
<div id="wrap">
<h2>ROI/TARGET: <?php echo $btcGoal ?></h2>
<h3>Gespaard: <?php echo $btcHave; ?></h3>
	<div class="meter">
			<?php echo $stylegoal; ?>
		</div>

</div>
</body>
</html>   