<html>

<title>Baseball Hall of Fame</title>


<link rel="stylesheet" href="style.css">

<style>
h1.titles{width: 280px; margin-left: auto; margin-right: auto; white-space: nowrap}
h2.subs{width: 120px; margin-left: auto; margin-right: auto; white-space: nowrap}
th.l{text-align: left;}
th.r{text-align: right;}
table.stats1{width: 200px; margin-left: auto; margin-right: auto;}
</style>

<body>

<?PHP
include "navbar.php";
echo "<td bgcolor='#0069AA'>";

echo "<br>";
//make a database connection_aborted
$db = new PDO('mysql:host=localhost;dbname=baseball;charset=utf8', 'root', '');

$stmt = $db->query("SELECT *, H/AB as avg FROM batting WHERE AB >= 200 ORDER BY avg DESC LIMIT 25");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

echo"<h1 class=titles>Top Batting Averages</h1>";

echo "<h2 class=subs>Single Season</h2>";

echo "<table class = stats1>";

echo "<th></th>";
echo "<th class = l style= 'padding: 0 80px 0 0;'>Name</th>";
echo "<th class = l>Team</th>";
echo "<th class = r style= 'padding: 0 0 0 30px;'>Year</th>";
echo "<th class = r style= 'padding: 0 0 0 30px; white-space: nowrap;'>Batting Avg</th>";

$len = count($result);


	//echo "<prev>";
	//print_r($result);
	//echo "</prev><br><br><br><br>";

$num = 1;
for($i = 0 ; $i < $len ; $i++)
{
	$playerID = $result[$i]['playerID'];
	$team = $result[$i]['teamID'];
	$year = $result[$i]['yearID'];
	$avg = $result[$i]['avg'];
	$avg = number_format($avg, 3);

	$stmt = $db->query("SELECT * from master where playerID='$playerID'");
	$temp=$stmt->fetchAll(PDO::FETCH_ASSOC);

	//echo "<prev>";
	//print_r($temp);
	//echo "</prev><br><br>";

	if($playerID == "meyerle01")
	{
		$nameFirst = "Levi";
		$nameLast = "Meyerele";
	}
	else
	{
		$nameLast=$temp[0]["nameLast"];
		$nameFirst=$temp[0]["nameFirst"];
	}

	echo "<tr>";
	echo "<td>$num.</td>";
	echo "<td style='text-align: left; white-space: nowrap;'><a href='player.php?playerID=$playerID'>$nameFirst $nameLast</a></td>";
	echo "<td style='text-align: left;'><a href='roster.php?team=$team&year=$year'>$team</a></td>";
	echo "<td style='text-align: right;'>$year</td>";
	echo "<td style='text-align: right;'>$avg</td>";
	echo "</tr>";

	$num++;
}
echo "</table>";

echo "<table class = stats1>";

echo "<br><h2 class=subs>All-Time</h2>";

$stmt = $db->query("SELECT playerID, SUM(H)/SUM(AB) as avg FROM batting GROUP BY playerID HAVING SUM(AB) >= 2000 ORDER BY avg DESC LIMIT 25");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

$len = count($result);


	//echo "<prev>";
	//print_r($result);
	//echo "</prev><br><br><br><br>";

echo "<th></th>";
echo "<th class = l style= 'padding: 0 80px 0 0;'>Name</th>";
echo "<th class = r style= 'padding: 0 0 0 30px; white-space: nowrap;'>Batting Avg</th>";

$num = 1;

for($i = 0 ; $i < $len ; $i++)
{
	$playerID = $result[$i]['playerID'];
	$avg = $result[$i]['avg'];
	$avg = number_format($avg, 3);

	$stmt = $db->query("SELECT * from master where playerID='$playerID'");
	$temp=$stmt->fetchAll(PDO::FETCH_ASSOC);

	//echo "<prev>";
	//print_r($temp);
	//echo "</prev><br><br>";

	$nameLast=$temp[0]["nameLast"];
	$nameFirst=$temp[0]["nameFirst"];
	

	echo "<tr>";
	echo "<td>$num.</td>";
	echo "<td style='text-align: left; white-space: nowrap;'><a href='player.php?playerID=$playerID'>$nameFirst $nameLast</a></td>";
	echo "<td style='text-align: right;'>$avg</td>";
	echo "</tr>";

	$num++;
}

echo "</table>";

echo "<br>";

include "footer.php"
?>

</body>

</html>