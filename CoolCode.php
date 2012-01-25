<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Phase1A and Phase1B Scores - 2011</title>
<link href="css/report.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<script src="js/jquery.js"></script>
 <script type="text/javascript">
 $(document).ready(function(){
   $(".stripeMe tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
   $(".stripeMe tr:even").addClass("alt");
 });
 </script>
<script language="JavaScript" src="js/jquery.columnfilters.js"></script>
</head>
<body>
<?php

$con = mysql_connect("localhost","novoprince","nordisk726");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("nnprinceton_p1", $con);


$result = mysql_query("SELECT last_name,first_name,employee_id,title,territory,district,Phase1A_Score,Phase1B_Score,Phase1_Average,Class_Date FROM Phase1A_1B_TotalScores_2011") or die(mysql_error());
echo "<h1> 2011 Phase1A and Phase1B Scores</h1>";
echo "
<table>
<tr>
<tr><td colspan='10'><img src='images/Novo_Nordisk_logo.png' alt='Novo Logo' /></td><td align='center'><p><strong>If you would like to filter the data simply enter the criteria in the input fields below each column header.</strong> </p></td><td><table><tr><td colspan='2' class='ClassDates'><p><strong>Class Date Key</strong></p></td>
</tr>
<tr><td><p>January</p></td><td><p>March</p></td></tr>
<tr><td class='JanuaryKey'><p>&nbsp;&nbsp;&nbsp;</p></td><td class='MarchKey'><p>&nbsp;&nbsp;&nbsp;</p></td></tr></table></td></tr>

</table>
<table class='stripeMe' id='FilterMe'>
<thead>
<tr>
<th>Last Name</th>
<th>First Name</th>
<th>Employee ID</th>
<th>Title</th>
<th>Territory</th>
<th>District</th>
<th>Phase 1A Score</th>
<th>Phase 1B Score</th>
<th>Phase 1  Average</th>
<th>Class Date</th>
</tr>
<thead>
<tfoot></tfoot>
<tbody>
";

function cssfromdate($date) {
 $class = array('January' => 'January', 'March' => 'March');
 return $class[$date];
}

while($row = mysql_fetch_array($result))
  {


  echo "<tr>";

  echo "<td>" . $row['last_name'] . "</td>\n";
  echo "<td>" . ucwords($row['first_name']) . "</td>\n";
 echo "<td>" . ($row['employee_id']) . "</td>\n";
  echo "<td>" . $row['title'] . "</td>\n";
  echo "<td>" . $row['territory'] . "</td>\n";
  echo "<td>" . $row['district'] . "</td>\n";
  echo "<td>" . $row['Phase1A_Score'] . "</td>\n";
  echo "<td>" . $row['Phase1B_Score'] . "</td>\n";
  echo "<td>" . $row['Phase1_Average'] . "</td>\n";
echo "<td class=\"".cssfromdate($row['Class_Date'])."\">".$row['Class_Date']."</td>\n";
  
  echo "</tr>";
 


  }
 echo "</tbody></table>";
mysql_close($con);

?>
<script>
	$(document).ready(function() {
		$('table#FilterMe').columnFilters({alternateRowClassNames:['rowa','rowb']});
		
	});
</script>
</body>
</html>









