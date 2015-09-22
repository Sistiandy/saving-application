<div class="col-md-12 main">
    <h3 class="">
        Daftar Transaksi Tabungan (Masuk)
        <button type="button" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#myForm"><span class="glyphicon glyphicon-plus-sign"></span></button>
    </h3><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="gradient">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Kredit</th>
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
                            <td ><?php echo $row['member_full_name']; ?></td>
                            <td ><?php echo number_format($row['saving_kredit'], FALSE, ',', '.') ?></td>
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

<!-- Modal -->
<div class="modal fade" id="myForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form Tabungan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12" id="form">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo form_open('admin/saving/formKredit') ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="pull-left"><input class="form-control datepicker" required type="text" placeholder="Tanggal" name="saving_date" value="<?php echo date('Y-m-d') ?>"></span>
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="head">Nama</th>
                                                    <th class="head">Masuk</th>
                                                    <th></th>
                                                    </b></tr>
                                            </thead>
                                            <tbody id="p_scents">
                                                <tr>
                                                    <td><select name="member_id[]" class="form-control" required>
                                                            <option value="">-- Pilih Nama --</option>
                                                            <?php foreach ($member as $row): ?>
                                                                <option value="<?php echo $row['member_id'] ?>" >
                                                                    <?php echo $row['member_full_name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td><input class="form-control" type="text" name="saving_kredit[]"></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="#" id="addScnt"><span class="mdi mdi-plus-circle"></span> Tambah </a>
                                        <br>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-4 pull-right" >
                                                            <input type="submit" class="col-md-12 btn btn-primary" value="Simpan">
                                                        </div>
                                                        <div class="col-md-2" >
                                                            <button class="col-md-12 btn btn-info" data-dismiss="modal"><i class="ion-arrow-left-a"></i> Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                var scntDiv = $('#p_scents');
                var scntAdd = $('#form');
                var i = $('#p_scents tr').size() + 1;

                $("#addScnt").click(function() {
                    $('<tr><td><select name="member_id[]" class="form-control" required><option value="">-- Pilih Nama --</option><?php foreach ($member as $row): ?><option value="<?php echo $row['member_id'] ?>" ><?php echo $row['member_full_name'] ?></option><?php endforeach; ?></select></td><td><input class="form-control" type="text" name="saving_kredit[]"></td><td><a href="#" class="remScnt"><span class="mdi mdi-minus-circle"></span></a></td></tr>').appendTo(scntDiv);
                    i++;
                    return false;
                });

                $(document).on("click", ".remScnt", function() {
                    if (i > 2) {
                        $(this).parents('tr').remove();
                        i--;
                    }
                    return false;
                });
            });
        </script>