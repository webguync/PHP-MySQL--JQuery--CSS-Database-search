<?php

$dbhost = "localhost";
$dbuser = "";
$dbpass = "";
$dbname = "";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');
mysql_select_db($dbname);

if(isset($_GET['query'])) { $query = $_GET['query']; } else { $query = ""; }
if(isset($_GET['type'])) { $type = $_GET['type']; } else { $query = "count"; }

if($type == "count")
{
	$sql = mysql_query("SELECT count(category_id) 
	FROM players
 
								WHERE MATCH(sport,first_name,last_name,MVP,city,team,Picture)
								AGAINST('$query' IN BOOLEAN MODE)");
	$total = mysql_fetch_array($sql);
	$num = $total[0];
	
	echo $num;
	//echo mysql_errno($sql) . ": " . mysql_error($sql) . "\n";
}



if($type == "results")
{
	$sql = mysql_query("SELECT sport,first_name,last_name,MVP,city,Picture,team
								FROM players 
								WHERE MATCH(sport,first_name,last_name,MVP,city,team,Picture)
								AGAINST('$query' IN BOOLEAN MODE)");
echo mysql_error($conn);						
echo "<table>";
echo "<tr>";
echo "<th>First Name</th><th>Last Name</th><th>City</th><th>Team</th><th>Picture</th><th>MVP</th>";

	while($row = mysql_fetch_assoc($sql))
{
    $class    = ($row['MVP']) ? 'class="MVP"' : '';
    $mvpText = ($row['MVP']) ? 'MVP' : '';
    echo "<tr>\n";
    echo "  <td {$class}>{$row['first_name']}</td>\n";
    echo "  <td {$class}>{$row['last_name']}</td>\n";
	echo "  <td {$class}>{$row['city']}</td>\n";
    echo "  <td {$class}>{$row['team']}</td>\n";
	echo "  <td {$class}>{$row['Picture']}</td>\n";
    echo "  <td {$class}>{$mvpText}</td>\n";
    echo "</tr>\n";
}
	echo "</table>";
}


mysql_close($conn);

?>