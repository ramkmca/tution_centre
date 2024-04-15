<?php
$query=mysql_connect("localhost","root","");
mysql_select_db("ticket_system",$query);
if(isset($_POST['name']))
{
$name=trim($_POST['name']);
$query2=mysql_query("SELECT * FROM ts_complaint_type WHERE complaint_type LIKE '%$name%' ");
echo "<ul>";
while($query3=mysql_fetch_array($query2))
{
?>

<li onclick='fill("<?php echo $query3['complaint_type']; ?>")'><?php echo $query3['complaint_type']; ?></li>
<?php
}
}
?>
