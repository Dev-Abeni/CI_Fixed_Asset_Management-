
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MCM | Fixed Asset</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" />
    <!-- NProgress -->
    <link rel="stylesheet" href="<?php echo base_url('assets/nprogress/nprogress.css'); ?>" />
    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/animate.css/animate.min.css'); ?>" />

    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/custom/custom.min.css'); ?>" />
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <section class="login_content">
            <?php echo form_open("auth/create_account"); ?>
                <h1>Create Account</h1>
                <div>
                <?php echo form_input(["name" => "first_name", "class" => "form-control", "placeholder" => "First Name"]); ?>
                <?php echo form_error("first_name", "<p class='text-danger pull-left'>", "</p>"); ?> 
                </div>
                <div>
                <?php echo form_input(["name" => "last_name", "class" => "form-control", "placeholder" => "Last Name"]); ?>
                <?php echo form_error("last_name", "<p class='text-danger pull-left'>", "</p>"); ?>
                </div>
                <div>
                <?php echo form_input(["name" => "username", "class" => "form-control", "placeholder" => "Username"]); ?>
                <?php echo form_error("username", "<p class='text-danger pull-left'>", "</p>"); ?>
                <?php if($username_exisits = $this->session->flashdata('username_exisits')){
                        echo "</br></br>";
                        echo "<p class='text-danger'>";
                        echo $username_exisits;
                        echo "</p>";
                        }       
                ?>
                </div>
                <div>
                <?php echo form_password(["name" => "password", "class" => "form-control", "placeholder" => "Password"]); ?>
                <?php echo form_error("password", "<p class='text-danger pull-left'>", "</p>"); ?>
                </div>
                <div>
                <?php echo form_submit(["value" => "Register", "class" => "btn btn-primary btn-block"]); ?>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                <p class="change_link">Already a member ?
                    <a href="<?php echo base_url('auth') ?>" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <center>
                        <img src="<?php echo base_url('assets/images/MCMFullLogo.png')?>" width="250px" height="65px">
                        <h2>Fixed Asset Management System</h2>
                    </center>
                  <p>©<?php echo date("Y"); ?> All Rights Reserved.</p>
                </div>
                </div>
            <?php echo form_close(); ?>
        </section>
      </div>
    </div>
  </body>
</html>
