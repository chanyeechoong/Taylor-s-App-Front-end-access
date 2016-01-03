<?php
//Enable the code below before deploying
//require_once ('util/secure_connection_helper.php');
require_once ('util/valid_admin.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Clubs and Society</title>
	<link rel="stylesheet" href="../css/general.css">

<script>
		//When X = 1 allow Update
		//When X = 0 allow Insert
		var x = 1;


		function insertAfter(newNode, referenceNode) {
 	   			referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
		}

		function update_elements_and_action(insertID,updateID,hiddenID){

			var insertElement = document.getElementById(insertID);
			var updateElement = document.getElementById(updateID);
			var hiddenElement = document.getElementById(hiddenID);
			var parentElement = document.getElementById('form-action');
			var referenceElement = document.getElementById('referance-element');


			if (insertElement.checked && x == 0) {
				hiddenElement.setAttribute('value','insert_club_society');
				document.getElementById("reference-to-remove").remove();
				document.getElementById("reference-to-remove-2").remove();
				var e = document.getElementsByTagName("br")[0];
				parentElement.removeChild(e);
				document.getElementById('updatePara').remove();
				x = 1;
			};

			if (updateElement.checked && x == 1) {

				
				hiddenElement.setAttribute('value','update_club_society');
				
				var idInputElement = document.createElement('input');
				idInputElement.setAttribute('type','text');
				idInputElement.setAttribute('name','id')
				idInputElement.setAttribute('class','input');
				idInputElement.setAttribute('id','reference-to-remove');

				var labelElement = document.createElement('label');
				labelElement.setAttribute('class','form');
				labelElement.setAttribute('id','reference-to-remove-2');
				labelElement.innerHTML = "ID to Update";


				var breakElement = document.createElement('br');

				parentElement.insertBefore(labelElement,referenceElement);
				parentElement.insertBefore(idInputElement,document.getElementById('reference-input'));
				insertAfter(breakElement,idInputElement);
				
				var pElement = document.createElement('p');
				pElement.innerHTML = '*Please re-enter all the original values into each field and only change the fields that needs to be updated';
				pElement.setAttribute('id','updatePara');
				insertAfter(pElement,document.getElementById('action'));
				x = 0;
			}; 

			//console.log(x);
		}




</script>



</head>

<body>
    <div class="div-ul-wrapper">
        <ul class="li-wrapper">
            <h1>Admin Menu</h1>
            <li><a href="../index.php?action=academic_news">Academic News</a></li>
            <li><a href="../index.php?action=campus_news">Campus News</a></li>
            <li><a href="../index.php?action=clubsinformation">Clubs Society</a></li>
            <li><a href="../index.php?action=eventsinformation">Events Information</a></li>
            <li><a href="../.?action=logout">Log Out</a></li>
        </ul>
    </div>

<table class = "tableDesign">
	<caption>Clubs and Society List</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>Club Name</th>
			<th>President</th>
			<th>Contact</th>
			<th>Email</th>
			<th>Facebook</th>
			<th>Image Path</th>
			<th>Update Time</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($result as $item):
	 	$id = $item['id'];
	 	$clubsName = $item['clubsName'];
	 	$president = $item['president'];
	 	$contact = $item['contact'];
	 	$email = $item['email'];
	 	$facebook = $item['facebook'];
	 	$imagePath = $item['imagePath'];
	 	$updateTime = $item['updateTime'];
	?>
		<tr>
			<td><?php echo $id;?></td>
			<td><?php echo $clubsName;?></td>
			<td><?php echo $president;?></td>
			<td><?php echo $contact;?></td>
			<td><?php echo $email;?></td>
			<td><?php echo $facebook;?></td>
			<td><?php echo $imagePath;?></td>
			<td><?php echo $updateTime;?></td>
		</tr>

	<?php endforeach;?>
	</tbody>
</table>


<!--NEED TO ADD UPDATE CODE HERE -->

	<div id="form-wrapper" class="form-wrapper">

			<form id="form-action" action="../." method="post">
				
				<input type="hidden" name="action" id="hidden_action" value="insert_club_society">


				<div id="action" class="radio-group">
					<input type="radio" name="insert_or_update" id="insert" value="insert_club_society" checked="checked" onclick="update_elements_and_action('insert','update','hidden_action')">Insert
					<input type="radio" name="insert_or_update" id="update" value="update_club_society" onclick="update_elements_and_action('insert','update','hidden_action')">Update
				</div>
			

				<label id="referance-element" class="form">Club Name</label>
				<input id="reference-input" class="input" type="text"  name="clubName" ><br>
			


				<label class="form">President Name</label>
				<input class="input" type="text"  name="president" ><br>
				
				<label class="form">Contact Number</label>
				<input class="input" type="text"  name="contact" ><br>
				
				<label class="form">Email Address</label>
				<input class="input" type="text" name="email"><br>

				<label class="form">Facebook</label>
				<input class="input" type="text" name="facebook"><br>

				<label class="form">Club Image Link</label>
				<input class="input" type="text" name="imagePath"><br>
				
				<input id="button" type="submit" value="submit">
					
			</form>
	</div>

	<?php if(isset($error_message)) :?>
		<p class="error-message">
			<?php echo '*'.$error_message;?>
		</p>
	<?php endif; ?>
	

	
</body>
</html>