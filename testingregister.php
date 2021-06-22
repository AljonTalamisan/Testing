<!DOCTYPE html>
<html>
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>

<!--- Responsive ---->	
<meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
.content {
  max-width: 800px;
  margin: auto;
  padding: 10px;
}
.content2 {
  max-width: 1000px;
  margin: auto;
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
body {
    margin-bottom:120px;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
textarea {
  resize: none;
}
</style>	
<title>Fullybooked Survey Form Creator</title> 	
<body class="w3-theme-l2">
	

<script src="hhttps://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<!------------------ Background Design for the title ------------------>	
	<div class="w3-container w3-2019-orange-tiger content" style='background-color:#f2552c' id="top">
		<img src="../FBlogo.png" width="100" height="50" class="center" />
			<h1 class="w3-center w3-padding w3-black w3-opacity-min">CREATE YOUR FORM</h1>
	</div>
<!------------------ Design for Selecting a Specific Date ----------------------->
<div class="ui inverted container segment text"><br>
	<form name="indexForm" class="w3-container" method="post">
		
<?php
	
include 'db_con.php';

$conn = OpenCon();
	
$count =  "SELECT ID FROM tb_question ORDER BY ID DESC LIMIT 1";
$resultcount = mysqli_query($conn, $count);
$plus = 1;
	
?>	
		<label><b>Set Count: </b></label><input name="set_count" class="w3-grey w3-border" readonly type="name" 
		value="<?php   
			
		while ($row = $resultcount->fetch_assoc()) 
       {
        	$sum1 = $row['ID'];
			$sum2 = 1;
			$total = $sum1 + $sum2;
			
       } echo "$total"; 
			
		?>
		">
		
		<a href="<?php $_SERVER['PHP_SELF']; ?>">Refresh</a>
		
		<p></p>
		<p><label><b>Setname : </b><b class="w3-text-red">*</b></label></p>
		<input type="text" placeholder="Type the name for the SET" required id="setname" name="setname" class="w3-input w3-border w3-round-large"><br>
		<p><label><b>Question 1 </b><b class="w3-text-red">*</b></label></p>
			<textarea name="question1" class="w3-input w3-border w3-round-large"  placeholder="Write your question here"  id="1stquestion" rows="4" cols="50"></textarea><br>
		<p><label><b>Question 2 </b><b class="w3-text-red">*</b></label></p>
			<textarea name="question2" class="w3-input w3-border w3-round-large"  placeholder="Write your question here"  id="2ndquestion" rows="4" cols="50"></textarea><br>
		<p><label><b>Question 3 </b><b class="w3-text-red">*</b></label></p>
			<textarea name="question3" class="w3-input w3-border w3-round-large"  placeholder="Write your question here"  id="3rdquestion" rows="4" cols="50"></textarea><br>
		<p><label><b>Question 4 </b><b class="w3-text-red">*</b></label></p>
			<textarea name="question4" class="w3-input w3-border w3-round-large"  placeholder="Write your question here"  rows="4" cols="50"></textarea><br>
		<p></p>
		
	<input class="ui orange button basic submit" name="submit" type="submit" value="Register" style='background-color:#f2552c'>
	</form>
</div>

<div class="w3-container"><p></p></div>
	<p></p>
<?php

if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
$question1 = mysqli_real_escape_string($conn, $_POST['question1']);
$question2 = mysqli_real_escape_string($conn, $_POST['question2']);
$question3 = mysqli_real_escape_string($conn, $_POST['question3']);
$question4 = mysqli_real_escape_string($conn, $_POST['question4']);
$setname = $_POST['setname'];
    
//check if the name is already been registered on database
	
$sql = "insert into tb_question(setname, Q1, Q2, Q3, Q4) values ('$setname','$question1','$question2', '$question3', '$question4')";


if (mysqli_query($conn, $sql))
{	
?>
	<script> 
swal({
title: "SUCCESS",
text: "The Questions are Successfully Saved",
icon: "success"
});
	</script>
	
<?php
} 
	
else 
{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}

?>	
<footer class="w3-container" style='background-color:#f2552c'><p></p>
	<a href="#top"><img src="../FBlogo.png" width="150" height="25"/><p></p></a>
</footer>
</body>
</html>