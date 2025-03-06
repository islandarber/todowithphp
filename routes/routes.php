<?php

require_once '../config/db.php';
require_once '../controllers/TodoController.php';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$controller = new TodoController($pdo);

$requestMethod = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

switch ($path) {
    case '/todos':
        if ($requestMethod == 'GET') {
            echo json_encode($controller->index());
        } elseif ($requestMethod == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($controller->store($data['task']));
        }
        break;
    case (preg_match('/\/todos\/(\d+)/', $path, $matches) ? true : false):
        $id = $matches[1];
        if ($requestMethod == 'GET') {
            echo json_encode($controller->show($id));
        } elseif ($requestMethod == 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($controller->update($id, $data['task'], $data['is_completed']));
        } elseif ($requestMethod == 'DELETE') {
            echo json_encode($controller->destroy($id));
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
        break;
}
?>