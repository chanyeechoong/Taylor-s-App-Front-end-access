<?php
//Enable the code below before deploying
//require_once ('util/secure_connection_helper.php');
require_once ('util/valid_admin.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Campus News</title>
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
				hiddenElement.setAttribute('value','insert_event');
				document.getElementById("reference-to-remove").remove();
				document.getElementById("reference-to-remove-2").remove();
				var e = document.getElementsByTagName("br")[0];
				parentElement.removeChild(e);
				document.getElementById('updatePara').remove();
				x = 1;
			};

			if (updateElement.checked && x == 1) {

				
				hiddenElement.setAttribute('value','update_event');
				
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
		<caption>Events List</caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>Event Name</th>
				<th>Club Name</th>
				<th>Event Start Date</th>
				<th>Event Star Time</th>
				<th>Event End Date</th>
				<th>Event End Time</th>
				<th>Location</th>
				<th>Latitude</th>
				<th>Longitude</th>
				<th>Email Contact</th>
				<th>Event Link</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($result as $value):
			$id = $value['id'];
			$eventName = $value['eventName'];
			$clubName = $value['clubName'];
			$eventStartDate = $value['eventStartDate'];
			$eventStartTime = $value['eventStartTime'];
			$eventEndDate = $value['eventEndDate'];
			$eventEndTime = $value['eventEndTime'];
			$location = $value['location'];
			$latitude = $value['latitude'];
			$longitude = $value['longitude'];
			$emailContact = $value['emailContact'];
			$eventLink = $value['eventLink'];
		?>
		<tr>
			<td><?php echo $id ?></td>
			<td><?php echo $eventName;?></td>
			<td><?php echo $clubName;?></td>
			<td><?php echo $eventStartDate; ?></td>
			<td><?php echo $eventStartTime; ?></td>
			<td><?php echo $eventEndDate; ?></td>
			<td><?php echo $eventEndTime; ?></td>
			<td><?php echo $location; ?></td>
			<td><?php echo $latitude; ?></td>
			<td><?php echo $longitude; ?></td>
			<td><?php echo $emailContact; ?></td>
			<td><?php echo $eventLink; ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>		



		<div id="form-wrapper" class="form-wrapper">

			<form id="form-action" action="../." method="post">
				
				<input type="hidden" name="action" id="hidden_action" value="insert_event">

				<p class="error-message">Please leave longitude and latitude empy until further Notice.</p>
				<div id="action" class="radio-group">
					<input type="radio" name="insert_or_update" id="insert" value="insert_event" checked="checked" onclick="update_elements_and_action('insert','update','hidden_action')">Insert
					<input type="radio" name="insert_or_update" id="update" value="update_event" onclick="update_elements_and_action('insert','update','hidden_action')">Update
				</div>
			

				<label id="referance-element" class="form">Event Name</label>
				<input id="reference-input" class="input" type="text"  name="eventName" ><br>
			


				<label class="form">Club Name</label>
				<input class="input" type="text"  name="clubName" ><br>
				
				<label class="form">Event Start Date</label>
				<input class="input" type="text"  name="eventStartDate" ><br>
				
				<label class="form">Event Start Time</label>
				<input class="input" type="text" name="eventStartTime"><br>

				<label class="form">Event End Date</label>
				<input class="input" type="text" name="eventEndDate"><br>

				<label class="form">Event End Time</label>
				<input class="input" type="text" name="eventEndTime"><br>

				<label class="form">Location</label>
				<input class="input" type="text" name="location"><br>

				<!-- 
				//Will add this soon

				<label class="form">Latitude</label>
				<input class="input" type="text" name="latitude">*<br>

				<label class="form">Longitude</label>
				<input class="input" type="text" name="longitude">*<br>

				 -->
				
				<label class="form">Email Contact</label>
				<input class="input" type="text" name="emailContact"><br>

				<label class="form">Event Link</label>
				<input class="input" type="text" name="eventLink"><br>
				
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