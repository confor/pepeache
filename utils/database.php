<?php

function connect() {
    $host = "127.0.0.1";
    $username  = "uwu";
    $passwd = "uwu";
    $dbname = "utalcago";
    $port = 2732;

    $con = new mysqli($host, $username, $passwd, $dbname, $port);
 
    if ($con) {
        //print("Connection Established Successfully");
        return $con;
    } else {
        return "Connection Failed";
    }
}

function select($con, $sql) {
    $result = array();
    $query = $con->query($sql);

    while ($row = $query->fetch_row()) {
        array_push($result, $row);
    }

    return $result;
}
