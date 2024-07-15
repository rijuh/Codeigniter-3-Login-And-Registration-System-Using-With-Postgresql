    <div class="sidebar">
        <h2><?php echo $user_data['fname'],' ',$user_data['mname'],' ',$user_data['lname']; ?></h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-white" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#components" role="button" aria-expanded="false" aria-controls="components">
                    Stake Holder
                </a>
                <div class="collapse" id="components">
                    <ul class="nav flex-column ms-3">
                        <?php if($user_data['level'] == 'Admin') { ?>
                            <li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('dashboard/user-list/admin') ?>">Admin</a></li>
                        <?php } ?>
                        <?php if($user_data['level'] == 'Admin' || $user_data['level'] == 'Senior') { ?>
                            <li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('dashboard/user-list/senior') ?>">Senior</a></li>
                        <?php } ?>
                        <?php if($user_data['level'] == 'Admin' || $user_data['level'] == 'Senior' || $user_data['level'] == 'Entry') { ?>
                            <li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('dashboard/user-list/entry') ?>">Entry</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo base_url('change-password') ?>">Change Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo base_url('logout'); ?>">Log Out</a>
            </li>
        </ul>
    </div>