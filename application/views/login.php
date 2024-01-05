<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .error-container {
            margin-bottom: 15px;
        }

        .error-message {
            background-color: #ffcccc;
            color: #cc0000;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
	<?= form_open('login/index', array('id' => 'loginForm')); ?>
        <div class="error-container"></div>
            <div class="user-box">
                <input type="email" name="email" autocomplete="off">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" autocomplete="off">
                <label>Password</label>
            </div>
            <div class="btn">
                <a href="#" id="submitForm">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit
                </a>
                <input type="submit" class="hidden-submit" id="hiddenSubmit">
                <a href="<?=base_url('register/index')?>" style="text-align:right;margin-left:30px">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Register
                </a>
            </div>
        <?= form_close(); ?>
    </div>

    <script src="<?=base_url('assets/')?>dist/js/login.js"></script>
   
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            window.location.replace('<?= base_url('admin/dashboard/index'); ?>');
                        } else {
                            displayError(response.message);
                            window.location.reload();
                        }
                    },
                    error: function() {
                        displayError('Something went wrong.');
                    }
                });
            });

            function displayError(errorMessage) {
                var errorContainer = document.querySelector('.error-container');
                var errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.textContent = errorMessage;

                errorContainer.innerHTML = '';
                errorContainer.appendChild(errorDiv);
            }
        });
    </script>
</body>
</html>
