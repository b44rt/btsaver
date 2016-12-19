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

//Common BTC Network statistics that might be useful: https://api.blockchain.info/stats

/** Fetches the balance of any given address in Satoshi notation.
 *  input: $address A bitcoin public key in string format.
 *  output: integer (eg: "44240914")
 */
function getBalance($address) {
    return file_get_contents('https://blockchain.info/de/q/addressbalance/'. $address);
}

/** Convert Satoshis to a string that can be displayed to users.
 *  input: $value Integer or string that can be parsed as an int.
 *  output: string (eg: "1.00400000")
 */
function convertToBTCFromSatoshi($value){
    return bcdiv( intval($value), 100000000, 8 );
}


$have = getBalance('1F2FtaA3SWSJjUwsmPqRYNpunjVpqJFJhK');
//echo 'Address Balance: ' . getBalance('1F2FtaA3SWSJjUwsmPqRYNpunjVpqJFJhK');

$target = 100000000;

$goal = $have / $target * 100;



$stylegoal = '<span style="width: '.$goal.'%"></span>';



$btcHave = convertToBTCFromSatoshi($have);
$btcGoal = convertToBTCFromSatoshi($target);

?>
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