<?php
require_once "db.php";
require_once "Reservation.php";

header("Content-Type: application/json");

$database = new Database();
$db = $database->getConnection();

$reservation = new Reservation($db);

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    $reservation->field_name = $data->field_name;
    $reservation->user_name = $data->user_name;
    $reservation->reservation_date = $data->reservation_date;
    $reservation->start_time = $data->start_time;
    $reservation->end_time = $data->end_time;

    if ($reservation->create()) {
        echo json_encode(["message" => "Reservation created successfully"]);
    } else {
        echo json_encode(["message" => "Failed to create reservation"]);
    }
} elseif ($method === 'GET') {
    $stmt = $reservation->read();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($reservations);
} elseif ($method === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));

    $reservation->id = $data->id;
    $reservation->field_name = $data->field_name;
    $reservation->user_name = $data->user_name;
    $reservation->reservation_date = $data->reservation_date;
    $reservation->start_time = $data->start_time;
    $reservation->end_time = $data->end_time;

    if ($reservation->update()) {
        echo json_encode(["message" => "Reservation updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update reservation"]);
    }
} elseif ($method === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));

    $reservation->id = $data->id;

    if ($reservation->delete()) {
        echo json_encode(["message" => "Reservation deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete reservation"]);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
