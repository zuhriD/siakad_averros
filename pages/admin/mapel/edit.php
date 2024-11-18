<div class="modal fade" id="modal-edit" tabindex="-1" wali_kelas="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog" wali_kelas="document">
    <div class="modal-content">     

      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-default">Edit User</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body
        ">
            <form action="../../../controller/admin/user_controller.php?action=edit" method="POST">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="kode_kelas">Kode Kelas</label>
                <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" required>
            </div>
            <div class="form-group">
                <label for="wali_kelas">Wali Kelas</label>
                <select class="form-control" id="wali_kelas" name="wali_kelas" required>
                    <option value="">Pilih wali_kelas</option>
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
            <div class="modal-footer">
                <input type="hidden" id="id" name="id">
                <button type="submit" class="btn bg-primary text-white">Simpan</button>
                <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Batal</button>
            </div>
            </form>
      </div>
    </div>
</div>