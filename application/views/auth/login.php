<?php $this->load->view("layouts/header"); ?>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php echo form_open('auth/login'); ?>
            <h1>Sign In</h1>
              <div class="row">
                <?php if($successful_registration = $this->session->flashdata('successful_registration')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_registration;
                        echo "</div>";
                      }else if($failed_registration = $this->session->flashdata('failed_registration')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_registration;
                        echo "</div>";
                      }else if($failed_login = $this->session->flashdata('failed_login')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_login;
                        echo "</div>";
                      }else if($user_removed = $this->session->flashdata('user_removed')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $user_removed;
                        echo "</div>";
                      }
                      else if($inactive_account = $this->session->flashdata('inactive_account')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $inactive_account;
                        echo "</div>";
                      }
                ?>
              </div>
              <div class="row">
                <div class="form-group">
                  <?php echo form_input(["name" => "username", "class" => "form-control", "placeholder" => "Username", "value" => set_value("username")]); ?>
                  <?php echo form_error("username", '<p class="text-danger pull-left">', '</p>'); ?>
                </div>
                <div class="form-group">
                  <?php echo form_password(["name" => "password", "class" => "form-control", "placeholder" => "Password"]); ?>
                  <?php echo form_error("password", '<p class="text-danger pull-left">', '</p>'); ?>
                </div>
              </div>

              <div class="row">
                <?php echo form_submit(["value" => "Login", "class" => "btn btn-primary pull-left"]); ?>
                </div>
    
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="<?php echo base_url('auth/register') ?>" class="to_register"> Create Account </a>
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
    </div>
  </body>
</html>
