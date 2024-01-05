<?php $this->load->view('includes/header') ?>

<?php $this->load->view('includes/sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">CPU Traffic</span>
                      <span class="info-box-number">10<small>%</small></span>
                    </div>
                  </div>
                </div>
                
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Likes</span>
                      <span class="info-box-number">41,410</span>
                    </div>       
                  </div>
                </div>

                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Sales</span>
                      <span class="info-box-number">760</span>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">New Members</span>
                      <span class="info-box-number">2,000</span>
                    </div>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3><br>
                        </div>
                         <?= form_open('admin/dashboard/changePassword', array('id' => 'changePasswordForm')); ?>
                            <div class="card-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Current Password</label>
                                  <input type="password" class="form-control" name = "currentPassword" id="exampleInputEmail1" placeholder="Current Password">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">New Password</label>
                                  <input type="password" class="form-control" name = "password" id="exampleInputPassword1" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Confirm Password</label>
                                  <input type="password" class="form-control" name = "cpassword" id="exampleInputPassword1" placeholder="Comfirm New Password">
                                </div>
                                <div class="form-check">
                                    <?php if($this->session->userdata('error')) { ?>
                                        <p class="text-danger"><?=$this->session->userdata('error')?></p>
                                    <?php } ?>
                                    <?php if($this->session->userdata('success')) { ?>
                                        <p class="text-success"><?=$this->session->userdata('success')?></p>
                                    <?php } ?>
                                    <p class="text-danger"><?=validation_errors()?></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function () {
        $('#changePasswordForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert('Password changed successfully');
                        window.location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function () {
                    alert('Error: Something went wrong.');
                }
            });
        });
    });
</script>
<aside class="control-sidebar control-sidebar-dark">
</aside>

<?php $this->load->view('includes/footer') ?>
