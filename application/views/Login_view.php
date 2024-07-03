<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
<body>
    <div class="container">
        <div class="login-container">
            <?php if($this->session->flashdata('LoginFailed')) {?>
                <div class="alert alert-danger" role="alert">
                    Can not logged in!
                </div>
            <?php } ?>
            <h2 class="text-center login-title">Login Section</h2>
            <form method="post" action="<?php echo base_url('login'); ?>">
                <div class="form-group">
                    <label for="loginId">Login Id*</label>
                    <input type="text" class="form-control" id="loginId" placeholder="Enter your login id" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
                </div>
                <div class="form-group">
                    <label for="generatedText">Generated Text:</label>
                    <span id="generatedText" class="generated-text"></span>
                    <input type="text" class="form-control" id="generatedTextInput" placeholder="Enter the above text" name="captcha">
                </div>
                <button type="submit" class="btn btn-primary btn-block login-button">Sign In</button>
                <div class="forgot-password mt-3">
                    <a href="#">Forgot Your Password?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript to generate random text -->
    <script>
        // Function to generate random alphanumeric text
        function generateRandomText(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        // Generate and display the random text when the page loads
        document.addEventListener('DOMContentLoaded', (event) => {
            const randomText = generateRandomText(7);
            document.getElementById('generatedText').innerText = randomText;
        });
    </script>
</body>
</html>
