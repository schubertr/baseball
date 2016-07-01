<html>


<title>Baseball Hall of Fame</title>


<link rel="stylesheet" href="style.css">


<body>
	<?PHP


	include "navbar.php";
	echo "<td bgcolor='#0069AA'>";
	echo "<BR><BR><BR>";

//make a database connection_aborted
	$db = new PDO('mysql:host=localhost;dbname=baseball;charset=utf8', 'root', '');
	$franchID=$_GET["x"];

//echo "SELECT * FROM TEAMS where franchID='$franchID' ORDER BY yearID";

//send a query
	$stmt = $db->query("SELECT * FROM TEAMS where franchID='$franchID' ORDER BY yearID");
	$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

	echo "<blockquote>";	
//display results of query

	if(count($result)>0){

		echo "<h1>The years of The ";
		echo $result[0]['name'];
		echo "</h1>";

		foreach($result as $team)
		{
			$year=$team["yearID"];
			$teamID=$team["teamID"];
			echo "<a href='roster.php?team=$teamID&year=$year'>";
			echo $year;
			echo "</a>";
			echo "<BR>";
		}
	}
	else
		echo "Results not found.";

	include "footer.php";

	?>




</body>

</html>