<html>

<title>Baseball Hall of Fame</title>


<link rel="stylesheet" href="style.css">

<style>
table {width: 50%; margin-left: auto; margin-right: auto;}
h2{width: 24%; margin-left: auto; margin-right: auto;}
th.l{text-align: left;}
th.r{text-align: right;}
</style>

<body>

<?PHP
include "navbar.php";
echo "<td bgcolor='#0069AA'>";

echo "<br>";
//make a database connection_aborted
$db = new PDO('mysql:host=localhost;dbname=baseball;charset=utf8', 'root', '');

$stmt = $db->query("SELECT * FROM salaries ORDER BY salaries.salary DESC LIMIT 25");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Top 25 Salaries</h2>";
echo "<table>";
echo "<th class = l>Name</th>";
echo "<th class = l>Team</th>";
echo "<th class = r>Year</th>";
echo "<th class = r>Salary</th>";

$len = count($result);

for($i = 0 ; $i < $len ; $i++)
{
	$playerID = $result[$i]['playerID'];
	$team = $result[$i]['teamID'];
	$year = $result[$i]['yearID'];
	$salary = $result[$i]['salary'];
	$salary = "$".number_format($salary, 2);

	$stmt = $db->query("SELECT * from master where playerID='$playerID'");
	$temp=$stmt->fetchAll(PDO::FETCH_ASSOC);
	$nameLast=$temp[0]["nameLast"];
	$nameFirst=$temp[0]["nameFirst"];

	echo "<tr>";
	echo "<td style='text-align: left;'><a href='player.php?playerID=$playerID'>$nameFirst $nameLast</a></td>";
	echo "<td style='text-align: left;'><a href='roster.php?team=$team&year=$year'>$team</a></td>";
	echo "<td style='text-align: right;'>$year</td>";
	echo "<td style='text-align: right;'>$salary</td>";
	echo "</tr>";
}


include "footer.php"
?>

</body>

</html>