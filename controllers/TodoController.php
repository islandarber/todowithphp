<?php

require_once('../models/Todo.php');

class TodoController {
    private $todo;

    public function __construct($pdo) {
        $this->todo = new Todo($pdo);
    }

    public function index() {
        return $this->todo->getAll();
    }

    public function show($id) {
        return $this->todo->get($id);
    }

    public function store($task) {
        return $this->todo->create($task);
    }

    public function update($id, $task, $is_completed) {
        return $this->todo->update($id, $task, $is_completed);
    }

    public function destroy($id) {
        return $this->todo->delete($id);
    }
}
?>