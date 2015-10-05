<?php
$inputMember = set_value('member_id');
$inputSaving = set_value('saving_kredit');
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>

<div class="col-lg-12">
    <h3><?php echo $operation ?> Tabungan Kredit</h3>
    <br>
</div>
<!-- /.col-lg-12 -->

<?php echo form_open_multipart(current_url()); ?>
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-9 col-md-9">
            <label >Tanggal *</label>
            <input type="text" name="saving_date" placeholder="Tanggal" class="datepicker form-control" value="<?php echo date('Y-m-d'); ?>"><br>
            <label >Nama *</label>
            <select name="member_id" class="form-control">
                <?php
                foreach ($member as $row):
                    ?>
                    <option value="<?php echo $row['member_id']; ?>"> <?php echo $row['member_full_name']; ?></option>

                    <?php
                endforeach;
                ?>
            </select><br>
            <label >Jumlah (Rp) *</label>
            <input type="text" name="saving_kredit" placeholder="Jumlah Uang" class="form-control" value="<?php echo $inputSaving; ?>">
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
