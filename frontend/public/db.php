<?php
function run_sql_query($query, ...$params)
{
    $servername = $_ENV['POSTGRES_HOST'];
    $username = $_ENV['POSTGRES_USER'];
    $password = $_ENV['POSTGRES_PASSWORD'];

    $conn_string = "host=$servername port=5432 dbname=db user=$username password=$password";
    $dbconn = pg_connect($conn_string);
    return pg_query_params($dbconn, $query, $params);
}
