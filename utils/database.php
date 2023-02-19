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

function select($con, $sql, $params) {
    $result = array();
    $query = $con->execute_query($sql, $params);

    while ($row = $query->fetch_row()) {
        array_push($result, $row);
    }

    return $result;
}

function edit($con, $sql, $types, $params) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
}
