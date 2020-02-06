<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'inc/config.inc.php' ;

$connect = $pdo;

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $data = array(
        ':voller_name' => "%" . $_GET['voller_name'] . "%",
        ':addresse' => "%" . $_GET['addresse'] . "%",
        ':mobil' => "%" . $_GET['mobil'] . "%",
        ':tel' => "%" . $_GET['tel'] . "%",
        ':mail' => "%" . $_GET['mail'] . "%",
        ':www' => "%" . $_GET['www'] . "%",
        ':lat' => "%" . $_GET['lat'] . "%",
        ':lng' => "%" . $_GET['lng'] . "%",
        ':kategorie' => "%" . $_GET['kategorie'] . "%",
    );

    $query = "SELECT * FROM markers WHERE voller_name LIKE :voller_name AND addresse LIKE :addresse AND mobil LIKE :mobil AND tel LIKE :tel AND mail LIKE :mail AND www LIKE :www AND lat LIKE :lat AND lng LIKE :lng AND kategorie LIKE :kategorie ORDER BY id DESC";

    $statement = $connect->prepare($query);
    $statement->execute($data);
    $result = $statement->fetchAll();
    $output = array();
    foreach ($result as $row) {
        $output[] = array(
            'id' => $row['id'],
            'voller_name' => $row['voller_name'],
            'addresse' => $row['addresse'],
            'mobil' => $row['mobil'],
            'tel' => $row['tel'],
            'mail' => $row['mail'],
            'www' => $row['www'],
            'lat' => $row['lat'],
            'lng' => $row['lng'],
            'kategorie' => $row['kategorie'],
        );
    }

    header("Content-Type: application/json");
    echo json_encode($output);
}

if ($method == "POST") {
    $addresse = $_POST['addresse'];
    $api_address = preg_replace('/,/ ', ' ', $addresse);
    $api_address = preg_replace('/ +/ ', '+', $api_address);
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $api_address . '&key=AIzaSyAUKiRWWU2Iz8EBxuRt6lCAdJ7J5zL0nww';
// var_dump($url);
    $response = json_decode(file_get_contents($url));
// var_dump($response);
    $lat = $response->results[0]->geometry->location->lat;
    $lng = $response->results[0]->geometry->location->lng;
    $data = array(
        ':voller_name' => $_POST['voller_name'],
        ':addresse' => $_POST['addresse'],
        ':mobil' => $_POST['mobil'],
        ':tel' => $_POST['tel'],
        ':mail' => $_POST['mail'],
        ':www' => $_POST['www'],
        ':lat' => $lat,
        ':lng' => $lng,
        ':kategorie' => $_POST['kategorie'],
    );

    $query = "INSERT INTO markers (voller_name, addresse, mobil, tel, mail, www, lat, lng, kategorie) VALUES (:voller_name, :addresse, :mobil, :tel, :mail, :www, :lat, :lng, :kategorie)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
}

if ($method == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $data = array(
        ':id' => $_PUT['id'],
        ':voller_name' => $_PUT['voller_name'],
        ':addresse' => $_PUT['addresse'],
        ':mobil' => $_PUT['mobil'],
        ':tel' => $_PUT['tel'],
        ':mail' => $_PUT['mail'],
        ':www' => $_PUT['www'],
        ':lat' => $_PUT['lat'],
        ':lng' => $_PUT['lng'],
        ':kategorie' => $_PUT['kategorie'],
    );
    $query = "
UPDATE markers
SET voller_name = :voller_name,
addresse = :addresse,
mobil = :mobil,
tel = :tel,
mail = :mail,
www = :www,
lat = :lat,
lng = :lng,
kategorie = :kategorie
WHERE id = :id
";
    $statement = $connect->prepare($query);
    $statement->execute($data);
}

if ($method == "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $query = "DELETE FROM markers WHERE id = '" . $_DELETE["id"] . "'";
    $statement = $connect->prepare($query);
    $statement->execute();
}
