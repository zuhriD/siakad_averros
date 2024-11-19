<?php

include '/siakad_averros/connection/connection.php';

function get_jadwal_hari_ini()
{
    global $conn;
    $id = $_SESSION['id'];
    $sql = "SELECT jadwal.id, kelas.nama AS nama_kelas, mapel.nama AS nama_mapel, user.nama AS pengajar, 
    jadwal.jam_mulai, jadwal.jam_selesai
FROM jadwal
JOIN user ON jadwal.pengajar_id = user.id
JOIN kelas ON jadwal.kelas_id = kelas.id
JOIN mapel ON jadwal.mapel_id = mapel.id
WHERE pengajar_id = $id 
AND jadwal.hari = 
   CASE DAYNAME(NOW())
       WHEN 'Monday' THEN 'Senin'
       WHEN 'Tuesday' THEN 'Selasa'
       WHEN 'Wednesday' THEN 'Rabu'
       WHEN 'Thursday' THEN 'Kamis'
       WHEN 'Friday' THEN 'Jumat'
       WHEN 'Saturday' THEN 'Sabtu'
       WHEN 'Sunday' THEN 'Minggu'
   END
";
    $result = $conn->query($sql);
    if ($result == true) {
        return $result;
    } else {
        return '';
    }
}
