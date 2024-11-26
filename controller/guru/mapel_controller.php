<?php 

function get_all_mapel()
{
    include '../../../connection/connection.php';

    $sql = "SELECT mapel.id, mapel.nama as nama_mapel, user.nama as pengajar, user.id as id_pengajar from mapel JOIN user ON mapel.pengajar = user.id";
    $result = $conn->query($sql);

    return $result;
}

function get_detail_mapel($id) {
    include '../../connection/connection.php';

    $mapel = "SELECT mapel.id, mapel.nama as nama_mapel, user.nama as pengajar, user.id as id_pengajar from mapel JOIN user ON mapel.pengajar = user.id where mapel.id = $id";
    $tugas = "SELECT * FROM tugas WHERE mapel_id = $id";

    $mapelResult = $conn->query($mapel);
    $tugasResult = $conn->query($tugas);

    $data = [
        'mapel' => $mapelResult,
        'tugas' => $tugasResult
    ];
    
    foreach($data['tugas'] as $mapel){
        echo json_encode($mapel);
    }
}

if(isset($_GET['action'])){
    $action = $_GET['action'];
    if($action == 'detail'){
        $id = $_GET['id'];
        get_detail_mapel($id);
    }
}

?>