<?php

// Include the connection file

function get_all_kelas()
{
    include '../../../connection/connection.php';

    $sql = "SELECT kelas.id, kelas.nama as nama_kelas, kelas.kode_kelas, user.nama as wali_kelas, user.id as id_wali from kelas JOIN user ON kelas.wali_kelas = user.id";
    $result = $conn->query($sql);

    return $result;
}

function get_all_guru() {
    include '../../../connection/connection.php';

    $sql = "SELECT * FROM user WHERE role_id = 2";

    $result = $conn->query($sql);
    return $result;
}

function get_wali_kelas(){
    include '../../connection/connection.php';
    $sql = "SELECT * FROM user WHERE role_id = 2";
    $result = $conn->query($sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    echo json_encode($data);
}

function edit_kelas($id)
{
    include '../../connection/connection.php';
    session_start();
    $nama = $_POST['nama'];
    $kode_kelas = $_POST['kode_kelas'];
    $wali_kelas = $_POST['wali_kelas'];
    $sql = "UPDATE kelas SET nama = '$nama', kode_kelas = '$kode_kelas', wali_kelas = $wali_kelas WHERE id = $id";
    
    if($conn->query($sql) === TRUE){
        $_SESSION['status'] = "success";
        $_SESSION['msg'] = "Data Berhasil Diubah";
        echo "<script>location.href = '../../pages/admin/kelas/kelas.php';</script>";
    }else{
        $_SESSION['status'] = "error";
        $_SESSION['msg'] = "Data Gagal Diubah";
        echo "<script>location.href = '../../pages/admin/kelas/kelas.php';</script>";
    }
    
}

function delete_kelas($id){
    include '../../connection/connection.php';
    $sql = "DELETE FROM kelas WHERE id = $id";
    $conn->query($sql);
    
    header('location: ../../pages/admin/kelas.php');
}

function add_kelas(){
    include '../../connection/connection.php';
    session_start();
    $nama = $_POST['nama'];
    $kode_kelas = $_POST['kode_kelas'];
    $wali_kelas = $_POST['wali_kelas'];

    $sql = "INSERT INTO kelas VALUES (null, '$nama', '$kode_kelas', $wali_kelas)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = "success";
        $_SESSION['msg'] = "Data Berhasil Ditambahkan";
        echo "<script>location.href = '../../pages/admin/kelas/kelas.php';</script>";
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['msg'] = "Data Gagal Ditambahkan";
        echo "<script>location.href = '../../pages/admin/kelas/kelas.php';</script>";
    }
}

if (isset($_GET['action'])) {
    
    $action = $_GET['action'];
    
    if ($action == 'edit') {
        $id = $_POST['id'];
        $data = edit_kelas($id);
    } elseif ($action == 'delete') {
        $id = $_GET['id'];
        delete_kelas($id);
        header('location: ../../pages/admin/kelas/kelas.php');
    } elseif ($action == 'add') {
        add_kelas();
    } elseif($action == 'get_wali_kelas'){
        get_wali_kelas();
    }
}
