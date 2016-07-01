[<html>


<title>Baseball Hall of Fame</title>


<link rel="stylesheet" href="style.css">

<style>
	div.info{margin-left: 10px; width: 300px; vertical-align: top;}
	div.stats{float: right; height: 15px; width: 300px; overflow: scroll;}
	td.lPanel{width: 10px; vertical-align: top;}
	td.bPanel{width: 200px; vertical-align: top;}
	td.fPanel{width: 200px; vertical-align: top; padding-left: 15px;}
	h3.titles{margin: 0px 0px 0px 75px; font-weight: normal;}
	table.pPanel{vertical-align: top; padding-left: 51.25%;}
	th{border-bottom: 1px solid gray; font-weight: normal;}
</style>

<body>
<?PHP


include "navbar.php";
echo "<td bgcolor='#0069AA'>";
echo "<br>";
//make a database connection_aborted
$db = new PDO('mysql:host=localhost;dbname=baseball;charset=utf8', 'root', '');

$playerID=$_GET["playerID"];

if($playerID == "meyerle01")
{
	echo"<h2 style='width: 65%; margin-left: auto; margin-right: auto; white-space: nowrap;'>No player data available for poor Levi Meyerle...</h2>";
}
else
{
//query for team name
$stmt = $db->query("SELECT * from master where playerID='$playerID'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

$givenName=$result[0]["nameGiven"];
$nameLast=$result[0]["nameLast"];
$nameFirst=$result[0]["nameFirst"];
$birthCity=$result[0]["birthCity"];
$birthYear=$result[0]["birthYear"];
$birthMonth=$result[0]["birthMonth"];
$birthDay=$result[0]["birthDay"];
$birthCountry=$result[0]["birthCountry"];
$birthState=$result[0]["birthState"];
$birthCity=$result[0]["birthCity"];
$deathYear=$result[0]["deathYear"];
$deathMonth=$result[0]["deathMonth"];
$deathDay=$result[0]["deathDay"];
$deathCountry=$result[0]["deathCountry"];
$deathState=$result[0]["deathState"];
$deathCity=$result[0]["deathCity"];
$weight=$result[0]["weight"];
$height=$result[0]["height"];
$bats=$result[0]["bats"];
$throws=$result[0]["throws"];
$debut=$result[0]["debut"];
$finalGame=$result[0]["finalGame"];



echo "<table>";
echo "<td class = lPanel>";
echo "<div class ='info'>";

$picPath = 'playerimages/' . $playerID . '.jpg';

if(file_exists($picPath))
{
	echo "<img src='$picPath' alt='$nameFirst $nameLast'><br><br>";
}
else
{
	$picPath = 'playerimages/missing.jpg';
	echo "<img src='$picPath' alt='Missing'><br><br>";
}

echo "Name: <strong>$nameFirst $nameLast</strong><br>";
echo "Given Name: <strong>$givenName</strong><br>";

if(strcmp($birthCountry, "USA") != 0)
{
	echo "Birthplace: <strong>$birthCity, $birthCountry</strong><br>";
}
else
{
	echo "Birth City: <strong>$birthCity</strong><br>";
}

echo "Birthdate: <strong>$birthMonth/$birthDay/$birthYear</strong><br>";

$birth = new DateTime($birthYear . '-' . $birthMonth . '-' . $birthDay);

if(!empty($deathYear))
{
	$death = new DateTime($deathYear . '-' . $deathMonth . '-' . $deathDay);
	$temp = $birth->diff($death);
	$age = $temp->y;
	echo "Died at years <strong>$age</strong> of age.<br>";
}
else
{
	$date = new DateTime();
	$temp = $birth->diff($date);
	$age = $temp->y;
	echo "Age: <strong>$age</strong><br>";
}

if($throws == 'R')
	$throws = "Right handed";
if($throws == 'L')
	$throws = "Left Handed";
if($bats == 'R')
	$bats = "Right handed";
if($bats == 'L')
	$bats = "Left Handed";
if($bats == 'B')
	$bats = "Switch";

$feet = (int) ($height/12);
$inches = $height % 12;


echo "Throws: <strong>$throws</strong><br>";
echo "Bats: <strong>$bats</strong><br>";
echo "Height: <strong>$feet' $inches\"</strong><br>";
echo "Weight: <strong>$weight lbs</strong><br>";
echo "<br>";
echo "</div>";

echo "</td>";

//batting stats

echo "<td class = bPanel>";

echo "<h3 class= titles>Batting</h3>";
echo"<table style='text-align:right;'>";

echo"<th>Yr</th>";
echo"<th>Team</th>";
echo"<th>AB</th>";
echo"<th>H</th>";
echo"<th>HR</th>";
echo"<th>RBI</th>";
echo"<tr>";

$stmt = $db->query("SELECT * from batting where playerID='$playerID'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<prev>";
//print_r($result);
echo "</prev>";

$len = count($result);

for($i = 0 ; $i < $len ; $i++)
{
	$team = $result[$i]['teamID'];
	$year = $result[$i]['yearID'];


	echo "<tr>";
	echo "<td>$year</td>";
	echo "<td><a href='roster.php?team=$team&year=$year'>$team</a></td>";
	echo "<td>" . $result[$i]['AB'] . "</td>";
	echo "<td>" . $result[$i]['H'] . "</td>";
	echo "<td>" . $result[$i]['HR'] . "</td>";
	echo "<td>" . $result[$i]['RBI'] . "</td>";
	echo "</tr>";
}

echo "</table>";


echo "</td>";

//fielding stats

echo "<td class = fPanel>";

echo "<h3 class= titles>Fielding</h3>";
echo"<table style='text-align:right;'>";

echo"<th>Yr</th>";
echo"<th>Team</th>";
echo"<th>POS</th>";
echo"<th>G</th>";
echo"<th>PO</th>";
echo"<th>E</th>";
echo"<th>DP</th>";
echo"<th>A</th>";
echo"<tr>";

$stmt = $db->query("SELECT * from fielding where playerID='$playerID'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<prev>";
//print_r($result);
echo "</prev>";

$len = count($result);
$pitcher = false;

if($result[0]['POS'] == 'P')
	$pitcher = true;

for($i = 0 ; $i < $len ; $i++)
{
	$team = $result[$i]['teamID'];
	$year = $result[$i]['yearID'];

	echo "<tr>";
	echo "<td>$year</td>";
	echo "<td><a href='roster.php?team=$team&year=$year'>$team</a></td>";
	echo "<td style ='text-align: center;'>" . $result[$i]['POS'] . "</td>";
	echo "<td>" . $result[$i]['G'] . "</td>";
	echo "<td>" . $result[$i]['PO'] . "</td>";
	echo "<td>" . $result[$i]['E'] . "</td>";
	echo "<td>" . $result[$i]['DP'] . "</td>";
	echo "<td>" . $result[$i]['A'] . "</td>";
	echo "</tr>";
}

echo "</table>";


echo "</td>";

echo "</td>";

echo "</table>";
//if pitcher do pitcher stats
if($pitcher)
{

//no borders here
echo "<table class = pPanel>";
echo "<td>";
echo "<h3 class= titles>Pitching</h3>";
echo"<table style='text-align:right;'>";

echo"<th>Yr</th>";
echo"<th>Team</th>";
echo"<th>G</th>";
echo"<th>W</th>";
echo"<th>L</th>";
echo"<th>SO</th>";
echo"<th>SHO</th>";
echo"<tr>";

$stmt = $db->query("SELECT * from pitching where playerID='$playerID'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<prev>";
//print_r($result);
echo "</prev>";

$len = count($result);

for($i = 0 ; $i < $len ; $i++)
{
	$team = $result[$i]['teamID'];
	$year = $result[$i]['yearID'];

	echo "<tr>";
	echo "<td>$year</td>";
	echo "<td><a href='roster.php?team=$team&year=$year'>$team</a></td>";
	echo "<td>" . $result[$i]['G'] . "</td>";
	echo "<td>" . $result[$i]['W'] . "</td>";
	echo "<td>" . $result[$i]['L'] . "</td>";
	echo "<td>" . $result[$i]['SO'] . "</td>";
	echo "<td>" . $result[$i]['SHO'] . "</td>";
	echo "</tr>";
}

echo "</table>";


echo "</td>";
echo "</table>";
}
}
include "footer.php";

?>


</body>

</html>