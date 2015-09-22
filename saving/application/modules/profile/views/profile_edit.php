<?php
$this->load->view('admin/tinymce_init');
$id = $user['user_id'];
$inputNameValue = $user['user_name'];
$inputJudulValue = $user['user_full_name'];
$inputRoleValue = $user['role_id'];
$inputEmailValue = $user['user_email'];
$inputDescValue = $user['user_description'];
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>

<div class="col-lg-12">
    <h3><?php echo $operation ?> Profil</h3>
    <br>
</div>
<!-- /.col-lg-12 -->

<?php echo form_open_multipart(current_url()); ?>
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-9 col-md-9">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>" />
            <label >Username *</label>
            <input name="user_name" type="text" <?php echo (isset($user)) ? 'readonly' : '' ?> placeholder="Username" class="form-control" value="<?php echo $inputNameValue; ?>"><br>
            <label >Nama Lengkap *</label>
            <input type="text" name="user_full_name" placeholder="Nama Lengkap" class="form-control" value="<?php echo $inputJudulValue; ?>"><br>

            <?php if (!isset($user)): ?>
                <label >Password *</label>
                <input type="password" placeholder="Password" name="user_password" class="form-control"><br>
                <label >Konfirmasi Password *</label>
                <input type="password" placeholder="Konfirmasi Password" name="passconf" class="form-control">
                <p style="color:#9C9C9C;margin-top: 5px"><i>Password minimal 6 karakter</i></p>
            <?php endif; ?>
            <select name="role_id" class="form-control">
                <?php
                if (!empty($role)) {
                    foreach ($role as $row):
                        $select = ($row['role_id'] == $inputRoleValue) ? 'selected' : NULL;
                        ?>

                        <option value="<?php echo $row['role_id']; ?>" <?php echo $select; ?>> <?php echo $row['role_name']; ?></option>

                        <?php
                    endforeach;
                }
                ?>
            </select><br>

            <label >Email *</label>
            <input type="text" name="user_email" placeholder="Email" class="form-control" value="<?php echo $inputEmailValue; ?>">
            <p style="color:#9C9C9C;margin-top: 5px"><i>Contoh : example@yahoo.com / example@example.com</i></p>
            <label>Deskripsi </label>
            <textarea name="user_description" class="form-control" rows="10" placeholder="Deskripsi pengguna"><?php echo $inputDescValue; ?></textarea><br>
            <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
        </div>
        <div class="col-sm-9 col-md-3">
            <div class="form-group">
                <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="mdi mdi-checkbox-marked-circle-outline"></i> Simpan</button><br>
                <a href="<?php echo site_url('admin/profile'); ?>" class="btn btn-info btn-form"><i class="mdi mdi-arrow-left-bold"></i> Batal</a><br>
                <?php if (isset($user)): ?>
                    <?php if ($this->session->userdata('user_id_admin') == $id) {
                        ?>
                        <a href="<?php echo site_url('admin/profile/cpw') ?>" class="btn btn-primary btn-form"><i class="mdi mdi-refresh"></i> Ubah Password</a><br>
                    <?php } elseif ($this->session->userdata('user_id_admin') != $id) { ?>
                        <a class="btn btn-primary btn-form" href="<?php echo site_url('admin/user/rpw/' . $user['user_id']); ?>" ><i class="mdi mdi-key"></i> Reset Password</a><br>
                    <?php } ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>