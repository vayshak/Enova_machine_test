<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('css_js'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .signup-form h2:before,
        .signup-form h2:after {
            content: "";
            height: 2px;
            width: 15% !important;
            background: #d4d4d4;
            position: absolute;
            top: 50%;
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="signup-form">
        <h2>Select your course</h2>
        <p class="hint-text">The courses are listed here according to your percentage of your marks.</p>
        <div class="row">
            <div class="col">
                <button class="float-right submit-button" style="background-color: #008CBA; color: white;" onclick="location.href = '<?= base_url() ?>user-details';" value="Submit">Edit user details</button>
            </div>
        </div>
        <?php echo form_open('home/apply_course', ['name' => 'userregistrationj', 'autocomplete' => 'off']); ?>
        <div class="form-group">
            <!--success message -->
            <?php if ($this->session->flashdata('success')) { ?>
                <p style="color:green"><?php echo $this->session->flashdata('success'); ?></p>
            <?php } ?>
            <!--error message -->
            <?php if ($this->session->flashdata('error')) { ?>
                <p style="color:red"><?php echo $this->session->flashdata('error'); ?></p>
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="">Please choose your course</label>
            <select name="course" id="course" class='form-control'>
                <option value="">--Select Courses--</option>
                <?php
                 $flag=0;
                if (isset($course) && !empty($course)) {
                
                    foreach ($course as $key => $value) {
                        if (($value->computer_mrk <= $users[0]->computer) && ($value->biology_mrk <= $users[0]->biology) && ($value->account_mrk <= $users[0]->accounts) && ($value->maths_mrk <= $users[0]->maths)) {
                            $flag=1;
                ?>
                            <option value="<?= $value->id ?>" <?php if (isset($applied_course->course_id) && $applied_course->course_id == $value->id) {
                                                                    echo 'selected';
                                                                } ?>><?= $value->name ?></option>
                <?php
                        }
                    }
                } ?>
            </select>
            <?php if($flag==0){ ?>
            <div style='color:red'> The marks you have are very low, so you are not eligible to apply for these courses.</div>
            <?php } ?>
            <?php echo form_error('course', "<div style='color:red'>", "</div>"); ?>
        </div>
        <div class="form-group">
            <?php echo form_submit(['name' => 'insert', 'value' => 'Apply', 'class' => 'btn btn-success btn-lg btn-block']); ?>
        </div>
        </form>
        <?php echo form_close(); ?>
        <div class="text-center">Already have an account? <a href="<?php echo site_url('logout'); ?>">Logout</a></div>
    </div>
</body>

</html>