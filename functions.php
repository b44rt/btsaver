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

?>