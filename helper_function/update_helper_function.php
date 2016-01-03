<?php

function update_academicnews($id,$title,$content,$imagePath,$date){

	global $db;
	$query = 'UPDATE academicnews SET 
				title = :title, anewsContent = :content , imagePath = :imagePath, timeNews = :timeNews 
				WHERE id = :id';

	$statement = $db->prepare($query);
	$statement->bindValue(':id',$id);
	$statement->bindValue(':title',$title);
	$statement->bindValue(':content',$content);
	$statement->bindValue(':imagePath',$imagePath);
	$statement->bindValue(':timeNews',$date);
	$rowcount = $statement->execute();
	$statement->closeCursor();


}

function update_campusnews($id,$title,$content,$imagePath,$date){
	
	global $db;
	$query = 'UPDATE campusnews SET 
				title = :title, cnewsContent = :content , imagePath = :imagePath, timeNews = :timeNews 
				WHERE id = :id';

	$statement = $db->prepare($query);
	$statement->bindValue(':id',$id);
	$statement->bindValue(':title',$title);
	$statement->bindValue(':content',$content);
	$statement->bindValue(':imagePath',$imagePath);
	$statement->bindValue(':timeNews',$date);
	$rowcount = $statement->execute();
	$statement->closeCursor();


}

function update_club_society($id,$clubName,$president,$contact,$email,$facebook,$imagePath){
	
	global $db;

	$query = 'UPDATE clubsinformation SET 
				clubsName = :clubName, president = :president , contact = :contact, email = :email, facebook = :facebook , imagePath = :imagePath
				WHERE id = :id';

	$statement = $db->prepare($query);
	$statement->bindValue(':id',$id);
	$statement->bindValue(':clubName',$clubName);
	$statement->bindValue(':president',$president);
	$statement->bindValue(':contact',$contact);
	$statement->bindValue(':email',$email);
	$statement->bindValue(':facebook',$facebook);
	$statement->bindValue(':imagePath',$imagePath);
	$rowcount = $statement->execute();
	$statement->closeCursor();


}

function update_event($id,$eventName,$clubName, $eventStartDate, $eventStartTime,
							 $eventEndDate, $eventEndTime, 
							$location, $emailContact, $eventLink){


	global $db;

	$query = 'UPDATE eventInformation SET 
				eventName = :eventName, clubName = :clubName
				, eventStartDate = :eventStartDate,  eventStartTime = :eventStartTime,
				eventEndDate = :eventEndDate, eventEndTime = :eventEndTime,
				location = :location, emailContact = :emailContact, eventLink = :eventLink
				WHERE id = :id';

	$statement = $db->prepare($query);
	$statement->bindValue(':id',$id);
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