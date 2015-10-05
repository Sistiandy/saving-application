<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a data-toggle="collapse" href="#dashboard"><i class="mdi mdi-home"></i> DASHBOARD</a>
                <ul id="dashboard" class="nav-collapse collapse <?php echo ($this->uri->segment(2) == 'dashboard' OR $this->uri->segment(2) == NULL) ? 'in' : '' ?> nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('admin/dashboard') ?>"><i class="mdi mdi-view-list"></i> Dashboard</a>
                    </li>
                </ul>
            </li>
            
            <!--Open User Module-->
            <li>
                <a data-toggle="collapse" href="#saving"><i class="mdi md-money"></i> TABUNGAN</a>
                <ul id="saving" class="nav-collapse collapse <?php echo ($this->uri->segment(2) == 'saving') ? 'in' : '' ?> nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('admin/saving/add') ?>"><i class="mdi mdi-plus-circle"></i> Tambah Transaksi Kredit</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/saving') ?>"><i class="mdi mdi-view-list"></i> Daftar Transaksi Kredit</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/saving/debet') ?>"><i class="mdi mdi-view-list"></i> Daftar Transaksi Debet</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <!--Close User Module-->
            
            <!--Open Member Module-->
            <li>
                <a data-toggle="collapse" href="#member"><i class="mdi md-account-multiple"></i> ANGGOTA</a>
                <ul id="member" class="nav-collapse collapse <?php echo ($this->uri->segment(2) == 'member') ? 'in' : '' ?> nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('admin/member') ?>"><i class="mdi mdi-view-list"></i> Daftar Anggota</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/member/add') ?>"><i class="mdi mdi-account-plus"></i> Tambah Anggota</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <!--Close Member Module-->
            
            <!--Open User Module-->
            <li>
                <a data-toggle="collapse" href="#user"><i class="mdi md-account-multiple"></i> PENGGUNA</a>
                <ul id="user" class="nav-collapse collapse <?php echo ($this->uri->segment(2) == 'user') ? 'in' : '' ?> nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('admin/user') ?>"><i class="mdi mdi-view-list"></i> Daftar Pengguna</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/user/add') ?>"><i class="mdi mdi-account-plus"></i> Tambah Pengguna</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <!--Close User Module-->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->