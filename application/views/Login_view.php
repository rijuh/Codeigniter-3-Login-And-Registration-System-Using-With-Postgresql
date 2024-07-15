<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

            <?php if($this->session->flashdata('LoginFailed')) {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Can not logged in!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if($this->session->flashdata('Dashw')) {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Dashboard is opening
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if($this->session->flashdata('Dashn')) {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Dashboard is opening
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if($this->session->flashdata('captchaerror')) {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Captcha did not match
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if($this->session->flashdata('error')) {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Invalid credentials
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if($this->session->flashdata('PasswordReset')) {?>
                <div class="alert alert-success" role="alert">
                    Password has been reset
                </div>
            <?php } ?>

            <h2 class="text-center login-title">Login Section</h2>
            <form method="post" action="<?php echo base_url('login'); ?>" onsubmit="return validate_data1()">
                <div class="form-group">
                    <label for="loginId">Login Id*</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter your login id" value="<?php echo set_value('email'); ?>" name="email" autocomplete="off">
                    <em id="email-em"></em>
                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
                    <em id="password-em"></em>
                    <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Generated Text:</label>
                    <div id="captcha-image"><?php echo $captcha['image']; ?></div>
                    <button type="button" class="btn btn-primary" id="refresh-captcha">Refresh</button>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter the above text">
                    <?php echo form_error('captcha', '<div class="error">', '</div>'); ?>
                </div>
                <!-- <div class="form-group">
                    <label for="generatedText">Generated Text:</label>
                    <span id="generatedText" class="generated-text"></span>
                    <input type="text" class="form-control" id="enterCaptcha" placeholder="Enter the above text" name="enterCaptcha">
                    <em id="captcha-em"></em>
                </div> -->
                <button type="submit" class="btn btn-primary btn-block login-button" id="submit-btn">Sign In</button>
                <div class="forgot-password mt-3">
                    <a href="<?php echo base_url('forgot-password'); ?>">Forgot Your Password?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript to generate random text -->
    <script>

        //CI CAPTCHA
        $(document).ready(function() {
            $('#refresh-captcha').click(function() {
                $.ajax({
                    url: '<?php echo base_url('Ums_controller/refresh_captcha'); ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if(response.image) {
                            $('#captcha-image').html(response.image);
                        } else {
                            alert('Error refreshing CAPTCHA.');
                        }
                    }
                });
            });
        });

        // Function to generate random alphanumeric text
        // function generateRandomText(length)
        // {
        //     const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        //     let result = '';
        //     const charactersLength = characters.length;
        //     for (let i = 0; i < length; i++) {
        //         result += characters.charAt(Math.floor(Math.random() * charactersLength));
        //     }
        //     return result;
        // }

        // // Generate and display the random text when the page loads
        //     document.addEventListener('DOMContentLoaded', (event) => {
        //     const randomText = generateRandomText(7);
        //     document.getElementById('generatedText').innerText = randomText;
        //     document.getElementById('generatedText').dataset.captcha = randomText;
        // });

        function isEmail(email)
        {
            var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if(emailPattern.test(email))
            {
                return true;
            }
            else
            {
                $("#email-em").text("Enter valid Email");
                $("#email-em").css('color', 'red');
                return false;
            }
        }

        function isPassword(password)
        {
            if(password == '')
            {
                $("#password-em").text("Enter valid Password");
                $("#password-em").css('color', 'red');
                return false;
            }
            else
            {
                if(password.length < 5)
                {
                    $("#password-em").text("Length should be minimum 5");
                    $("#password-em").css('color', 'red');
                    return false;
                }
                return true;
            }
        }

        // function isCaptcha(generatedText, enterCaptcha)
        // {
        //     if(enterCaptcha == generatedText)
        //     {
        //         return true;
        //     }
        //     else
        //     {
        //         $("#captcha-em").text("Invalid captcha");
        //         $("#captcha-em").css('color', 'red');
        //         return false;
        //     }
        // }

        function validate_data()
        {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            // //VERIFYING CAPTCHA
            // const generatedText = document.getElementById('generatedText').dataset.captcha;
            // const enterCaptcha = document.getElementById('enterCaptcha').value;

            const validations =
            [
                isEmail(email),
                isPassword(password),
                // isCaptcha(generatedText, enterCaptcha)
            ];
            if(validations.every(validation => validation == true))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    </script>
</body>
</html>
