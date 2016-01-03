<?php
//Enable the code below before deploying
	//require_once ('util/secure_connection_helper.php');
	require_once ('util/valid_admin.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Academic News</title>
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
				hiddenElement.setAttribute('value','insert_academic_news');
				document.getElementById("reference-to-remove").remove();
				document.getElementById("reference-to-remove-2").remove();
				var e = document.getElementsByTagName("br")[0];
				parentElement.removeChild(e);
				document.getElementById('updatePara').remove();
				x = 1;
			};

			if (updateElement.checked && x == 1) {

				
				hiddenElement.setAttribute('value','update_academic_news');
				
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
	<caption>Academic News List</caption>
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Content</th>
			<th>Image Path</th>
			<th>News Time</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($result as $value):

			$id = $value['id'];
			$title = $value['title'];
			$anewsContent = $value['anewsContent'];
			$imagePath = $value['imagePath'];
			$timeNews = $value['timeNews'];
			
		?>

		<tr>
			<td><?php echo $id ?></td>
			<td><?php echo $title;?></td>
			<td><?php echo $anewsContent;?></td>
			<td><?php echo $imagePath; ?></td>
			<td><?php echo $timeNews; ?></td>
		</tr>
			
		<?php endforeach; ?>
	</tbody>
</table>

<div id="form-wrapper" class="form-wrapper">

		<form id="form-action" action="../." method="post">
			
			
			<input type="hidden" id="hidden_action" name="action" value="insert_academic_news">

			<div id="action" class="radio-group">
				<input type="radio" name="insert_or_update" id="insert" value="insert_academic_news" checked="checked" onclick="update_elements_and_action('insert','update','hidden_action')">Insert
				<input type="radio" name="insert_or_update" id="update" value="update_academic_news" onclick="update_elements_and_action('insert','update','hidden_action')">Update
			</div>
			

			<label id="referance-element" class="form">Title</label>
			<input id="reference-input" class="input" type="text"  name="title" ><br>
		
			<div class="label-textarea">
				<label class="form">News Content</label>
				<textarea class="input" name="content" cols="40" rows="5" ... ></textarea><br>
			</div>
			
			<label class="form">Image Path</label>
			<input class="input" type="text"  name="imagePath" ><br>
			
			<label class="form">News Date</label>
			<input class="input" type="text" name="date" placeholder="YYYY-MM-DD"><br>
			
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