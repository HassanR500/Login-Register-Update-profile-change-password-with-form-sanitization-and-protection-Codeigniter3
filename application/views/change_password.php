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
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#changePasswordModal">
                                Change Password
                            </button>
                            
                            <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <?= form_open('admin/dashboard/changePassword', array('id' => 'changePasswordFormModal')); ?>
                                            <div class="form-group">
                                                <label for="modalCurrentPassword">Current Password</label>
                                                <input type="password" class="form-control" name="currentPassword" id="modalCurrentPassword" placeholder="Current Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="modalNewPassword">New Password</label>
                                                <input type="password" class="form-control" name="password" id="modalNewPassword" placeholder="New Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="modalConfirmPassword">Confirm Password</label>
                                                <input type="password" class="form-control" name="cpassword" id="modalConfirmPassword" placeholder="Confirm New Password">
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
                                            <?= form_close(); ?>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="submitModal">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
        $(document).ready(function () {
            $('#submitModal').click(function () {
                var formData = $('#changePasswordFormModal').serialize();

                $.ajax({
                    type: 'POST',
                    url: $('#changePasswordFormModal').attr('action'),
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
    <!-- ... -->
</aside>

<?php $this->load->view('includes/footer') ?>
