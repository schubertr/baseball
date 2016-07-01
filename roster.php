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
$teamID=$_GET["team"];
$yearID=$_GET["year"];
//query for team name
$stmt = $db->query("SELECT franchName from teams t INNER JOIN 
teamsfranchises f ON f.franchID=t.franchID 
where t.teamID='$teamID' and t.yearID='$yearID' ");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$teamName=$result[0]["franchName"];

//query for record
$stmt=$db->query("SELECT W from teams where teams.teamID = '$teamID' and teams.yearID = '$yearID'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$wins = $result[0]['W'];

$stmt=$db->query("SELECT L from teams where teams.teamID = '$teamID' and teams.yearID = '$yearID'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$losses = $result[0]['L'];

//query for rank
$stmt=$db->query("SELECT Rank from teams where teams.teamID = '$teamID' and teams.yearID = '$yearID'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$rank = $result[0]['Rank'];

//query for avg salary
$stmt = $db->query("SELECT AVG(salary) as avg FROM salaries WHERE salaries.teamID = '$teamID' AND salaries.yearID = '$yearID'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$avgSal = $result[0]['avg'];

//query for players
$stmt = $db->query("SELECT b.playerID,m.nameFirst,m.nameLast 
FROM batting b INNER JOIN master m ON 
b.playerID=m.playerID 
where b.teamID='$teamID' and b.yearID='$yearID' 
ORDER BY m.nameLast,m.nameFirst");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

//display record
echo "<blockquote>";	
echo "<h2>Roster for ".$teamName." in ".$yearID."</h2>";
echo "<h3>Ranked number ".$rank." in their division with ".$wins." wins and ".$losses." losses.</h3>";

if($avgSal == 0)
	echo "<h4>No salary data available.<br><br>";
else
{
	echo "<h4>Average salary: ";
	echo "$".number_format($avgSal, 2);
}

echo "</h4>";

//display results of query
foreach($result as $player){
	$playerID=$player["playerID"];
	$first=$player["nameFirst"];
	$last=$player["nameLast"];
	echo "<a href='player.php?playerID=$playerID'>";
	echo $first." ".$last;
	echo "</a>";
	echo "<BR>";
}
include "footer.php";

?>

</body>

</html>