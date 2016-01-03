<?php

function add_admin($email, $password) {
    global $db;
    $password = sha1($email . $password);
    $query = 'INSERT INTO userList (username, password)
              VALUES (:email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_admin_login($email, $password) {
    global $db;
    $password = sha1($email . $password);
    $query = 'SELECT id FROM userList
              WHERE username = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

?>
