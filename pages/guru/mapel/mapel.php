<?php include '../../../connection/security.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../../assets/img/logoaverroes.png">
    <title>
        Mapel Page | Siakad Averroes
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
                <!-- make form search -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Mapel" name="search">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php

                    
                    include '../../../controller/admin/mapel_controller.php';
                    $no = 1;
                    $data = get_all_mapel();
                    if($data->num_rows == 0){
                        echo "<h1 class='align-item-center'>Mata Pelajaran tidak ditemukan</h1>";
                    }
                    while ($row = mysqli_fetch_assoc($data)) {
                    ?>
                        <div class="col-sm-6 col-xl-3 mt-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="position-relative">
                                    <a href="./"><img src="../../../assets/img/home-decor-1.jpg" class="card-img-top rounded-0" alt="..."></a>
                                    
                                </div>
                                <div class="card-body pt-3 p-4">
                                    <h6 class="fw-semibold fs-4 mb-0"><?= $row['nama_mapel'] ?></h6>
                                    
                                       <p>Mata Pelajaran <?= $row['nama_mapel'] ?></p>
                                       <!-- make button see details -->
                                        <a href="../../../controller/guru/mapel_controller.php?id=<?= $row['id'] ?>&action=detail" class="btn bg-gradient-primary btn-sm mt-3">See Details</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
            
    </main>

    <?php include '../../../layout/sidebar_conf.php' ?>
    


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
        let table = new DataTable('#tabelmapel');

        const modalEdit = document.getElementById('modal-edit');
        modalEdit.addEventListener('show.bs.modal', () => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const pengajar = button.getAttribute('data-pengajar');
            modalEdit.querySelector('#id').value = id;
            modalEdit.querySelector('#nama').value = nama;
            modalEdit.querySelector('#pengajar').value = pengajar;

            $.ajax({
                url: '../../../controller/admin/mapel_controller.php?action=get_wali_kelas',
                type: 'GET',
                success: function(data) {
                    let result = JSON.parse(data);
                    let option = '<option value="">Pilih wali_kelas</option>';
                    result.forEach(element => {
                        if (element.id == pengajar) {
                            option += `<option value="${element.id}" selected>${element.nama}</option>`;
                        } else {
                            option += `<option value="${element.id}">${element.nama}</option>`;
                        }
                    });
                    modalEdit.querySelector('#pengajar').innerHTML = option;
                },
                error: function(error) {
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
</body>

</html>