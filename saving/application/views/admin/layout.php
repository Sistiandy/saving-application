<!DOCTYPE html>
<html lang="en" ng-app>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SAVING-APP</title>
        
        <link rel="icon" href="<?php echo base_url('media/ico/favicon.png'); ?>" type="image/x-icon">

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url() ?>media/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url() ?>media/css/jquery-ui.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>media/css/jquery-ui.theme.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>media/css/backend-styles.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url() ?>media/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>media/css/materialdesignicons.min.css.map" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery -->
        <script src="<?php echo base_url() . 'media/js/angular.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'media/js/jquery-1.11.2.min.js' ?>"></script>

        <!-- jQuery-ui -->
        <script src="<?php echo base_url() . 'media/js/jquery-ui.min.js' ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() . 'media/js/bootstrap.min.js' ?>"></script>
        <script>
            $(function() {
                $(".datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '2015:2020',
                    dateFormat: "yy-mm-dd",
                    onSelect: function(datetext) {
                        var d = new Date(); // for now
                        datetext = datetext + " " + d.getHours() + ": " + d.getMinutes() + ": " + d.getSeconds();
                        $('#datepicker').val(datetext);
                    },
                });
            });
        </script>
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url('admin') ?>"><span class="mdi mdi-code-string"></span> SAVING-APP</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="mdi mdi-account-circle" style="font-size: 15pt;"></i> <?php echo $this->session->userdata('user_full_name') ?> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo site_url('admin/profile') ?>"><i class="mdi mdi-account"></i> User Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <?php echo form_open(site_url('user/auth/logout')) ?>
                                <input type="hidden" name="location" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                            <center><button type="submit" class="btn btn-danger btn-xs"><i class="mdi mdi-logout"></i> Logout</button></center>
                            <?php echo form_close() ?>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <?php $this->load->view('admin/list') ?>
            </nav>

            <div id="page-wrapper">
                <?php isset($main) ? $this->load->view($main) : null; ?>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <footer class="bottom footer">
        <div class="orc text-center">
            <p class="text-muted" >© 2015 SAVING-APP - <a href="http://twitter.com/sistiandy">@Sistiandy</a></p>
        </div>
    </footer>
</body>

</html>
