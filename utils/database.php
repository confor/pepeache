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

function select($con, $sql, $types, $params) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $result = $stmt->execute();

    if ($result === false) {
        return false;
    } else {
        $output = array();
        $result = $stmt->get_result();
        while ($fila = $result->fetch_assoc()) {
            array_push($output, $fila);
        }
        return $output;
    }
}

function select_all($con, $sql) {
    $stmt = $con->prepare($sql);
    $result = $stmt->execute();

    if ($result === false) {
        return false;
    } else {
        $output = array();
        $result = $stmt->get_result();
        while ($fila = $result->fetch_assoc()) {
            array_push($output, $fila);
        }
        return $output;
    }
}

function edit($con, $sql, $types, $params) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param($types, ...$params);
    
    return $stmt->execute();
}

function insert($con, $sql, $types, $params) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param($types, ...$params);
    
    return $stmt->execute();
}

function delete($con, $sql, $type, $id) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $id);
    
    return $stmt->execute();
}
