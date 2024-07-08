<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin: 50px auto;
            max-width: 1000px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        .search-bar {
            margin-bottom: 20px;
            background-color: #0056b3;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .search-bar label {
            margin-right: 10px;
        }
        .search-bar input {
            margin-right: 20px;
        }
        .table th {
            background-color: #0056b3;
            color: white;
            text-align: center;
        }
        .table td {
            text-align: center;
        }
        .form-inline .form-group {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <?php $this->load->view('Navbar_view'); ?>
    <div class="container">
        <div class="table-container">
            <div class="search-bar">
                <form class="form-inline d-flex justify-content-between">
                    <div class="form-group">
                        <label for="searchName">Search by Name:</label>
                        <input type="text" class="form-control" id="searchName" placeholder="Enter Name">
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label for="searchEmail" class="mr-2">Email ID:</label>
                        <input type="email" class="form-control mr-2" id="searchEmail" placeholder="Enter Email">
                        <button type="button" class="btn btn-light">Search</button>
                    </div>
                </form>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Mobile No.</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($all_data as $ad) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $ad['name']; ?></td>
                            <td><?php echo $ad['age']; ?></td>
                            <td><?php echo $ad['dob']; ?></td>
                            <td><?php echo $ad['gender']; ?></td>
                            <td>+91 <?php echo $ad['mobile_no']; ?></td>
                            <td><?php echo $ad['email']; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
