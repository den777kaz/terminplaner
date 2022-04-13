<?php

namespace database;


use mysqli_result;
class Mysqli
{
    private string $HOST = 'localhost';
    private string $LOGIN= "root";
    private string $PASSWORD = "root";
    private string $DB_NAME = "calendar";

    protected bool|\mysqli|null $connection;



    public function get_query_from_file(string $filename): string
    {
        return file_get_contents("lib/sql/" . $filename . ".sql");
    }


    public function __construct()
    {
       return  $this->connect();
    }


    public function sql_request(string $sql_query, array $data = []): bool|mysqli_result
    {
//        $sql_query = $this->get_query_from_file($sql_query);
        $this->connect();

        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $data[$key] = mysqli_real_escape_string($this->connection, $value);
                $sql_query = str_replace(":" . $key, "'" . $value . "'", $sql_query);
            }
        }
        return mysqli_query($this->connection, $sql_query);
    }

    public function select(string $sql_query, array $data = []): array
    {
        $response = $this->sql_request($sql_query, $data);
        $data_list = array();
        while ($item = mysqli_fetch_assoc($response)) {
            $data_list[] = $item;
        }
        return $data_list;
    }

    public function update(string $sql_query, array $data = []): void
    {
        $this->sql_request($sql_query, $data);
    }

    public function create(string $sql_query, array $data = []): void
    {
        $this->sql_request($sql_query, $data);
    }

    public function delete(string $sql_query, array $data = []): void
    {
        $this->sql_request($sql_query, $data);

    }

    public function connect(): bool|\mysqli|null
    {
        $conn = mysqli_connect($this->HOST, $this->LOGIN, $this->PASSWORD, $this->DB_NAME);
        mysqli_query($conn, "SET names utf8");
        return $this->connection = $conn;
    }

    public function disconnect($con): void
    {
        mysqli_close($con);
    }

    public function __destruct()
    {

        $this->disconnect($this->connection);
    }
}


