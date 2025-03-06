<?php

class Todo {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM tasks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($task) {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (task) VALUES (?)");
        return $stmt->execute([$task]);
    }

    public function update($id, $task, $is_completed) {
        $stmt = $this->pdo->prepare("UPDATE tasks SET task = ?, is_completed = ? WHERE id = ?");
        return $stmt->execute([$task, $is_completed, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>