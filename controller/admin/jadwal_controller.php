<?php

// Include the connection file

function get_all_jadwal()
{
    include '../../../connection/connection.php';

    $sql = "SELECT jadwal.id, kelas.nama AS nama_kelas, mapel.nama AS nama_mapel,jadwal.hari AS hari, user.nama AS pengajar, 
    jadwal.jam_mulai, jadwal.jam_selesai
FROM jadwal
JOIN user ON jadwal.pengajar_id = user.id
JOIN kelas ON jadwal.kelas_id = kelas.id
JOIN mapel ON jadwal.mapel_id = mapel.id";
    $result = $conn->query($sql);

    return $result;
}

function get_all_guru() {
    include '../../../connection/connection.php';

    $sql = "SELECT * FROM user WHERE role_id = 2";

    $result = $conn->query($sql);
    return $result;
}
function get_all_kelas() {
    include '../../../connection/connection.php';

    $sql = "SELECT * FROM kelas ";

    $result = $conn->query($sql);
    return $result;
}

function get_all_mapel() {
    include '../../../connection/connection.php';

    $sql = "SELECT * FROM mapel ";

    $result = $conn->query($sql);
    return $result;
}

function get_wali_jadwal(){
    include '../../connection/connection.php';
    $sql = "SELECT * FROM user WHERE role_id = 2";
    $result = $conn->query($sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    echo json_encode($data);
}

function edit_jadwal($id)
{
    include '../../connection/connection.php';
    session_start();
    $nama = $_POST['nama'];
    $kode_jadwal = $_POST['kode_jadwal'];
    $wali_jadwal = $_POST['wali_jadwal'];
    $sql = "UPDATE jadwal SET nama = '$nama', kode_jadwal = '$kode_jadwal', wali_jadwal = $wali_jadwal WHERE id = $id";
    
    if($conn->query($sql) === TRUE){
        $_SESSION['status'] = "success";
        $_SESSION['msg'] = "Data Berhasil Diubah";
        echo "<script>location.href = '../../pages/admin/jadwal/jadwal.php';</script>";
    }else{
        $_SESSION['status'] = "error";
        $_SESSION['msg'] = "Data Gagal Diubah";
        echo "<script>location.href = '../../pages/admin/jadwal/jadwal.php';</script>";
    }
    
}

function delete_jadwal($id){
    include '../../connection/connection.php';
    $sql = "DELETE FROM jadwal WHERE id = $id";
    $conn->query($sql);
    
    header('location: ../../pages/admin/jadwal.php');
}

function add_jadwal(){
    include '../../connection/connection.php';
    session_start();
    $nama_kelas = $_POST['nama_kelas'];
    $mapel = $_POST['mapel'];
    $hari = $_POST['hari'];
    $pengajar = $_POST['pengajar'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $sql = "INSERT INTO jadwal VALUES (null,'$nama_kelas', '$mapel', '$pengajar' ,'$hari', '$jam_mulai', '$jam_selesai')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = "success";
        $_SESSION['msg'] = "Data Berhasil Ditambahkan";
        echo "<script>location.href = '../../pages/admin/jadwal/jadwal.php';</script>";
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['msg'] = "Data Gagal Ditambahkan";
        echo "<script>location.href = '../../pages/admin/jadwal/jadwal.php';</script>";
    }
}

if (isset($_GET['action'])) {
    
    $action = $_GET['action'];
    
    if ($action == 'edit') {
        $id = $_POST['id'];
        $data = edit_jadwal($id);
    } elseif ($action == 'delete') {
        $id = $_GET['id'];
        delete_jadwal($id);
        header('location: ../../pages/admin/jadwal/jadwal.php');
    } elseif ($action == 'add') {
        add_jadwal();
    } elseif($action == 'get_wali_jadwal'){
        get_wali_jadwal();
    }
}
