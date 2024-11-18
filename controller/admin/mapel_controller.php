<?php

// Include the connection file

function get_all_mapel()
{
    include '../../../connection/connection.php';

    $sql = "SELECT mapel.id, mapel.nama as nama_mapel, user.nama as pengajar from mapel JOIN user ON mapel.pengajar = user.id";
    $result = $conn->query($sql);

    return $result;
}

function get_all_guru() {
    include '../../../connection/connection.php';

    $sql = "SELECT * FROM user WHERE role_id = 2";

    $result = $conn->query($sql);
    return $result;
}

function edit_mapel($id)
{
    include '../../connection/connection.php';
    session_start();
    $nama = $_POST['nama'];
    $mapelname = $_POST['mapelname'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $sql = "UPDATE mapel SET nama = '$nama', mapelname = '$mapelname', password = '$password', role_id = $role WHERE id = $id";
    
    if($conn->query($sql) === TRUE){
        $_SESSION['status'] = "success";
        $_SESSION['msg'] = "Data Berhasil Diubah";
        echo "<script>location.href = '../../pages/admin/mapel/mapel.php';</script>";
    }else{
        $_SESSION['status'] = "error";
        $_SESSION['msg'] = "Data Gagal Diubah";
        echo "<script>location.href = '../../pages/admin/mapel/mapel.php';</script>";
    }
    
}

function delete_mapel($id){
    include '../../connection/connection.php';
    $sql = "DELETE FROM mapel WHERE id = $id";
    $conn->query($sql);
    
    header('location: ../../pages/admin/mapel.php');
}

function add_mapel(){
    include '../../connection/connection.php';
    session_start();
    $nama = $_POST['nama'];
    $kode_mapel = $_POST['kode_mapel'];
    $wali_mapel = $_POST['wali_mapel'];

    $sql = "INSERT INTO mapel VALUES (null, '$nama', '$kode_mapel', $wali_mapel)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = "success";
        $_SESSION['msg'] = "Data Berhasil Ditambahkan";
        echo "<script>location.href = '../../pages/admin/mapel/mapel.php';</script>";
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['msg'] = "Data Gagal Ditambahkan";
        echo "<script>location.href = '../../pages/admin/mapel/mapel.php';</script>";
    }
}

if (isset($_GET['action'])) {
    
    $action = $_GET['action'];
    
    if ($action == 'edit') {
        $id = $_POST['id'];
        $data = edit_mapel($id);
    } elseif ($action == 'delete') {
        $id = $_GET['id'];
        delete_mapel($id);
        header('location: ../../pages/admin/mapel/mapel.php');
    } elseif ($action == 'add') {
        add_mapel();
    }
}
