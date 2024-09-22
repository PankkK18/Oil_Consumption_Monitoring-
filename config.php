<?php
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'machines';

$conn = mysqli_connect($server,$user,$password,$db);

if($conn)
{
	?>
	<script>
		alert("connection successful");
	</script>
	<?php
}
else{
	?>
	<script>
		alert("connection failed!");
	</script>
	<?php
}
?>