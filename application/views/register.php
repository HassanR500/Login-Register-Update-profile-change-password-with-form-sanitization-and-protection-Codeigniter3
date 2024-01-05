<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/style.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>.error-container {
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
        <h2>Register</h2>
	<?= form_open('register/registerNow', array('id' => 'registerForm')); ?>
        <div class="error-container"></div>
            <div class="user-box">
                <input type="text" name="username">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="email" name="email">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="text" name="phone">
                <label>Phone</label>
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
                <a href="<?=base_url('login/index')?>" style="text-align:right;margin-left:70px">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Login
                </a>
            </div>
        <?= form_close(); ?>
    </div>
    <script src="<?=base_url('assets/')?>dist/js/login.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#submitForm').click(function(e) {
            e.preventDefault();

            var formData = $('#registerForm').serialize();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('register/registerNow') ?>',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('User Registered Successfully');
                        window.location.href = '<?= base_url('register') ?>';
                    } else if (response.status === 'error') {
                        displayError(response.message);
                    } else {
                        alert('Error: Something went wrong!');
                    }
                },
                error: function(xhr, status, error) {

                    alert('AJAX Error: ' + error);
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
