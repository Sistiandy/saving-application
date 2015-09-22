<?php
if (isset($saving)) {
    $inputDate = $saving['saving_date'];
    $inputUser = $saving['user_user_id'];
    $inputType = $saving['saving_type'];
    if($inputType == 0){
    $inputJumlah = $saving['saving_in'];
    }else{
    $inputJumlah = $saving['saving_out'];
    }
} else {
    $inputDate = set_value('saving_date');
    $inputUser = set_value('user_id');
    $inputType = set_value('saving_type');
    $inputJumlah = set_value('saving_jumlah');
}
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>

<div class="col-lg-12">
    <h3><?php echo $operation ?> Pengguna</h3>
    <br>
</div>
<!-- /.col-lg-12 -->

<?php echo form_open_multipart(current_url()); ?>
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-9 col-md-9">
            <?php if (isset($saving)): ?>
                <input type="hidden" name="saving_id" value="<?php echo $saving['saving_id'] ?>" />
            <?php endif; ?>
            <label >Nama *</label>
            <select name="user_id" class="form-control">
                <?php
                    foreach ($user as $row):
                        ?>
                        <option value="<?php echo $row['user_id']; ?>" <?php echo ($row['user_id'] == $inputUser)? 'selected' : NULL; ?>> <?php echo $row['user_name']; ?></option>

                        <?php
                    endforeach;
                ?>
            </select><br>
            <label>Tipe</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="saving_type" value="0" <?php echo ($inputType == 0) ? 'checked' : ''; ?>> Masuk
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="saving_type" value="1" <?php echo ($inputType == 1) ? 'checked' : ''; ?>> Keluar
                    </label>
                </div>
            <label >Jumlah (Rp) *</label>
            <input type="text" name="jumlah" placeholder="Jumlah" class="form-control" value="<?php echo $inputJumlah; ?>">
<!--            <label>Deskripsi </label>
            <textarea name="saving_description" class="form-control" rows="10" placeholder="Deskripsi pengguna"><?php // echo $inputDescValue; ?></textarea><br>-->
            <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
        </div>
        <div class="col-sm-9 col-md-3">
            <div class="form-group">
                <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="mdi mdi-checkbox-marked-circle-outline"></i> Simpan</button><br>
                <a href="<?php echo site_url('admin/saving'); ?>" class="btn btn-info btn-form"><i class="mdi mdi-arrow-left-bold"></i> Batal</a><br>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<?php if (isset($saving)): ?>
    <!-- Delete Confirmation -->
    <div class="modal fade" id="confirm-del">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b>Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                </div>
                <?php echo form_open('admin/saving/delete/' . $saving['saving_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $saving['saving_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $saving['saving_date'] ?>" />
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php if ($this->session->flashdata('delete')) { ?>
        <script type = "text/javascript">
            $(window).load(function() {
                $('#confirm-del').modal('show');
            });
        </script>
    <?php }
    ?>
<?php endif; ?>