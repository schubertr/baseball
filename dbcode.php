//make a database connection_aborted
$db = new PDO('mysql:host=localhost;dbname=baseball;charset=utf8', 'mickey', 'mantel');

//send a query
$stmt = $db->query($query);
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
//display results of query