<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                    <form method="POST" action="<?php echo base_url('Ums_controller/insert_data'); ?>" onsubmit="return validate_data()">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="firstName">Name*</label>
                                <input type="text" class="form-control" id="firstName" placeholder="First Name" value="<?php echo set_value('fname'); ?>" name="fname">
                                <em id="fname_em"></em>
                                <?php echo form_error('fname', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middleName">&nbsp;</label>
                                <input type="text" class="form-control" id="middleName" placeholder="Middle Name" value="<?php echo set_value('mname'); ?>" name="mname">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastName">&nbsp;</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo set_value('lname'); ?>" name="lname">
                                <?php echo form_error('lname', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="age">Age*</label>
                                <input type="number" class="form-control" id="age" placeholder="Age" value="<?php echo set_value('age'); ?>" name="age">
                                <?php echo form_error('age', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dob">Date of Birth*</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob'); ?>">
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
                                <?php echo form_error('gender', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="mobile">Mobile No*:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+91</span>
                                    </div>
                                    <input type="text" class="form-control" id="mobile" placeholder="Mobile No" value="<?php echo set_value('mobile'); ?>" name="mobile">
                                </div>
                                <?php echo form_error('mobile', '<div class="error">', '</div>'); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email*</label>
                                <input type="email" class="form-control" id="email" placeholder="Email ID" value="<?php echo set_value('email'); ?>" name="email">
                                <?php echo form_error('email', '<div class="error">', '</div>'); ?>
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
                                            <td><input type="text" class="form-control" placeholder="Exam Name"></td>
                                            <td><input type="text" class="form-control" placeholder="Year of Passing"></td>
                                            <td><input type="text" class="form-control" placeholder="Institution Name"></td>
                                            <td><input type="text" class="form-control" placeholder="Marks Obtain"></td>
                                            <td><input type="text" class="form-control" placeholder="Out of"></td>
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
                        <td><input type="text" class="form-control" placeholder="Exam Name" required></td>
                        <td><input type="text" class="form-control" placeholder="Year of Passing" required></td>
                        <td><input type="text" class="form-control" placeholder="Institution Name" required></td>
                        <td><input type="text" class="form-control" placeholder="Marks Obtain" required></td>
                        <td><input type="text" class="form-control" placeholder="Out of" required></td>
                        <td><span class="delete-row">&times;</span></td>
                    </tr>
                `);
            });

            
            $('#education-body').on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
                rowCount--;
                updateRowNumbers();
            });

            function updateRowNumbers() {
                $('#education-body tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            }
        });
    </script>
</body>
</html>
