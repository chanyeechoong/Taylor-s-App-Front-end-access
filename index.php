<?php
session_start();

require ('database_helper/admin_db.php');
require ('database_helper/database.php');
require ('helper_function/select_helper_function.php');
require ('helper_function/insert_helper_function.php');
require ('helper_function/update_helper_function.php');

$action = isset($_POST['action']) ? $_POST['action']:'';
if ($action == NULL) {
	$action = $_GET['action'];
	if ($action == NULL) {
		$action='';
	}
}

switch ($action) {
	case 'login':
		# Check for login here
		$email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($email, $password)) {
            //Show success login webpage
            $_SESSION['is_valid_admin'] = true;
            include ('view/mainview.php');
        } else {
           //Show login failure webpage
        	$error_message = "<p id='error-class'>Incorrect Login Credentials. Please try again.</p>";
       		include('login.php');
        }
		break;

	case 'academic_news':
		$result = get_items_from_academicnews();
		include ('view/academicnews.php');
		break;

	case 'campus_news':
		$result = get_item_from_campusnews();
		include ('view/campusnews.php');
		break;

	case 'clubsinformation':
		$result = get_item_from_clubs();
		include('view/clubs_society.php');
		break;

	case 'eventsinformation':
		$result = get_item_from_eventsinformation();
		include('view/events.php');
		break;

	case 'logout':
			$_SESSION = array();
			session_destroy(); 
			include 'login.php';
		break;

	case 'insert_academic_news':

		if (empty($_POST['title'])||empty($_POST['content']) || empty($_POST['imagePath'])||empty($_POST['date'])) {

			$error_message = "Please ensure all forms are filled";
			$result = get_items_from_academicnews();

			include ('view/academicnews.php');

		}else{
			insert_into_academicnews($_POST['title'], $_POST['content'], 
							$_POST['imagePath'],$_POST['date']);
		 	header("Location: .?action=academic_news");
		}
	break;

	case 'insert_campus_news':

		if (empty($_POST['title'])||empty($_POST['content']) || empty($_POST['imagePath'])||empty($_POST['date'])) {

			$error_message = "Please ensure all forms are filled";
			$result = get_item_from_campusnews();

			include ('view/campusnews.php');
		}else{

			insert_into_campusnews($_POST['title'], $_POST['content'], 
							$_POST['imagePath'],$_POST['date']);
		 	header("Location: .?action=campus_news");

		}
	break;

	case 'insert_club_society':

		if (empty($_POST['clubName'])||empty($_POST['president']) 
			|| empty($_POST['contact'])||empty($_POST['email'])
			||empty($_POST['facebook'])||empty($_POST['imagePath'])){
			$error_message = "Please ensure all forms are filled";
			$result = get_item_from_clubs();

			include('view/clubs_society.php');
		}else{

	
			insert_into_club_society($_POST['clubName'],$_POST['president']
										,$_POST['contact'],$_POST['email']
										,$_POST['facebook'],$_POST['imagePath']);

		 	header("Location: .?action=clubsinformation");

		}
		break;
	case 'insert_event':



		if 	(

			empty($_POST['eventName'])||empty($_POST['clubName']) || empty($_POST['eventStartDate'])
			||empty($_POST['eventStartTime'])||empty($_POST['eventEndDate'])||
			empty($_POST['eventEndTime'])||empty($_POST['location'])||empty($_POST['emailContact'])||empty($_POST['eventLink'])

			){
			echo "first";
			$error_message = "Please ensure all forms are filled. Note that Longitude and Latitude fields are not must-filled field.";
			$result = get_item_from_eventsinformation();
			include('view/events.php');
			break;
			
		}elseif ( (isset($_POST['latitude'])&&trim($_POST['test']) != '') && (isset($_POST['longitude'])&&trim($_POST['test']) != '') ){
			echo "second";
			insert_into_event($_POST['eventName'],$_POST['clubName'],$_POST['eventStartDate'],$_POST['eventStartTime']
				,$_POST['eventEndDate'],$_POST['eventEndTime'],$_POST['location'],$_POST['latitude'],$_POST['longitude']
				,$_POST['emailContact'],$_POST['eventLink']);

		}elseif (    (  !empty($_POST['latitude'])  && empty($_POST['longitude'])  ) ||
					 (  !empty($_POST['longitude']) && empty($_POST['latitude'])   )     ) {
			echo "Thrid";
			$result = get_item_from_eventsinformation();
			$error_message = "Please ensure both Longitude and Latitude fields are filled.";
			include('view/events.php');
			break;

		}else{
			
			insert_into_event_without_coordinates($_POST['eventName'],$_POST['clubName'],$_POST['eventStartDate'],$_POST['eventStartTime']
				,$_POST['eventEndDate'],$_POST['eventEndTime'],$_POST['location'],$_POST['emailContact'],$_POST['eventLink']);
		}
		
		header("Location: .?action=eventsinformation");
		break;





	case 'update_academic_news':

	//Update Code For Academic News Runs Here
	if (empty($_POST['title'])||empty($_POST['content']) || empty($_POST['imagePath'])||empty($_POST['date'])||empty($_POST['id'])){
			$error_message = "Please ensure all forms are filled";
			$result = get_items_from_academicnews();

			include ('view/academicnews.php');
	}else{

		update_academicnews($_POST['id'],$_POST['title'],$_POST['content'],$_POST['imagePath'],$_POST['date']);


		header("Location: .?action=academic_news");

	}
	break;

	
	case 'update_campus_news':
		if (empty($_POST['title'])||empty($_POST['content']) || empty($_POST['imagePath'])||empty($_POST['date'])) {

			$error_message = "Please ensure all forms are filled";
			$result = get_item_from_campusnews();

			include ('view/campusnews.php');
		}else{

			update_campusnews($_POST['id'],$_POST['title'],$_POST['content'],$_POST['imagePath'],$_POST['date']);
			header("Location: .?action=campus_news");
		}
	break;
	
	case 'update_club_society';

	if (empty($_POST['id'])||
		empty($_POST['clubName'])||empty($_POST['president']) || empty($_POST['contact'])
		||empty($_POST['email'])||empty($_POST['facebook'])||empty($_POST['imagePath']))
	{
		$error_message = "Please ensure all forms are filled";
			$result = get_item_from_clubs();

			include('view/clubs_society.php');
	}else{


			update_club_society($_POST['id'],$_POST['clubName'],$_POST['president']
										,$_POST['contact'],$_POST['email']
										,$_POST['facebook'],$_POST['imagePath']);

			header("Location: .?action=clubsinformation");
	}
	break;

	case 'update_event':

		if 	(empty($_POST['id'])||empty($_POST['eventName'])||empty($_POST['clubName']) || empty($_POST['eventStartDate'])
				||empty($_POST['eventStartTime'])||empty($_POST['eventEndDate'])||
				empty($_POST['eventEndTime'])||empty($_POST['location'])||empty($_POST['emailContact'])||empty($_POST['eventLink'])
				){
				
				$error_message = "Please ensure all forms are filled";
				$result = get_item_from_eventsinformation();
				include('view/events.php');

		}else{
			update_event($_POST['id'],$_POST['eventName'],$_POST['clubName'],$_POST['eventStartDate'],$_POST['eventStartTime']
						,$_POST['eventEndDate'],$_POST['eventEndTime'],$_POST['location'],$_POST['emailContact'],$_POST['eventLink']);
			header("Location: .?action=eventsinformation");
		}
	break;


	default:

		if ($_SESSION['is_valid_admin'] == true) {
			include('view/mainview.php');
		}else{
			include 'login.php';
		}
	break;
}




?>