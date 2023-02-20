<?php

class DatabaseConnection
{
    public PDO $connection;

    function __construct()
    {
        try {
            $this->connection = new PDO(DBDSN, DBUSER, DBPASSWORD,DBOPTION); //Start a new connection with PDO class
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }
};