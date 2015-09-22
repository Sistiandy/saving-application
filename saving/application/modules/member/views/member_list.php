<div class="col-md-12 main">
    <h3 class="">
        Daftar Anggota
        <a href="<?php echo site_url('admin/member/add'); ?>" ><button type="button" class="btn btn-success pull-right btn-sm"><span class="glyphicon glyphicon-plus-sign"></span></button></a>
    </h3><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="gradient">
                <tr>
                    <th>Nama</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            if (!empty($member)) {
                foreach ($member as $row) {
                    ?>
                    <tbody>
                        <tr>
                            <td ><?php echo $row['member_full_name']; ?></td>
                            <td ><b>Rp.<?php echo number_format($row['member_balance'], 2, ',', '.') ?></b></td>
                            <td>
                                <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/member/detail/' . $row['member_id']); ?>" ><span class="mdi mdi-eye"></span></a>
                                <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/member/edit/' . $row['member_id']); ?>" ><span class="mdi mdi-pencil"></span></a>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                }
            } else {
                ?>
                <tbody>
                    <tr id="row">
                        <td colspan="3" align="center"><?php echo $this->lang->line('data_empty') ?></td>
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