<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
        }
        a {
            color: white;
            text-decoration: none;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #4e73df;
            color: white;
            padding: 20px;
            position: fixed;
        }
        .sidebar h2 {
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .card {
            margin-bottom: 20px;
        }
        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    
    <?php $this->load->view('Dashboard_navbar_view'); ?>
    <div class="content">
    <div class="col-md-12">
            <h2 class="text-left"><?php echo $user_profile['fname'],' ',$user_profile['mname'],' ',$user_profile['lname']; ?>'s Profile</h2>
            <div class="card mb-5">

                <!-- PERSONAL DETAILS SECTION -->
                <div class="card-header bg-dark text-white text-center">
                    PERSONAL DETAILS
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('success')){ ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Registered successfully
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="firstName">Name*</label>
                                <input type="text" class="form-control" id="fname" placeholder="First Name" value="<?php echo $user_profile['fname']; ?>" name="fname" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middleName">&nbsp;</label>
                                <input type="text" class="form-control" id="mname" placeholder="" value="<?php echo $user_profile['mname']; ?>" name="mname" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastName">&nbsp;</label>
                                <input type="text" class="form-control" id="lname" placeholder="Last Name" value="<?php echo $user_profile['lname']; ?>" name="lname" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="age">Age*</label>
                                <input type="number" class="form-control" id="age" placeholder="Age" value="<?php echo $user_profile['age']; ?>" name="age" disabled>
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dob">Date of Birth*</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user_profile['dob']; ?>" disabled>
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender">Gender*</label>
                                <select id="gender" class="form-control" name="gender" value="" disabled>
                                    
                                    <option <?php if($user_profile['gender'] == 'Male') echo "selected" ?> >Male</option>
                                    <option <?php if($user_profile['gender'] == 'Female') echo "selected" ?> >Female</option>
                                    <option <?php if($user_profile['gender'] == 'Others') echo "selected" ?> >Other</option>
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="mobile">Mobile No*:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+91</span>
                                    </div>
                                    <input type="number" class="form-control" id="mobile" placeholder="Mobile No" value="<?php echo $user_profile['mobile_no']; ?>" name="mobile" disabled>
                                </div>
                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email*</label>
                                <input type="email" class="form-control" id="email" placeholder="Email ID" value="<?php echo $user_profile['email']; ?>" name="email" disabled>
                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="level">Level*</label>
                                <select id="level" class="form-control" name="level" value="" disabled>
                                    <option <?php if($user_profile['level'] == 'Admin') echo "selected" ?>>Admin</option>
                                    <option <?php if($user_profile['level'] == 'Senior') echo "selected" ?>>Senior</option>
                                    <option <?php if($user_profile['level'] == 'Entry') echo "selected" ?>>Entry</option>
                                </select>
                                
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
                                        </tr>
                                    </thead>
                                    <tbody id="education-body">
                                        <?php $i = 1; foreach($user_education as $edu) {?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <input type="text" class="form-control" value="<?php echo $edu['exam_name']; ?>" placeholder="Exam Name" disabled>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" value="<?php echo $edu['yop']; ?>" placeholder="Year of Passing" disabled>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="<?php echo $edu['inst_name']; ?>" placeholder="Institution Name" disabled>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" value="<?php echo $edu['o_marks']; ?>" placeholder="Marks Obtain" disabled>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" value="<?php echo $edu['f_marks']; ?>" placeholder="Out of" disabled>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group text-right mt-4">
                            <button type="button" class="btn btn-primary"><a href="<?php echo base_url('dashboard/edit-profile/'.$user_profile['id']); ?>">Edit</a></button>
                            <button type="button" class="btn btn-primary"><a href="<?php echo base_url('dashboard/download-pdf/'.$user_profile['id']); ?>">Download PDF</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
