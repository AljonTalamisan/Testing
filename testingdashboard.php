<!DOCTYPE html>
<html>
<link rel="stylesheet" href="w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="tableExport/tableExport.js"></script>
<script type="text/javascript" src="tableExport/jquery.base64.js"></script>
<script src="js/export.js"></script>
<script src="js/export2.js"></script>
<!--- Responsive ---->	
<meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
.content {
  max-width: 1000px;
  margin: auto;
  background: white;
  padding: 10px;
}
.content2 {
  max-width: 1000px;
  margin: auto;
  background: white;
  padding: 10px;
}
table.center {
  margin-left: auto; 
  margin-right: auto;
}
footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
}
.center2 {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
body {
    margin-bottom:100px;
}

</style>	
<title>FullyBooked Dashboard</title> 	
<body class="w3-theme-l2" id="top">

<?php
	
include 'db_con.php';
	
$conn = OpenCon();
	
$chooseset = "SELECT setname from tb_question"; // 
$resultsetchoose = mysqli_query($conn, $chooseset);
	
?>
<!------------------ Background Design for the title ------------------>	
<div class="w3-container w3-2019-orange-tiger content2" style='background-color:#f2552c'>
	<img src="../FBlogo.png" width="100" height="60" class="center2" />
<h2 class="w3-center w3-opacity" style="text-shadow:1px 1px 0 #444">FullyBooked Survey Form Dashboard</h2>
<h1 class="w3-center w3-padding w3-black w3-opacity-min">REPORT</h1>
</div>
<!------------------ Design for Selecting a Specific Date ----------------------->	
<div class="w3-container content">
<p class="w3-center w3-medium w3-black w3-padding">SELECT A SET</p>
<form name="indexForm2" class="w3-container" method="post">
<input type="search" list="mylist3" class="w3-input w3-border w3-round-large" name="set" placeholder="Pick a Set" onkeyup='saveValue(this);' id="set_number">
			<datalist id='mylist3'>
				<?php
       				while ($row = $resultsetchoose->fetch_assoc())
       					{
						
         					echo '<option value="'.$row['setname'].'"></option>';
						
						}
				?>
			</datalist>
<input class="w3-btn submit" name="submit2" type="submit" value="Next" style='background-color:#f2552c'>
<p></p>
</form>	 	
</div>
<p></p>
<div class="w3-container content2">
<!------------- PHP query for checking the date and displaying the result----------->
<?php

if(isset($_POST['submit2'])) {

$setname = $_POST['set'];
	
$set = "SELECT * from tb_answer where setname = '$setname'"; 
$resultset = mysqli_query($conn, $set);

	
if (mysqli_num_rows($resultset) > 0) {

// Show the NAME of all employees who did not submit
	echo "<div class='w3-container content w3-center'>";
	echo "<button onclick='myFunctionSet1()' class='w3-button w3-border w3-hover-deep-orange'>HIDE / SHOW</button>";
	echo "</div>";
	echo "<div class='w3-container content' id='myDIVset1'>";
	
	echo "<table border='1' class='center w3-table w3-striped' id='dataTable'><small>

			<tr>

			<th>SET NAME</th>
			<th>DATE</th>
			<th>NAME</th>
			<th>ANSWER 1</th>
			<th>ANSWER 2</th>
			<th>ANSWER 3</th>
			<th>ANSWER 4</th>
			
			
			</tr>";
    while($row = mysqli_fetch_assoc($resultset)) {
		
        echo "<tr>";

  		echo "<td><small>" . $row['setname']. "</small></td>";
		echo "<td><small>" . $row['date'] . "</small></td>";
		echo "<td><small>" . $row['name'] . "</small></td>";
		echo "<td><small>" . $row['A1'] . "</small></td>";
		echo "<td><small>" . $row['A2'] . "</small></td>";
		echo "<td><small>" . $row['A3'] . "</small></td>";
		echo "<td><small>" . $row['A4'] . "</small></td>";

  		echo "</tr>";

    }
	echo "</small></table>";
	echo "</div>";
		
	?>
	
	<div class="w3-dropdown-hover">
  		<button class="w3-button" style='background-color:#f2552c'>EXPORT</button>
  		<div class="w3-dropdown-content w3-bar-block w3-border">
      		<a  class="w3-bar-item w3-button dataExport" data-type="csv">CSV</a>
      		<a  class="w3-bar-item w3-button dataExport" data-type="excel">XLS</a>
			<a  class="w3-bar-item w3-button dataExport" data-type="txt">TXT</a>
  		</div>
	</div>
	</div>
	<?php
	
}
	
}
	
?> 
	
<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
	
function myFunction2() {
  var x = document.getElementById("myDIV2");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
	
function myFunction3() {
  var x = document.getElementById("myDIV3");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
	
function myFunctionSet1() {
  var x = document.getElementById("myDIVset1");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
	
</script>
</body>
<footer class="w3-container" style='background-color:#f2552c'>
  <h6></h6>
<a href="#top"><img src="../FBlogo.png" width="150" height="25"/>
	<p></p></a>
</footer>
</html>