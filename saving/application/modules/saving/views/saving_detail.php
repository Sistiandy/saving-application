<div class="col-md-12 main">
    <h3>
        Detail Tabungan
        <span class=" pull-right">
            <a href="<?php echo site_url('admin/saving') ?>" class="btn btn-info btn-sm"><span class="mdi mdi-arrow-left-bold"></span>&nbsp; Kembali</a> 
        </span>
    </h3><br>
</div>
<div class="col-md-12">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $saving['user_name'] ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?php echo pretty_date($saving['saving_date'], 'l, d m Y', FALSE) ?></td>
            </tr>
            <tr>
                <td>Tipe</td>
                <td>:</td>
                <td><?php echo ($saving['saving_type'] == 0)? 'Masuk' : 'Keluar'; ?></td>
            </tr>
            <tr>
                <td>Masuk</td>
                <td>:</td>
                <td><?php echo $saving['saving_kredit'] ?></td>
            </tr>
            <tr>
                <td>Keluar</td>
                <td>:</td>
                <td><?php echo $saving['saving_debet'] ?></td>
            </tr>
        </tbody>
    </table>
</div>
