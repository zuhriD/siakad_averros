<?php include '../../../connection/security.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../../assets/img/logoaverroes.png">
  <title>
    jadwal Page | Siakad Averroes
  </title>

  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../../../assets/css/soft-ui-dashboard.css" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">

  <!-- Datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

  <!-- Datatables -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

  <!-- Select 2 JS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">

  <!-- Sidebar Content -->
  <?php include '../../../layout/sidebar.php'; ?>
  <!-- Sidebar End -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include '../../../layout/navbar.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <!-- make table -->
        <div class="col-lg-12 col-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
              <h6>Daftar jadwal</h6>
              <!-- Add button -->
              <a href="" class="btn bg-success text-white mt-2" data-bs-toggle="modal" data-bs-target="#modal-add-jadwal"><i class="fas fa-plus"></i> Tambah jadwal</a>
            </div>

            <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'success'): ?>
              <!-- show sweet alert success -->
              <!-- Show SweetAlert success -->
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                    title: 'Berhasil!',
                    text: '<?=  $_SESSION['msg'] ?>',
                    icon: 'success',
                    confirmButtonText: 'OKE'
                  });
                });
              </script>

            <?php
            elseif (isset($_SESSION['status']) && $_SESSION['status'] == 'error'): ?>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                    title: 'Gagal!',
                    text: '<?=  $_SESSION['msg'] ?>',
                    icon: 'error',
                    confirmButtonText: 'OKE'
                  });
                });
              </script>
            <?php
            endif;
            unset($_SESSION['status']);
            unset($_SESSION['msg']);
            ?>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0 m-4">
                <table class="table align-items-center mb-0" id="tabeljadwal">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Kelas </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mata Pelajaran</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengajar</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jam Mulai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jam Selesai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include '../../../controller/admin/jadwal_controller.php';
                    $no = 1;
                    $data = get_all_jadwal();
                    while ($row = mysqli_fetch_assoc($data)) {
                    ?>
                      <tr>
                        <td>
                          <p class="text-sm font-weight-bold mb-0 "><?= $no++ ?></p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0"><?= $row['nama_kelas'] ?></p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0"><?= $row['nama_mapel'] ?></p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0"><?= $row['hari'] ?></p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0"><?= $row['pengajar'] ?></p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0"><?= $row['jam_mulai'] ?></p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0"><?= $row['jam_selesai'] ?></p>
                        </td>
                        <td class="align-middle text-center">
                          <a href="" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#modal-edit" >
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="../../../controller/admin/jadwal_controller.php?id=<?= $row['id'] ?>&action=delete" class="text-secondary font-weight-bold text-xs" onclick="confirmDelete(event, <?= $row['id'] ?>)">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer pt-3">
          <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
              <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                  © <script>
                    document.write(new Date().getFullYear())
                  </script>,
                  made with <i class="fa fa-heart"></i> by <a href="https://averroes.id">Averroes </a>.
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
      <?php include './add.php' ?>
  </main>

  <?php include '../../../layout/sidebar_conf.php' ?>
  <?php include './edit.php' ?>

  
  <!-- Sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--   Core JS Files   -->
  <script src="../../../assets/js/core/popper.min.js"></script>
  <script src="../../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../../../assets/js/plugins/chartjs.min.js"></script>
  <script src="../../../assets/js/soft-ui-dashboard.min.js"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script>
    let table = new DataTable('#tabeljadwal');

    const modalEdit = document.getElementById('modal-edit'); 
    modalEdit.addEventListener('show.bs.modal', () => {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const nama = button.getAttribute('data-nama');
      const kode_jadwal = button.getAttribute('data-kode');
      const wali = button.getAttribute('data-wali');

      modalEdit.querySelector('#id').value = id;
      modalEdit.querySelector('#nama').value = nama;
      modalEdit.querySelector('#kode_jadwal').value = kode_jadwal;
      
      $.ajax({
        url: '../../../controller/admin/jadwal_controller.php?action=get_wali_jadwal',
        type: 'GET',
        success: function(data) {
          let result = JSON.parse(data);
          let option = '<option value="">Pilih wali_jadwal</option>';
          result.forEach(element => {
            if (element.id == wali) {
              option += `<option value="${element.id}" selected>${element.nama}</option>`;
            } else {
              option += `<option value="${element.id}">${element.nama}</option>`;
            }
          });
          modalEdit.querySelector('#wali_jadwal').innerHTML = option;
        },
        error: function(error){
          console.log(error);
        }
      });
    });

    function confirmDelete(event, id) {
      event.preventDefault(); // Prevent the default action of the <a> tag
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
          setTimeout(() => {
            window.location.href = '../../../controller/admin/user_controller.php?id=' + id + '&action=delete';
          }, 2000);
        }
      });
    }
    
  </script>
  <script>
     $( '.selectKelas' ).select2( {
    dropdownParent: $( '.modal' )
} );

  </script>
</body>

</html>