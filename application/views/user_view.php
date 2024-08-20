<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->load->view('css_js'); ?>
</head>

<body>
    <div class="signup-form">
        <?php if ($this->session->flashdata('success')) { ?>
            <p style="color:white;background: green;font-size: medium;text-align: center;"><?php echo $this->session->flashdata('success'); ?></p>
        <?php } ?>
        <h2><?= $_SESSION['fname'] ?></h2>
        <div class="row">
            <div class="col">
                <button class="float-right submit-button" style="background-color: #008CBA; color: white;" onclick="location.href = '<?= base_url() ?>user-details';" value="Submit">Edit user details</button>
                <button class="float-right submit-button" style="background-color: #008CBA; color: white;" onclick="location.href = '<?= base_url() ?>select-course';" value="Reset">Apply for job</button>
            </div>
        </div>
        <?php
        echo form_open('login-check', ['name' => 'userregistration', 'autocomplete' => 'off']); ?>
        <div class="form-group">
            <table style="width:100%">
                <tr>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Biology</th>
                    <th>Maths</th>
                    <th>Account</th>
                    <th>Computer</th>
                </tr>
                <tr>
                    <td><?= $_SESSION['fname'] ?></td>
                    <td><?= $user_det->dob ?> </td>
                    <td><?= $user_det->biology ?>%</td>
                    <td><?= $user_det->maths ?>%</td>
                    <td><?= $user_det->accounts ?>%</td>
                    <td><?= $user_det->computer ?>%</td>
                </tr>
            </table>
        </div>
        <?php
        if (isset($applied_course->user_id) && $applied_course->user_id) {
        ?>
            <p>Applied Course : <?= $course_details[0]->name ?></p>
            <p>Status of applied course : <?= $applied_course->status ?></p>
        <?php } ?>
        <!-- <div class="form-group">
<?php //echo form_submit(['name'=>'insert','value'=>'Submit','class'=>'btn btn-success btn-lg btn-block']);
?>
        </div> -->
        </form>
        <?php echo form_close(); ?>
        <div class="text-center">Not Registered Yet? <a href="<?php echo site_url('logout'); ?>">Logout</a></div>
    </div>
</body>

</html>