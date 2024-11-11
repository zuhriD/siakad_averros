<?php

// Include the connection file

function get_all_user()
{
    include '../../../connection/connection.php';

    $sql = "SELECT user.id, user.nama as nama_user, role.nama as role, user.username from user JOIN role ON user.role_id = role.id";
    $result = $conn->query($sql);

    return $result;
}

function edit_user($id)
{
    include '../../connection/connection.php';
    $sql = "SELECT user.id, user.nama as nama_user, role.nama as role, user.username from user JOIN role ON user.role_id = role.id WHERE user.id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function delete_user($id){
    include '../../connection/connection.php';
    $sql = "DELETE FROM user WHERE id = $id";
    $conn->query($sql);
    
    header('location: ../../pages/admin/user.php');
}

function add_user(){
    include '../../connection/connection.php';
    session_start();
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO user VALUES (null, '$nama', '$username', '$password', $role)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "success";
        echo "<script>location.href = '../../pages/admin/user/user.php';</script>";
    } else {
        $_SESSION['message'] = "error";
        echo "<script>location.href = '../../pages/admin/user/user.php';</script>";
    }
}

if (isset($_GET['action'])) {
    
    $action = $_GET['action'];
    
    if ($action == 'edit') {
        $id = $_GET['id'];
        $data = edit_user($id);
        header('location: ../../pages/admin/user/edit.php?id=' . $data['id'] . '&nama=' . $data['nama_user'] . '&role=' . $data['role'] . '&username=' . $data['username']);
    } elseif ($action == 'delete') {
        $id = $_GET['id'];
        delete_user($id);
        header('location: ../../pages/admin/user/user.php');
    } elseif ($action == 'add') {
        add_user();
    }
}
