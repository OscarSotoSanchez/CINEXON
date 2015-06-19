<?php

/* Clase encargada de gestionar la BBDD */

class DataBase {

    private $connection;
    private $host = "localhost";
    private $user = "procfinal";
    private $pass = "procfinal";
    private $dataBase = "db_movies";

    /* Metodo encargado de conectarse a la BBDD */

    public function connection_database() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->dataBase);
        $this->execution_query('SET NAMES utf8');
    }

    /* Metodo encargado de ejecutar consultas en la BBDD */

    public function execution_query($query) {
        return $this->connection->query($query);
    }

    /* Metodo encargado de cerrar la conexion a la BBDD */

    public function disconnect_database() {
        $this->connection->close();
    }

    public function id_autoincrement() {
        return $this->connection->insert_id;
    }

    public function afected_rows() {
        return $this->connection->affected_rows;
    }

    public function scape_string($string) {
        $this->connection_database();
        $scape = mysqli_real_escape_string($this->connection, $string);
        $this->disconnect_database();
        return $scape;
    }

}
