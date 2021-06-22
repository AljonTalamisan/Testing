<!DOCTYPE html>
<html>
<link rel="stylesheet" href="w3.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<!--- Responsive ---->	
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<style>
.content {
  max-width: 800px;
  margin: auto;
  background: white;
  padding: 10px;
}
.content2 {
  max-width: 500px;
  margin: auto;
  background: orange;
  padding: 10px;
}
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 2px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 250px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}
footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
body {
    margin-bottom:100px;
}
.borderless {
    border: none;
    background: transparent;
}
	
.tooltip:hover .tooltiptext {
  visibility: visible;
</style>    
 <title>Fullybooked Survey Form</title>  
<body class="w3-theme-l2" id="top">
<!--- TITLE/HEADER of the form ---->
<div class="w3-container w3-2019-fiesta content" style='background-color:#f2552c'>
	<img src="../FBlogo.png" width="100" height="50" class="center" />
</div>
    
<div class="w3-container content">
<p></p> <!--- For spacing purposes ---->
  
<div class="w3-card-4">
<br>
	
<?php
	
include 'db_con.php';
	
$conn = OpenCon();
	
$set = "SELECT setname from tb_question order by ID"; // 
$resultset = mysqli_query($conn, $set);
	
?>
	
<form name="indexForm2" class="w3-container" action="" method="post">
	   <input type="search" list="mylist3" class="w3-input w3-border w3-round-large" name="set_name" placeholder="Pick a Set" onkeyup='saveValue(this);' id="set_number">
			<datalist id='mylist3'>
				<?php
       				while ($row = $resultset->fetch_assoc())
       					{
						
         					echo '<option value="'.$row['setname'].'"></option>';
						
						}
?>
			</datalist>
		<input class="w3-btn submit w3-text-white" name="submit2" type="submit" style='background-color:#f2552c' value="PICK"> <a class="w3-text-orange" href="<?php $_SERVER['PHP_SELF']; ?>">Refresh the Set</a><p></p>
</form>


<?php
if(isset($_POST['submit2'])){
// Fetching variables of the form which travels in URL
$question = $_POST['set_name'];

date_default_timezone_set("Asia/Manila");	
$datenow = new DateTime(); // Date object using current date and time
$dt=date('Y-m-d');
$dm=date('H:i:s');
	
$setnumber = "SELECT set_number from tb_question where setname='$question'";
$resultnumber = mysqli_query($conn, $setnumber);
	
$setname = "SELECT setname from tb_question where setname='$question'";
$resultname = mysqli_query($conn, $setname);
	
$label1 = "SELECT Q1 from tb_question where setname='$question'";
$resultlabel1 = mysqli_query($conn, $label1);
	
$label2 = "SELECT Q2 from tb_question where setname='$question'";
$resultlabel2 = mysqli_query($conn, $label2);

$label3 = "SELECT Q3 from tb_question where setname='$question'";
$resultlabel3 = mysqli_query($conn, $label3);
	
$label4 = "SELECT Q4 from tb_question where setname='$question'";
$resultlabel4 = mysqli_query($conn, $label4);

$querychoice = "SELECT DISTINCT choices from tb_yesno"; // 
$resultchoice = mysqli_query($conn, $querychoice); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
		echo '<form name="indexForm2" class="w3-container" action="" method="post">';
		echo '<h3 class="w3-center"><b class="w3-text-red"> "' .$question. '" </b></h3>';
		echo '<h6><label><b>Date</b><b class="w3-text-red">*</b></label></h6>';
      	echo '<input name="date" class="w3-input w3-border w3-round-large" type="date" value="' . $dt . '">';
		echo '<p></p>';
		echo '<h6><b>Name</b><b class="w3-text-red">*</b></h6><input type="text" class="w3-input w3-border w 3-round-large" name="name" placeholder="Type your name here" required onkeyup="saveValue(this);" id="name" autocomplete="off">' ;
		echo '<input name="set_name" type="hidden" value= "' . $question . '">';
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
while ($row = $resultlabel1->fetch_assoc()) 
    {
		if ($row['Q1'] == '')
			{
			
			echo '<input type="hidden" name="answer1" value="">';
				
			}
			
		else {
		 	echo '<h6><b>1.</b>';
         	echo ' '.$row['Q1'].'';
			
			echo '<b class="w3-text-red">*</b></h6>';
			echo '<input type="search" list="mylist" class="w3-input w3-border w3-round-large w3-pale-yellow" name="answer1" required placeholder="Choose or Write your Answer" onkeyup="saveValue(this);" id="1stquestion" autocomplete="off">';
			echo '<datalist id="mylist">';
			
while ($row = $resultchoice->fetch_assoc()) 
       {
	
         echo '<option value="'.$row['choices'].'"></option>';
	
       }

			echo '</datalist>';
			echo '<hr style="height:2px;border-width:0;color:gray;background-color:gray">';
       		}
	}
		

////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
while ($row = $resultlabel2->fetch_assoc()) 
       {
		if ($row['Q2'] == ''){
			
			echo '<input type="hidden" name="answer2" value="">';
				
			}
			
			else {
		 echo	'<h6><b>2.</b>';
         echo ' '.$row['Q2'].'';
			
		echo '<b class="w3-text-red">*</b></h6>';
		echo '<p></p>';
		echo '<input type="search" list="mylist" class="w3-input w3-border w3-round-large w3-pale-yellow" name="answer2" placeholder="Choose or Write your Answer" onkeyup="saveValue(this);" id="2ndquestion" autocomplete="off">';
		echo '<datalist id="mylist">';
			
while ($row = $resultchoice->fetch_assoc()) 
       {
         echo '<option value="'.$row['choices'].'"></option>';
       }

		echo '</datalist>';
		echo '<hr style="height:2px;border-width:0;color:gray;background-color:gray">';
       }
	}
		
////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
while ($row = $resultlabel3->fetch_assoc()) 
       {
			if ($row['Q3'] == ''){
				
				echo '<input type="hidden" name="answer3" value="">';
			}
			
			else {
		 echo	'<h6><b>3.</b>';
         echo ' '.$row['Q3'].'';
			
		echo '<b class="w3-text-red">*</b></h6>';
		echo '<input type="search" list="mylist" class="w3-input w3-border w3-round-large w3-pale-yellow" name="answer3" placeholder="Choose or Write your Answer" onkeyup="saveValue(this);" id="3rdquestion" autocomplete="off">';
		echo '<datalist id="mylist">';
			
while ($row = $resultchoice->fetch_assoc()) 
       {
         echo '<option value="'.$row['choices'].'"></option>';
       }

		echo '</datalist>';
		echo '<hr style="height:2px;border-width:0;color:gray;background-color:gray">';
       }
		}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
while ($row = $resultlabel4->fetch_assoc()) 
       {
			if ($row['Q4'] == ''){
				
				echo '<input type="hidden" name="answer4" value="">';
			}
			
			else {
		echo	'<h6><b>4.</b>';
        echo ' '.$row['Q4'].'';
			
		echo '<b class="w3-text-red">*</b></h6>';
		echo '<p></p>';
		echo '<input type="search" list="mylist" class="w3-input w3-border w3-round-large w3-pale-yellow" name="answer4" placeholder="Choose or Write your Answer" onkeyup="saveValue(this);" id="4thquestion" autocomplete="off">';
		echo '<datalist id="mylist">';
			
while ($row = $resultchoice->fetch_assoc()) 
       {
         echo '<option value="'.$row['choices'].'"></option>';
       }

		echo '</datalist>';
		echo '<hr style="height:2px;border-width:0;color:gray;background-color:gray">';
       }
	}

	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
		
		echo '<p></p>';
		echo '<input class="w3-btn submit w3-center" name="submit" type="submit" value="SUBMIT" style="background-color:#f2552c" onclick="submit()">';
		echo '<p></p>';
		echo '</form>';

}
	?>
	      
	
  </div>
</div>
<script type="text/javascript">
        document.getElementById("1stquestion").value = getSavedValue("answer1");
		document.getElementById("2ndquestion").value = getSavedValue("answer2");
		document.getElementById("3rdquestion").value = getSavedValue("answer3"); 
		// set the value to this input
        /* Here you can add more inputs to set value. if it's saved */

        //Save the value function - save it to localStorage as (ID, VALUE)
        function saveValue(e){
            var id = e.id;  // get the sender's id to save it . 
            var val = e.value; // get the value. 
            localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
        }

        //get the saved value function - return the value of "v" from localStorage. 
        function getSavedValue  (v){
            if (!localStorage.getItem(v)) {
                return "";// You can change this to your defualt value. 
            }
            return localStorage.getItem(v);
        }
</script>
	
	<?php

if(isset($_POST['submit'])){
// Fetching variables of the form which travels in URL
$setname = $_POST['set_name'];
$name = $_POST['name'];
$question1 = $_POST['answer1'];
$question2 = $_POST['answer2'];
$question3 = $_POST['answer3'];
$question4 = $_POST['answer4'];
$date = $_POST['date'];

	
$sql = "insert into tb_answer(date, name, setname, A1, A2, A3, A4) values ('$date', '$name', '$setname', '$question1', '$question2', '$question3', '$question4')";
	
if (mysqli_query($conn, $sql))
{
 ?>
	<script> //popup message employee successfully submitted
swal.fire({
title: "SUCCESS!",
text: "Thank you for Submitting! Keep Safe!",
icon: "success",
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
