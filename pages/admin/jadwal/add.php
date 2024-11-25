<!-- modal add -->
<div class="modal fade" id="modal-add-jadwal" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     

      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-default">Tambah jadwal</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body
        ">
            <form action="../../../controller/admin/jadwal_controller.php?action=add" method="POST">
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas</label>
                <select class="form-select select2" name="nama_kelas" id="nama_kelas" required>
                    <option value="">Pilih Kelas</option>
                    <?php
                    $kelas = get_all_kelas();
                    while ($row = mysqli_fetch_assoc($kelas)) {
                    ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mapel">Mata Pelajaran</label>
                <select class="form-select" name="mapel" id="mapel" required>
                    <option value="">Pilih Mata Pelajaran</option>
                    <?php
                    $mapel = get_all_mapel();
                    while ($row = mysqli_fetch_assoc($mapel)) {
                    ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="hari">Hari</label>
                <select class="form-select" name="hari" id="hari" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>
            <!-- pengajar -->
            <div class="form-group">
                <label for="pengajar">Pengajar</label>
                <select class="form-select" name="pengajar" id="pengajar" required>
                    <option value="">Pilih Pengajar</option>
                    <?php
                    $guru = get_all_guru();
                    while ($row = mysqli_fetch_assoc($guru)) {
                    ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select> 
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" required>
            </div>
            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-primary text-white">Simpan</button>
                <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Batal</button>
            </div>
            </form>
      </div>
    </div>
</div>