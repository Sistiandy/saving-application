<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>AIP-RURAL | Login</title>
        <link rel="shortcut icon" href="<?php echo base_url() . '/media/image/aid.png' ?>">
        <link href="<?php echo base_url('/media/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('/media/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('/media/css/style-login.css') ?>" rel="stylesheet" type="text/css">

        <script src="<?php echo base_url('/media/js/jquery-1.11.1.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/media/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('/media/js/template.js') ?>" type="text/javascript"></script>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                    <div class="login">
                        <h1 class="admin">Sign Up</h1>
                        <?php
                        echo form_open(current_url());
                        if (isset($_GET['location'])) {
                            echo '<input type="hidden" name="location" value="';
                            if (isset($_GET['location'])) {
                                echo htmlspecialchars($_GET['location']);
                            }
                            echo '" />';
                        }
                        ?>
                        <div class="form-group forms">
                            <input type="text" name="username" required autofocus class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group formz">
                            <input type="password" name="password" class="form-control" required placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-sunny btn-lg col-md-12 col-sm-12 col-xs-12 col-lg-12">SIGN IN</button>
                        <?php echo form_close(); ?>
                    </div><?php if ($this->session->flashdata('failed')) { ?>
                        <div class="alert alert-danger form-failed" role="alert">
                            <center><?php echo $this->session->flashdata('failed') ?>
                            </center>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('.form-failed').delay(1300).fadeOut();
                            });
                        </script>
                    <?php } ?>
                </div>
            </div>
            <nav class="navbar navbar-default navbar-fixed-bottom navzu">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <center>© 2015 AIP-RURAL</center>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </body>
</html>