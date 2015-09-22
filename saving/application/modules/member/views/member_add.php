<?php
if (isset($member)) {
    $inputName = $member['member_name'];
    $inputFullName = $member['member_full_name'];
    $inputPhone = $member['member_phone'];
    $inputAddress = $member['member_address'];
} else {
    $inputName = set_value('member_name');
    $inputFullName = set_value('member_full_name');
    $inputPhone = set_value('member_phone');
    $inputAddress = set_value('member_address');
}
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>

<div class="col-lg-12">
    <h3><?php echo $operation ?> Anggota</h3>
    <br>
</div>
<!-- /.col-lg-12 -->

<?php echo form_open_multipart(current_url()); ?>
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-9 col-md-9">
            <?php if (isset($member)): ?>
                <input type="hidden" name="member_id" value="<?php echo $member['member_id'] ?>" />
            <?php endif; ?>
            <label >Username *</label>
            <input type="text" name="member_name" <?php echo (isset($member) ? 'readonly' : NULL) ?> placeholder="Username" class="form-control" value="<?php echo $inputName; ?>"><br>

            <?php if (!isset($member)): ?>
                <label >Password *</label>
                <input type="password" name="member_password" placeholder="Password" class="form-control" ><br>
            <?php endif; ?>

            <label >Nama Lengkap *</label>
            <input type="text" name="member_full_name" placeholder="Nama Lengkap" class="form-control" value="<?php echo $inputFullName; ?>"><br>

            <label >No. Handphone</label>
            <input type="text" name="member_phone" placeholder="No. Handphone" class="form-control" value="<?php echo $inputPhone; ?>"><br>

            <?php if (isset($member)) { ?>
                <label >Saldo *</label>
                <input type="text" readonly class="form-control" value="<?php echo $member['member_balance']; ?>"><br>
            <?php } ?>

            <label>Alamat</label>
            <textarea class="form-control" name="member_address"><?php echo $inputAddress; ?></textarea>
            <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
        </div>
        <div class="col-sm-9 col-md-3">
            <div class="form-group">
                <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="mdi mdi-checkbox-marked-circle-outline"></i> Simpan</button><br>
                <a href="<?php echo site_url('admin/member'); ?>" class="btn btn-info btn-form"><i class="mdi mdi-arrow-left-bold"></i> Batal</a><br>
                <?php if (isset($member)) { ?>
                <button type="button" class="btn btn-danger btn-form" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-delete"></i> Hapus</button><br>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<?php if (isset($member)): ?>
    <!-- Delete Confirmation -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b> <i class="mdi mdi-alert"></i> Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?</p>
                </div>
                <?php echo form_open('admin/member/delete/' . $member['member_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $member['member_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $member['member_name'] ?>" />
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