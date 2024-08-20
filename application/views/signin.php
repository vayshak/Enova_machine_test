<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <?php
    $this->load->view('css_js'); ?>
</head>

<body>
    <div class="signup-form">
        <h2>Signin</h2>
        <p class="hint-text">Sign in to start your session</p>
        <?php echo form_open('login-check', ['name' => 'userregistration', 'autocomplete' => 'off']); ?>
        <div class="form-group">
            <!--error message -->
            <?php if ($this->session->flashdata('error')) { ?>
                <p style="color:red"><?php echo $this->session->flashdata('error'); ?></p>
            <?php } ?>
            <?php echo form_input(['name' => 'emailid', 'class' => 'form-control', 'value' => set_value('emailid'), 'placeholder' => 'Enter your Email id']); ?>
            <?php echo form_error('emailid', "<div style='color:red'>", "</div>"); ?>
        </div>
        <div class="form-group">
            <?php echo form_password(['name' => 'password', 'class' => 'form-control', 'value' => set_value('password'), 'placeholder' => 'Password']); ?>
            <?php echo form_error('password', "<div style='color:red'>", "</div>"); ?>
        </div>
        <div class="form-group">
            <?php echo form_submit(['name' => 'insert', 'value' => 'Submit', 'class' => 'btn btn-success btn-lg btn-block']); ?>
        </div>
        </form>
        <?php echo form_close(); ?>
        <div class="text-center">Not Registered Yet? <a href="<?php echo site_url('register'); ?>">Sign up here</a></div>
    </div>
</body>

</html>