<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
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
    </style>
</head>
<body>
    <?php $this->load->view('Dashboard_navbar_view'); ?>
    <div class="content">
        <?php if($this->session->flashdata('password_changed')){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Your password has changed
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <!-- <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">Dashboard</a>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="d-flex">
                <span class="me-3"><i class="bi bi-bell"></i><span class="badge bg-danger">3+</span></span>
                <span class="me-3"><i class="bi bi-envelope"></i><span class="badge bg-danger">7</span></span>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        Douglas McGee
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav> -->
        <div class="d-flex justify-content-between my-3">
            <h2>Dashboard</h2>
        </div>
        <div class="row">
            <?php if($user_data['level'] == 'Admin') { ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ADMIN</h5>
                        <p class="card-text"><b>Total - <?php echo $count_user['count_admin']; ?></b></p>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($user_data['level'] == 'Admin' || $user_data['level'] == 'Senior') { ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">SENIOR</h5>
                        <p class="card-text"><b>Total - <?php echo $count_user['count_senior']; ?></b></p>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if($user_data['level'] == 'Admin' || $user_data['level'] == 'Senior' || $user_data['level'] == 'Entry') { ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ENTRY</h5>
                        <p class="card-text"><b>Total - <?php echo $count_user['count_admin']; ?></b></p>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Requests</h5>
                        <p class="card-text">18</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
