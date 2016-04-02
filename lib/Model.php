<?php

namespace MyApp;

class Model {
    protected $db;

    public function __construct() {
        try {
            $this->db = new \PDO(_DSN, _DB_USER, _DB_PASS);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
