    <div class="sidebar">
        <h2><?php echo $user_data['name']; ?></h2>
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
                        <?php if($user_data['level'] == 'admin') { ?>
                            <li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('admin-list') ?>">Admin</a></li>
                        <?php } ?>
                        <?php if($user_data['level'] == 'admin' || $user_data['level'] == 'senior') { ?>
                            <li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('senior-list') ?>">Senior</a></li>
                        <?php } ?>
                        <?php if($user_data['level'] == 'admin' || $user_data['level'] == 'senior' || $user_data['level'] == 'entry') { ?>
                            <li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('entry-list') ?>">Entry</a></li>
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