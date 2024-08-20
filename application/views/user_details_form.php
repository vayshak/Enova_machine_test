<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $this->load->view('css_js'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <div class="signup-form">
        <h2>User Details Form</h2>
        <?php
        if (isset($user_det->biology) && $user_det->biology != '' && isset($user_det->computer) && $user_det->computer != '' && isset($user_det->certificate_2) && $user_det->certificate_2 != '') {
        ?>
            <div class="row">
                <div class="col">
                    <button onclick="location.href = '<?= base_url() ?>select-course';" style="background-color: #008CBA; color: white;" id="myButton" class="float-right submit-button">Apply course</button>
                </div>
            </div>
        <?php } ?>
        <?php
        if (isset($user_det->phone) && $user_det->phone != '') {
            echo form_open_multipart('home/edit_form_details', ['name' => 'userregistrations', 'autocomplete' => 'off']);
            echo form_input(['type' => 'hidden', 'name' => 'id', 'class' => 'form-control', 'value' => $user_det->id, 'placeholder' => 'phone number']);
        } else {
            echo form_open_multipart('home/user_form_details', ['name' => 'userregistrations', 'autocomplete' => 'off']);
        }
        ?>
        <div class="form-group">
            <!--success message -->
            <?php if ($this->session->flashdata('success')) { ?>
                <p style="color:green"><?php echo $this->session->flashdata('success'); ?></p>
            <?php } ?>
            <!--error message -->
            <?php if ($this->session->flashdata('error')) { ?>
                <p style="color:red"><?php echo $this->session->flashdata('error'); ?></p>
            <?php } ?>
            <div class="row">
                <div class="col">
                    <label for="">Phone</label>
                    <?php echo form_input(['name' => 'phone', 'class' => 'form-control', 'value' => isset($user_det->phone) ? $user_det->phone : '', 'placeholder' => 'phone number']); ?>
                    <?php echo form_error('phone', "<div style='color:red'>", "</div>"); ?>
                </div>
                <div class="col">
                    <label for="">Country</label>
                    <?php echo form_input(['name' => 'country', 'class' => 'form-control', 'value' => isset($user_det->country) ? $user_det->country : '', 'placeholder' => 'country']); ?>
                    <?php echo form_error('country', "<div style='color:red'>", "</div>"); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="">State</label>
                    <?php echo form_input(['name' => 'state', 'class' => 'form-control', 'value' => isset($user_det->state) ? $user_det->state : '', 'placeholder' => 'State']); ?>
                    <?php echo form_error('state', "<div style='color:red'>", "</div>"); ?>
                </div>
                <div class="col">
                    <label for="">Date of Birth</label>
                    <?php echo form_input(['name' => 'dob', 'type' => 'date', 'class' => 'form-control', 'value' => isset($user_det->dob) ? $user_det->dob : '', 'placeholder' => 'Date of birth']); ?>
                    <?php echo form_error('state', "<div style='color:red'>", "</div>"); ?>
                </div>
            </div>
        </div>
        <h6>Higher secondary mark in percentage </h6>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="">Computer</label>
                    <?php echo form_input(['type' => 'number', 'max' => '100', 'name' => 'computer', 'class' => 'form-control', 'value' => isset($user_det->computer) ? $user_det->computer : '', 'placeholder' => 'Computer ']); ?>
                    <?php echo form_error('computer', "<div style='color:red'>", "</div>"); ?>
                </div>
                <div class="col">
                    <label for="">Biology</label>
                    <?php echo form_input(['type' => 'number', 'max' => '100', 'name' => 'biology', 'class' => 'form-control', 'value' => isset($user_det->biology) ? $user_det->biology : '', 'placeholder' => 'Biology']); ?>
                    <?php echo form_error('biology', "<div style='color:red'>", "</div>"); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="">Accounts</label>
                    <?php
                    echo form_input(['type' => 'number', 'max' => '100', 'name' => 'accounts', 'class' => 'form-control', 'value' => isset($user_det->accounts) ? $user_det->accounts : '', 'placeholder' => 'Accounts']); ?>
                    <?php echo form_error('accounts', "<div style='color:red'>", "</div>"); ?>
                </div>
                <div class="col">
                    <label for="">Maths</label>
                    <?php echo form_input(['type' => 'number', 'name' => 'maths', 'max' => '100', 'class' => 'form-control', 'value' => isset($user_det->maths) ? $user_det->maths : '', 'placeholder' => 'Maths']); ?>
                    <?php echo form_error('maths', "<div style='color:red'>", "</div>"); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php
            if (isset($user_det->certificate_1) && $user_det->certificate_1 != '') { ?>
                <label for="">Uploaded High school certificate : <a style="color:blue" target="_blank" href="<?= $user_det->certificate_1 ?>">View</a></label>
            <?php } else { ?>
                <label for="">Upload High school certificate</label>
            <?php
            }
            ?>
            <?php echo form_input(['type' => 'file', 'id' => 'highschool', 'name' => 'highschool', 'class' => 'form-control', 'placeholder' => 'Enter your Email id']); ?>
            <p style="color:red" id="highschool_css"><?php echo $this->session->flashdata('highschool'); ?></p>
        </div>
        <div class="form-group">
            <?php
            if (isset($user_det->certificate_1) && $user_det->certificate_1 != '') { ?>
                <label for="">Uploaded High secondary certificate <a style="color:blue" target="_blank" href="<?= $user_det->certificate_2 ?>">View</a></label>
            <?php } else { ?>
                <label for="">Upload Higher secondary certificate</label>
            <?php
            }
            ?>
            <?php echo form_input(['type' => 'file', 'id' => 'high_sec', 'name' => 'high_sec', 'class' => 'form-control', 'placeholder' => 'Enter your Email id']); ?>
            <p style="color:red" id="high_sec_msg"><?php echo $this->session->flashdata('high_sec'); ?></p>
        </div>
        <input type="hidden" id="school_img_in" name="school_img_in" value="<?= isset($user_det->certificate_1) ? $user_det->certificate_1 : '' ?>">
        <input type="hidden" id="high_school_img_in" name="high_school_img_in" value="<?= isset($user_det->certificate_2) ? $user_det->certificate_2 : '' ?>">
        <div class="form-group">
            <?php
            if (isset($user_det->certificate_1) && $user_det->certificate_1 != '') {
                echo form_submit(['name' => 'insert', 'value' => 'Update', 'class' => 'btn btn-success btn-lg btn-block']);
            } else {
                echo form_submit(['name' => 'insert', 'value' => 'Submit', 'class' => 'btn btn-success btn-lg btn-block']);
            } ?>
        </div>
        </form>
        <?php echo form_close(); ?>
        <div class="text-center">Already have an account? <a href="<?php echo site_url('logout'); ?>">Logout</a></div>
    </div>
</body>
<script>
    $("#highschool").change(function() {
        var file_data = $('#highschool').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        var base_url = '<?= base_url() ?>';
        $.ajax({
            url: base_url + "home/image_upload",
            type: "POST",
            data: form_data,
            contentType: false,
            dataType: "json",
            cache: false,
            processData: false,
            success: function(data) {
                if (data.status == 1) {
                    $("#highschool_css").html(data.msg);
                    $("#highschool_css").css('color', 'green')
                    $("#school_img_in").val(data.img);
                }
            }
        });
    });
    $("#high_sec").change(function() {
        var file_data = $('#high_sec').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        var base_url = '<?= base_url() ?>';
        $.ajax({
            url: base_url + "home/image_upload",
            type: "POST",
            data: form_data,
            contentType: false,
            dataType: "json",
            cache: false,
            processData: false,
            success: function(data) {
                if (data.status == 1) {
                    $("#high_sec_msg").html(data.msg);
                    $("#high_sec_msg").css('color', 'green')
                    $("#high_school_img_in").val(data.img);
                }
            }
        });
    });
</script>

</html>