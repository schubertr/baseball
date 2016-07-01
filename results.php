<html>

<title>Baseball Hall of Fame</title>

<link rel="stylesheet" href="style.css">

<style>
form{margin: 0 auto; width: 250px; text-align: center; padding-bottom: 15px;}
div{margin: 0 auto; width: 250px; text-align: center;}
</style>

<body>


<?PHP
include "navbar.php";
echo "<td bgcolor='#0069AA'>";

echo "<form action='results.php' method='get'><br><input type='text' name='txt'> <input type='submit' value='Search'><br></form>";
echo "<hr>";

echo "<div>";

$db = new PDO('mysql:host=localhost;dbname=baseball;charset=utf8', 'root', '');

$sPhrase = $_GET["txt"];

$stmt=$db->query("SELECT CONCAT(nameFirst, ' ', nameLast) AS pName FROM master m WHERE m.nameFirst LIKE '%$sPhrase%'");
$firstNames=$stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt=$db->query("SELECT CONCAT(nameFirst, ' ', nameLast) AS pName FROM master m WHERE m.nameLast LIKE '%$sPhrase%'");
$lastNames=$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt=$db->query("SELECT playerID FROM master m WHERE m.nameFirst LIKE '%$sPhrase%'");
$firstIDs=$stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt=$db->query("SELECT playerID FROM master m WHERE m.nameLast LIKE '%$sPhrase%'");
$lastIDs=$stmt->fetchAll(PDO::FETCH_ASSOC);

$length = count($firstNames);

if($length > 1)
	$length--;

$length2 = count($lastNames);

if($length2 > 1)
	$length2--;

if($length < 1 && $length2 < 1)
	echo "<h3>No Results</h3>";
else
	echo "<h3>Results: </h3>";

if($length > 0)

	for($i = 0 ; $i < $length ; $i++) 
	{
		$name = $firstNames[$i]["pName"];
		$id = $firstIDs[$i]["playerID"];

		echo "<a href='player.php?playerID=$id'>$name</a>";
		echo "<br>";
	}
	
if($length2 > 0)

	for($i = 0 ; $i < $length2 ; $i++) 
	{
		$name = $lastNames[$i]["pName"];
		$id = $lastIDs[$i]["playerID"];

		echo "<a href='player.php?playerID=$id'>$name</a>";
		echo "<br>";
	}

echo "</div>";

include "footer.php"
?>

</body>

</html>