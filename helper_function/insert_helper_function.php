<?php

function insert_into_academicnews($title, $content, $imagePath, $date){
	global $db;
	$query ='INSERT INTO academicnews (title,anewsContent,imagePath,timeNews)
			 VALUES(:title,:content,:imagePath,:newsDate)';

	$statement = $db->prepare($query);
	$statement->bindValue(':title',$title);
	$statement->bindValue(':content',$content);
	$statement->bindValue(':imagePath',$imagePath);
	$statement->bindValue(':newsDate',$date);
	$rowcount = $statement->execute();
	$statement->closeCursor();
}

function insert_into_campusnews($title, $content, $imagePath, $date){
	global $db;
	$query ='INSERT INTO campusnews (title,cnewsContent,imagePath,timeNews)
			 VALUES(:title,:content,:imagePath,:newsDate)';

	$statement = $db->prepare($query);
	$statement->bindValue(':title',$title);
	$statement->bindValue(':content',$content);
	$statement->bindValue(':imagePath',$imagePath);
	$statement->bindValue(':newsDate',$date);
	$rowcount = $statement->execute();
	$statement->closeCursor();
}

function insert_into_club_society($clubName,$president,$contact,$email,$facebook,$imagePath,$updateTime){
	global $db;

	$query = 'INSERT INTO clubsinformation(clubsName,president,contact,email,facebook,imagePath,updateTime) 
				VALUES(:clubsName,:president,:contact,:email,:facebook,:imagePath,:updateTime)';

	$statement = $db->prepare($query);
	$statement->bindValue(':clubsName',$clubName);
	$statement->bindValue(':president',$president);
	$statement->bindValue(':contact',$contact);
	$statement->bindValue(':email',$email);
	$statement->bindValue(':facebook',$facebook);
	$statement->bindValue(':imagePath',$imagePath);
	$statement->bindValue(':updateTime',$updateTime);

	$rowcount = $statement->execute();
	$statement->closeCursor();

}

function insert_into_event($eventName,$clubName, $eventStartDate, $eventStartTime, $eventEndDate, $eventEndTime, 
							$location, $latitude, $longitude, $emailContact, $eventLink){


	global $db;

	$query = 'INSERT INTO eventInformation(eventName,clubName,eventStartDate,eventStartTime,eventEndDate
		,eventEndTime,location,latitude,longitude,emailContact,eventLink) 
				VALUES(:eventName,:clubName,:eventStartDate,:eventStartTime,:eventEndDate,:eventEndTime,
					:location, :latitude, :longitude, :emailContact, :eventLink)';

	$statement = $db->prepare($query);
	$statement->bindValue(':eventName',$eventName);
	$statement->bindValue(':clubName',$clubName);
	$statement->bindValue(':eventStartDate',$eventStartDate);
	$statement->bindValue(':eventStartTime',$eventStartTime);
	$statement->bindValue(':eventEndDate',$eventEndDate);
	$statement->bindValue(':eventEndTime',$eventEndTime);
	$statement->bindValue(':location',$location);
	$statement->bindValue(':latitude',$latitude);
	$statement->bindValue(':longitude',$longitude);
	$statement->bindValue(':emailContact',$emailContact);
	$statement->bindValue(':eventLink',$eventLink);

	$rowcount = $statement->execute();
	$statement->closeCursor();

}

function insert_into_event_without_coordinates($eventName,$clubName, $eventStartDate, $eventStartTime, $eventEndDate, $eventEndTime, 
							$location, $emailContact, $eventLink){


	global $db;

	$query = 'INSERT INTO eventInformation(eventName,clubName,eventStartDate,eventStartTime,eventEndDate
						,eventEndTime,location,emailContact,eventLink) 
				VALUES(:eventName,:clubName,:eventStartDate,:eventStartTime,:eventEndDate,:eventEndTime,
					:location, :emailContact, :eventLink)';


	$statement = $db->prepare($query);
	$statement->bindValue(':eventName',$eventName);
	$statement->bindValue(':clubName',$clubName);
	$statement->bindValue(':eventStartDate',$eventStartDate);
	$statement->bindValue(':eventStartTime',$eventStartTime);
	$statement->bindValue(':eventEndDate',$eventEndDate);
	$statement->bindValue(':eventEndTime',$eventEndTime);
	$statement->bindValue(':location',$location);
	$statement->bindValue(':emailContact',$emailContact);
	$statement->bindValue(':eventLink',$eventLink);

	$rowcount = $statement->execute();
	$statement->closeCursor();
}






?>