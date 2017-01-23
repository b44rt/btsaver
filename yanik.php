<html>
<head>
<?php
function getBalance($address) {
    return file_get_contents('https://blockchain.info/de/q/addressbalance/'. $address);
}

$address = '1F2FtaA3SWSJjUwsmPqRYNpunjVpqJFJhK';
$a= getBalance($address);
?>
<!-- Display the page! -->
</head>
<body>
<div id="wrap">
<?php echo $a ?>
</div>
</body>
</html>   