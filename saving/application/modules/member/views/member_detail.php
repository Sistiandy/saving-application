<div class="col-md-12 main">
    <h3>
        Detail Anggota
        <span class=" pull-right">
            <a href="<?php echo site_url('admin/member') ?>" class="btn btn-info btn-sm"><span class="mdi mdi-arrow-left-bold"></span>&nbsp; Kembali</a> 
            <a href="<?php echo site_url('admin/member/edit/' . $member['member_id']) ?>" class="btn btn-success btn-sm"><span class="mdi mdi-pencil"></span>&nbsp; Edit</a> 
        </span>
    </h3><br>
</div>
<div class="col-md-12">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?php echo $member['member_name'] ?></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><?php echo $member['member_full_name'] ?></td>
            </tr>
            <tr>
                <td>No. Handphone</td>
                <td>:</td>
                <td><?php echo ($member['member_phone'] != NULL) ? $member['member_phone'] : '-' ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo ($member['member_address'] != NULL) ? $member['member_address'] : '-' ?></td>
            </tr>
            <tr>
                <td>Saldo</td>
                <td>:</td>
                <td><strong>Rp.<?php echo number_format($member['member_balance'], 2, ',', '.') ?></strong></td>
            </tr>
            <tr>
                <td>Tanggal Daftar</td>
                <td>:</td>
                <td><?php echo pretty_date($member['member_input_date'], 'l, d m Y', FALSE) ?></td>
            </tr>
            <tr>
                <td>Tanggal Diubah</td>
                <td>:</td>
                <td><?php echo pretty_date($member['member_last_update'], 'l, d m Y', FALSE) ?></td>
            </tr>
        </tbody>
    </table><br>
    <span><a class="btn btn-primary btn-xs" role="button" data-toggle="collapse" href="#collapseSaving" aria-expanded="false" aria-controls="collapseExample">
            <i class="mdi mdi-arrow-down"></i>
            Lihat Daftar Transaksi
        </a></span>
</div>
<div class="collapse" id="collapseSaving">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="gradient">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kredit</th>
                        <th>Debet</th>
                        <th>Saldo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php
                if (!empty($saving)) {
                    foreach ($saving as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td ><?php echo pretty_date($row['saving_date'], 'l, d m Y', FALSE); ?></td>
                                <td ><?php echo number_format($row['saving_kredit'], FALSE, ',', '.') ?></td>
                                <td ><?php echo number_format($row['saving_debet'], FALSE, ',', '.') ?></td>
                                <td ><b>Rp.<?php echo number_format($row['saving_balance'], FALSE, ',', '.') ?></b></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/saving/detail/' . $row['saving_id']); ?>" ><span class="mdi mdi-eye"></span></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                    }
                } else {
                    ?>
                    <tbody>
                        <tr id="row">
                            <td colspan="6" align="center"><?php echo $this->lang->line('data_empty') ?></td>
                        </tr>
                    </tbody>
                    <?php
                }
                ?>   
            </table>
        </div>
    </div>
</div>
