<?php

function connect() {
    $host = "127.0.0.1"; # ??
    $username  = "uwu";
    $passwd = "uwu";
    $dbname = "utalcago";
    $port = 2732;

    $con = new mysqli($host, $username, $passwd, $dbname, $port);

    if ($con)
        return $con;

    return "Connection Failed";
}

function select($con, $sql, $params) {
    $result = array();
    $query = $con->execute_query($sql, $params);

    while ($row = $query->fetch_row()) {
        array_push($result, $row);
    }

    return $result;
}

function select_all($con, $sql) {
    $result = array();
    $query = $con->execute_query($sql);

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

function insert($con, $sql, $types, $params) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
}

function delete($con, $sql, $type, $id) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $id);
    $stmt->execute();
}
