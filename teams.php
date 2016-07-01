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

//send a query
$stmt = $db->query("SELECT * FROM TEAMSFRANCHISES ORDER BY franchName");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<blockquote>";	

echo "<h1>Teams:</h1>";

//display results of query
foreach($result as $franchise){
	echo "<a href='years.php?x=".$franchise["franchID"]."'>";
	echo $franchise["franchName"];
	echo "</a>";
	echo "<BR>";
}

	
include "footer.php";

?>




</body>

</html>