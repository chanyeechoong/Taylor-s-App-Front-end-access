<?php

function get_items_from_academicnews(){
 	    $query = 'SELECT * FROM academicnews ORDER BY id';
        $result = prepareQuery($query);
        return $result;
}

function get_item_from_campusnews(){

        $query = 'SELECT * FROM campusnews ORDER BY id';
        $result = prepareQuery($query);
        return $result;
}

function get_item_from_clubs(){
        $query = 'SELECT * FROM clubsinformation ORDER BY id';
        $result = prepareQuery($query);
        return $result;
}

function get_item_from_eventsinformation(){
        $query = 'SELECT * FROM eventInformation ORDER BY id';
        $result = prepareQuery($query);
        return $result;
}

function prepareQuery($query){
try {
        global $db;
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo $error_message;
    }
}








?>