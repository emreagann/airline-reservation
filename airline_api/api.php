<?php
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

// DB bağlantısı
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dbairline";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

switch ($method) {
case 'GET':
    if ($id) {
        $stmt = $conn->prepare("SELECT p.name, p.age, p.gender, p.phone,
                                        b.seat_number,
                                        f.DepartureCity, f.ArrivalCity, f.DepartureTime, f.ArrivalTime
                                FROM passengers p
                                LEFT JOIN bookings b ON p.id = b.passenger_id
                                LEFT JOIN flightmasters f ON b.flightmaster_id = f.id
                                WHERE p.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }

        if ($details) {
            echo json_encode($details);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Passenger not found"]);
        }
        $stmt->close();
    }

else {
        $result = $conn->query("SELECT p.name, p.age, p.gender, p.phone,
                                        b.seat_number,
                                        f.DepartureCity, f.ArrivalCity, f.DepartureTime, f.ArrivalTime
                                FROM passengers p
                                LEFT JOIN bookings b ON p.id = b.passenger_id
                                LEFT JOIN flightmasters f ON b.flightmaster_id = f.id");

        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        echo json_encode($details);
    }
    break;
      

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['name'], $data['age'], $data['gender'], $data['phone'], $data['booking'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing parameters"]);
            break;
        }

        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("INSERT INTO passengers (name, age, gender, phone) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $data['name'], $data['age'], $data['gender'], $data['phone']);
            $stmt->execute();
            $passenger_id = $stmt->insert_id;
            $stmt->close();

            $flight = $data['booking']['flight'];
            $stmt = $conn->prepare("SELECT id FROM flightmasters WHERE DepartureCity = ? AND ArrivalCity = ? AND DepartureTime = ? AND ArrivalTime = ?");
            $stmt->bind_param("ssss", $flight['DepartureCity'], $flight['ArrivalCity'], $flight['DepartureTime'], $flight['ArrivalTime']);
            $stmt->execute();
            $stmt->bind_result($flight_id);
            $stmt->fetch();
            $stmt->close();

            if (!$flight_id) {
                $stmt = $conn->prepare("INSERT INTO flightmasters (DepartureCity, ArrivalCity, DepartureTime, ArrivalTime) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $flight['DepartureCity'], $flight['ArrivalCity'], $flight['DepartureTime'], $flight['ArrivalTime']);
                $stmt->execute();
                $flight_id = $stmt->insert_id;
                $stmt->close();
            }

            $seat_number = $data['booking']['seat_number'];
            $stmt = $conn->prepare("INSERT INTO bookings (passenger_id, flightmaster_id, seat_number) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $passenger_id, $flight_id, $seat_number);
            $stmt->execute();
            $booking_id = $stmt->insert_id;
            $stmt->close();

            $conn->commit();
            http_response_code(201);
            echo json_encode(["message" => "Passenger, flight and booking created", "passenger_id" => $passenger_id, "flight_id" => $flight_id, "booking_id" => $booking_id]);
        } catch (Exception $e) {
            $conn->rollback();
            http_response_code(500);
            echo json_encode(["error" => "Transaction failed: " . $e->getMessage()]);
        }
        break;

    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "Passenger ID required"]);
            break;
        }

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['name'], $data['age'], $data['gender'], $data['phone'], $data['booking'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing parameters"]);
            break;
        }

        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("UPDATE passengers SET name = ?, age = ?, gender = ?, phone = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $data['name'], $data['age'], $data['gender'], $data['phone'], $id);
            $stmt->execute();
            $stmt->close();

            $flight = $data['booking']['flight'];
            $stmt = $conn->prepare("SELECT id FROM flightmasters WHERE DepartureCity = ? AND ArrivalCity = ? AND DepartureTime = ? AND ArrivalTime = ?");
            $stmt->bind_param("ssss", $flight['DepartureCity'], $flight['ArrivalCity'], $flight['DepartureTime'], $flight['ArrivalTime']);
            $stmt->execute();
            $stmt->bind_result($flight_id);
            $stmt->fetch();
            $stmt->close();

            if (!$flight_id) {
                $stmt = $conn->prepare("INSERT INTO flightmasters (DepartureCity, ArrivalCity, DepartureTime, ArrivalTime) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $flight['DepartureCity'], $flight['ArrivalCity'], $flight['DepartureTime'], $flight['ArrivalTime']);
                $stmt->execute();
                $flight_id = $stmt->insert_id;
                $stmt->close();
            }

            $seat_number = $data['booking']['seat_number'];
            $stmt = $conn->prepare("SELECT id FROM bookings WHERE passenger_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($booking_id);
            $stmt->fetch();
            $stmt->close();

            if ($booking_id) {
                $stmt = $conn->prepare("UPDATE bookings SET flightmaster_id = ?, seat_number = ? WHERE id = ?");
                $stmt->bind_param("isi", $flight_id, $seat_number, $booking_id);
                $stmt->execute();
                $stmt->close();
            } else {
                $stmt = $conn->prepare("INSERT INTO bookings (passenger_id, flightmaster_id, seat_number) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $id, $flight_id, $seat_number);
                $stmt->execute();
                $stmt->close();
            }

            $conn->commit();
            echo json_encode(["message" => "Passenger and booking updated"]);
        } catch (Exception $e) {
            $conn->rollback();
            http_response_code(500);
            echo json_encode(["error" => "Transaction failed: " . $e->getMessage()]);
        }
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "Passenger ID required"]);
            break;
        }

        $stmt = $conn->prepare("DELETE FROM passengers WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Passenger and related bookings deleted"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to delete passenger"]);
        }
        $stmt->close();
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        break;
}

$conn->close();
?>
