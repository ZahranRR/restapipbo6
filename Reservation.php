<?php
class Reservation {
    private $conn;
    private $table = "reservations";

    public $id;
    public $field_name;
    public $user_name;
    public $reservation_date;
    public $start_time;
    public $end_time;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (field_name, user_name, reservation_date, start_time, end_time)
                  VALUES (:field_name, :user_name, :reservation_date, :start_time, :end_time)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":field_name", $this->field_name);
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":reservation_date", $this->reservation_date);
        $stmt->bindParam(":start_time", $this->start_time);
        $stmt->bindParam(":end_time", $this->end_time);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET
                  field_name = :field_name,
                  user_name = :user_name,
                  reservation_date = :reservation_date,
                  start_time = :start_time,
                  end_time = :end_time
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":field_name", $this->field_name);
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":reservation_date", $this->reservation_date);
        $stmt->bindParam(":start_time", $this->start_time);
        $stmt->bindParam(":end_time", $this->end_time);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
