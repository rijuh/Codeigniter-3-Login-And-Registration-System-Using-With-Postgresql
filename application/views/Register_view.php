<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .add-more {
            margin-top: 10px;
        }
        .delete-row {
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php $this->load->view('Navbar_view'); ?>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-12">
            <h2 class="text-left">User Registration:</h2>
            <div class="card mb-5">

                <!-- PERSONAL DETAILS SECTION -->
                <div class="card-header bg-dark text-white text-center">
                    PERSONAL DETAILS
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('success')){ ?>
                        <div class="alert alert-success" role="alert">
                            Registered successfully
                        </div>
                    <?php } ?>
                    <form method="POST" action="<?php echo base_url('register'); ?>" onsubmit="return validate_data()">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="firstName">Name*</label>
                                <input type="text" class="form-control" id="fname" placeholder="First Name" value="<?php echo set_value('fname'); ?>" name="fname">
                                <em class="name-em"></em>
                                <?php echo form_error('fname', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middleName">&nbsp;</label>
                                <input type="text" class="form-control" id="mname" placeholder="Middle Name" value="<?php echo set_value('mname'); ?>" name="mname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastName">&nbsp;</label>
                                <input type="text" class="form-control" id="lname" placeholder="Last Name" value="<?php echo set_value('lname'); ?>" name="lname">
                                <em class="name-em"></em>
                                <?php echo form_error('lname', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="age">Age*</label>
                                <input type="number" class="form-control" id="age" placeholder="Age" value="<?php echo set_value('age'); ?>" name="age">
                                <em id="age-em"></em>
                                <?php echo form_error('age', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dob">Date of Birth*</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob'); ?>">
                                <em id="dob-em"></em>
                                <?php echo form_error('dob', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender">Gender*</label>
                                <select id="gender" class="form-control" name="gender" value="<?php echo set_value('gender'); ?>">
                                    <option selected>Choose...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                                <em id="gender-em"></em>
                                <?php echo form_error('gender', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="mobile">Mobile No*:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+91</span>
                                    </div>
                                    <input type="number" class="form-control" id="mobile" placeholder="Mobile No" value="<?php echo set_value('mobile'); ?>" name="mobile">
                                </div>
                                <em id="mobile-em"></em>
                                <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email*</label>
                                <input type="email" class="form-control" id="email" placeholder="Email ID" value="<?php echo set_value('email'); ?>" name="email">
                                <em id="email-em"></em>
                                <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">Password*</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password" value="<?php echo set_value('password'); ?>" name="password">
                                <em id="password-em"></em>
                                
                            </div>
                        </div>
            
                        <!-- EDUCATIONAL QUALIFICATION SECTION -->
                        <div class="card mb-5">
                            <div class="card-header bg-dark text-white text-center">
                                EDUCATIONAL QUALIFICATION
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Exam Name</th>
                                            <th>Year of Passing</th>
                                            <th>Institution Name</th>
                                            <th>Marks Obtain</th>
                                            <th>Out of</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="education-body">
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Exam Name">
                                                <em class="error"></em>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" placeholder="Year of Passing">
                                                <em class="error"></em>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Institution Name">
                                                <em class="error"></em>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" placeholder="Marks Obtain">
                                                <em class="error"></em>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" placeholder="Out of">
                                                <em class="error"></em>
                                            </td>
                                            <td><span class="delete-row">&times;</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-secondary add-more" id="add-more">Add More</button>
                            </div>
                        </div>

                        <div class="form-group text-right mt-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let rowCount = 1;

            $('#add-more').click(function() {
                rowCount++;
                $('#education-body').append(`
                    <tr>
                        <td>${rowCount}</td>
                        <td>
                            <input type="text" class="form-control" placeholder="Exam Name">
                            <em class="error"></em>
                        </td>
                        <td>
                            <input type="number" class="form-control" placeholder="Year of Passing">
                            <em class="error"></em>
                        </td>
                        <td>
                            <input type="text" class="form-control" placeholder="Institution Name">
                            <em class="error"></em>
                        </td>
                        <td>
                            <input type="number" class="form-control" placeholder="Marks Obtain">
                            <em class="error"></em>
                        </td>
                        <td>
                            <input type="number" class="form-control" placeholder="Out of">
                            <em class="error"></em>
                        </td>
                        <td><span class="delete-row">&times;</span></td>
                    </tr>
                `);
            });

            
            $('#education-body').on('click', '.delete-row', function() {
                if ($('#education-body tr').length > 1)
                {
                    $(this).closest('tr').remove();
                    rowCount--;
                    updateRowNumbers();
                }
            });

            function updateRowNumbers() {
                $('#education-body tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            }
        });

        function isName(name)
        {
            if(name == '')
            {
                // alert('Name Not Validate');
                $('.name-em').text('Enter valid name');
                $('.name-em').css('color', 'red');
                return false;
            }
            return true;
        }

        function isAge(age)
        {
            if(age == '' || (age.toString()).length > 2)
            {
                // alert('Age Not Validate');
                $('#age-em').text('Enter valid age');
                $('#age-em').css('color', 'red');
                return false;
            }
            return true;
        }

        function isDob(dob)
        {
            if(dob == '')
            {
                $('#dob-em').text('Enter valid DOB');
                $('#dob-em').css('color', 'red');
                return false;
            }
            return true;
        }

        function isGender(gender)
        {
            if(gender == 'Choose...')
            {
                $('#gender-em').text('Enter valid Gender');
                $('#gender-em').css('color', 'red');
                return false;
            }
            return true;
        }

        function isMobile(mobile)
        {
            if((mobile.toString()).length == 10)
            {
                return true;
            }
            else
            {
                $('#mobile-em').text('Enter valid Mobile');
                $('#mobile-em').css('color', 'red');
                return false;
            }
        }

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

        function isEducation()
        {
            let isValid = true;
            $('#education-body tr').each(function()
            {
                $(this).find('input').each(function()
                {
                    if ($(this).val() === '')
                    {
                        $(this).siblings('em').text('This field is required').css('color', 'red');
                        isValid = false;
                    }
                    else
                    {
                        $(this).siblings('em').text('');
                    }
                });
            });
            return isValid;
        }

        function validate_data()
        {
            fname = $('#fname').val();
            lname = $('#lname').val();
            age = $('#age').val();
            mobile = $('#mobile').val();
            dob = $('#dob').val();
            gender = $('#gender').val();
            email = $('#email').val();

            // alert("Values fetch");

            var validations =
            [
                isName(fname),
                isName(lname),
                isAge(age),
                isDob(dob),
                isGender(gender),
                isMobile(mobile),
                isEmail(email),
                isEducation()
            ];

            if(validations.every(validation => validation === true))
            {
                return true;
            }
            else
            {
                alert('Not Validate');
                return false;
            }
        }
    </script>
</body>
</html>
