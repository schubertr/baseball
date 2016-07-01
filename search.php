<html>

<title>Baseball Hall of Fame</title>


<link rel="stylesheet" href="style.css">

<style>
form{margin: 0 auto; width: 250px; text-align: center; padding-bottom: 15px;}
</style>

<body>

<?PHP
include "navbar.php";
echo "<td bgcolor='#0069AA'>";
?>

<form action="results.php" method="get"><br><input type="text" name="txt"> <input type="submit" value="Search"><br></form>


<?PHP
include "footer.php"
?>

</body>

</html>