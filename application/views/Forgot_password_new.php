<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        .login-title {
            color: #0056b3;
        }
        .login-button {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .forgot-password {
            text-align: right;
        }
        .forgot-password a {
            color: #0056b3;
        }
        .generated-text {
            display: block;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body oncopy="return true" oncut="return true" onpaste="return true ">
    <?php $this->load->view('Navbar_view'); ?>
    <div class="container">
        <div class="login-container">
            <h2 class="text-center login-title">Recover Password</h2>
            <form method="post" action="<?php echo base_url('new-forgot-password'); ?>">
                <div class="form-group">
                    <label for="loginId">Email*</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter your email id" name="email" autocomplete="off" >
                    <em id="email-em"></em>
                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile*</label>
                    <input type="number" class="form-control" id="mobile" placeholder="Enter your mobile no" name="mobile" autocomplete="off" >
                    <em id="password-em"></em>
                    <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block login-button" id="submit-btn">Change Password</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript to generate random text -->
    <script>
        // function isEmail(email)
        // {
        //     var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        //     if(emailPattern.test(email))
        //     {
        //         return true;
        //     }
        //     else
        //     {
        //         $("#email-em").text("Enter valid Email");
        //         $("#email-em").css('color', 'red');
        //         return false;
        //     }
        // }

        // function isPassword(password)
        // {
        //     if(password == '')
        //     {
        //         $("#password-em").text("Enter valid Password");
        //         $("#password-em").css('color', 'red');
        //         return false;
        //     }
        //     else
        //     {
        //         if(password.length < 5)
        //         {
        //             $("#password-em").text("Length should be minimum 5");
        //             $("#password-em").css('color', 'red');
        //             return false;
        //         }
        //         return true;
        //     }
        // }

        // function validate_data()
        // {
        //     var email = document.getElementById('email').value;
        //     var password = document.getElementById('password').value;

        //     //VERIFYING CAPTCHA
        //     const generatedText = document.getElementById('generatedText').dataset.captcha;
        //     const enterCaptcha = document.getElementById('enterCaptcha').value;

        //     const validations =
        //     [
        //         isEmail(email),
        //         isPassword(password),
        //         isCaptcha(generatedText, enterCaptcha)
        //     ];
        //     if(validations.every(validation => validation == true))
        //     {
        //         return true;
        //     }
        //     else
        //     {
        //         return false;
        //     }
        // }
    </script>
</body>
</html>
