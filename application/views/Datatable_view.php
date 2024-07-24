<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <?php $this->load->view('Dashboard_navbar_view'); ?>
    <div class="content">
        <h2 class="mb-4"><?php echo $level; ?> Table</h2>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                <?php foreach($all_user as $au) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $au['name']; ?></td>
                        <td><?php echo $au['age']; ?></td>
                        <td><?php echo $au['dob']; ?></td>
                        <td><?php echo $au['gender']; ?></td>
                        <td><?php echo $au['email']; ?></td>
                        <td><?php echo $au['mobile_no']; ?></td>
                        <td><?php echo $au['level']; ?></td>
                        <td>
                            <button class="btn btn-success btn-sm"><a href="<?php echo base_url('view-profile/'.$au['id']); ?>">View</a></button>
                            <button class="btn btn-primary btn-sm"><a href="<?php echo base_url('dashboard/edit-profile/'.$au['id']); ?>">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $au['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
        <button class="btn btn-primary btn-sm"><a href="<?php echo base_url('dashboard/download-excel/'.$au['level']); ?>">Download Excel</a></button>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function confirmDelete(user_id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '<?php echo base_url('dashboard/delete-user/'); ?>' + user_id,
                    type: 'POST',
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            $('#row-' + user_id).remove();
                            alert('User deleted successfully.');
                        } else {
                            alert('Error deleting user.');
                        }
                    },
                    error: function() {
                        alert('Error deleting user.');
                    }
                });
            }
        }
    </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
