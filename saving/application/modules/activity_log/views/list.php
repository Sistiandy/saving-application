<div class="col-sm-9 col-md-10 main">

    <h3 class="page-header">
        <?php echo $this->lang->line('activity_log_list')?>
    </h3>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="controls" id="nama" align="center" style="width: 230px;"><?php echo $this->lang->line('date')?></th>
                <th class="controls" id="alamat" align="center"><?php echo $this->lang->line('author')?></th>
                <th class="controls" id="foto" align="center"><?php echo $this->lang->line('module')?></th>
                <th class="controls" id="foto" align="center"><?php echo $this->lang->line('action')?></th>
                <th class="controls" id="foto" align="center">Info</th>
            </tr>
            </thead>
            <?php
            if (!empty($data)) {
                foreach ($data as $row) {
                    ?>
            <tbody>
                    <tr class="isi">
                        <td ><?php echo pretty_date($row['log_date']); ?></td>
                        <td ><?php echo $row['user_name']; ?></td>
                        <td ><?php echo $row['log_module']; ?></td>
                        <td ><?php echo $row['log_action']; ?></td>
                        <td ><?php echo $row['log_info']; ?></td>
                    </tr>
            </tbody>
                    <?php
                }
            } else {
                ?>
            <tbody>
                <tr id="row">
                    <td colspan="5" align="center"><?php echo $this->lang->line('data_empty')?></td>
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