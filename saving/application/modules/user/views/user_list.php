<div class="col-md-12 main">
    <h3 class="">
        Daftar Pengguna
        <a href="<?php echo site_url('admin/user/add'); ?>" ><button type="button" class="btn btn-success pull-right btn-sm"><span class="glyphicon glyphicon-plus-sign"></span></button></a>
    </h3><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="gradient">
                <tr>
                    <th>Nama Singkat</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            if (!empty($user)) {
                foreach ($user as $row) {
                    ?>
                    <tbody>
                        <tr>
                            <td ><?php echo $row['user_name']; ?></td>
                            <td ><?php echo $row['user_full_name']; ?></td>
                            <td ><?php echo $row['user_email']; ?></td>
                            <td ><?php echo $row['role_name']; ?></td>
                            <td>
                                <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/user/detail/' . $row['user_id']); ?>" ><span class="mdi mdi-eye"></span></a>
                                <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/user/edit/' . $row['user_id']); ?>" ><span class="mdi mdi-pencil"></span></a>
                                <?php if ($this->session->userdata('user_id') != $row['user_id']) { ?>
                                    <a class="btn btn-primary btn-xs" href="<?php echo site_url('admin/user/rpw/' . $row['user_id']); ?>" ><span class="mdi mdi-key"></span> Reset Password</a>
                                <?php } else {
                                    ?>
                                    <a class = "btn btn-primary btn-xs" href = "<?php echo site_url('admin/profile/cpw/'); ?>" ><span class = "mdi mdi-refresh"></span> Ubah Password</a>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                }
            } else {
                ?>
                <tbody>
                    <tr id="row">
                        <td colspan="5" align="center"><?php echo $this->lang->line('data_empty') ?></td>
                    </tr>
                </tbody>
                <?php
            }
            ?>   
        </table>
    </div>
    <div >
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>