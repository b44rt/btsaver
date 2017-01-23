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

/** Fetches BTC Saving Plans from DB.
 *  input: No input yet. Future Input will be user_ID or some identifier.
 *  output: Array of Plan Data
 */
function getMyPlans(){
	$sql = "SELECT * FROM plans";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
	//Hebben we plans gevonden?
	$rows = $result->num_rows;
	if($rows == 0)
	{
		//Nee, redirect maken ofzo.
		return 'SQL Error';
		
	}
	else
	{	
		return $rows;
		
	}
    
}
function getPlansByUserId(){
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM plans";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "id: " . $row["id"]. " - Type: " . $row["plantype"]. " Address: " . $row["btcaddress"]. "<br>";
		}
	} 
	else {
		echo "0 results";
	}
$conn->close();
}
?>