<?php
include("db.php");
//If there is submitted Post Data, start the login procedure.
if(!empty($_POST['submit']))
{
	session_start();//Om de user in te loggen als alles klopt.
	include('db.php');//We hebben straks de DB nodig om te kijken of de user/password combi bestaat.
	$username = $_POST['username']; //POST Data verplaatsen naar normale var
	$password = md5($_POST['password']);//Serverside encryption slecht, via javascript door client laten hashen.
	//DB call om gegevens te controlleren, daarna user ID in een sessie VAR gooien.
	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = $conn->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $conn->error);
	}
	//Hebben we een account gevonden?
	$rows = $result->num_rows;
	if($rows == 0)
	{
		//Nee, redirect maken ofzo.
		echo 'Account Invalid';
		
	}
	else
	{	//Kan vast beter dan een while loop, we hebben immers maar 1 resultaat, maar voor nu werkt dit.
		while ($row = $result->fetch_assoc())
		{
			//echo 'Success Message. ';
			echo $row['username'];
		}
	}

}
else
{
	//Redirect of form ofzo, moet nog over nadenken.
	include('includes/loginform.php');
}

?>
