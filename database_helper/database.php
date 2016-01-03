<?php
$dsn = 'mysql:host=127.0.0.1:3306;dbname=college_database';
//$dsn = 'mysql:unix_socket=/cloudsql/canvas-sum-91507:taylorsappstorage2;dbname=college_database';
$username = 'tcsjofficial';
$password = 'CPxY76kF+$9RUt;G';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error = $e->getMessage();
    echo $error;
    exit();
}
?>