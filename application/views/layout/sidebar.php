<div id="sidebar" style="background-color: aliceblue;" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        <img src="<?= base_url('/assets/img/uploads/' . $this->session->userdata('foto')) ?? ''  ?>" alt="" />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <?= $this->session->userdata('name') ?>
                            </div>
                            <div class="menu-caret ms-auto"></div>
                        </div>
                        <small><?= $this->session->userdata('role') ?></small>
                    </div>
                </a>
            </div>
            <div id="appSidebarProfileMenu" class="collapse">
                <div class="menu-item <?= ($title == 'Setting') ? 'active' : '' ?> pt-5px">
                    <a href="<?= base_url('settings') ?>" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-cog"></i></div>
                        <div class="menu-text">Settings</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('auth/logout') ?>" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-sign-out-alt"></i></div>
                        <div class="menu-text"> Logout</div>
                    </a>
                </div>

                <div class="menu-divider m-0"></div>
            </div>
            <div class="menu-header">Navigation</div>
            <div class="menu-item <?= ($title == 'Dashboard') ? 'active' : '' ?>">
                <a href="<?= base_url('dashboard') ?>" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sliders-h"></i>
                    </div>
                    <div class="menu-text">Dashboard </div>
                </a>
            </div>

        
            <div class="menu-item <?= ($title == 'Device Absensi FaceRecognition') ? 'active' : '' ?>">
                <a href="<?= base_url('device_facerecognition') ?>" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-mobile"></i>
                    </div>
                    <div class="menu-text">Face Recognition</div>
                </a>
            </div>
            <div class="menu-item <?= ($title == 'jabatan') ? 'active' : '' ?>">
                <a href="<?= base_url('dashboard/positions') ?>" class="menu-link">
                    <div class="menu-icon">
                        <i class="fab fa-elementor"></i>
                    </div>
                    <div class="menu-text">jabatan </div>
                </a>
            </div>
            <div class="menu-item <?= ($title == 'Libur') ? 'active' : '' ?>">
                <a href="<?= base_url('holidays') ?>" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-calendar-plus"></i>
                    </div>
                    <div class="menu-text">Hari Libur </div>
                </a>
            </div>
            <div class="menu-item <?= ($title == 'Role') ? 'active' : '' ?>">
                <a href="<?= base_url('roles') ?>" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-universal-access"></i>
                    </div>
                    <div class="menu-text">Role </div>
                </a>
            </div>
            <div class="menu-item has-sub <?= ($title == 'Guru / Staff' || $title == 'karyawan') || $title == 'Users' ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-indent"></i>
                    </div>
                    <div class="menu-text">Data Master</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="<?= base_url('employees') ?>" class="menu-link">
                            <div class="menu-text">karyawan</div>
                        </a>
                    </div>
               
                    <div class="menu-item">
                        <a href="<?= base_url('users') ?>" class="menu-link">
                            <div class="menu-text">User</div>
                        </a>
                    </div>

                </div>
            </div>
            <div class="menu-item has-sub <?= ($title == 'Absensi Guru / Staff' || $title == 'Absensi karyawan') ? 'active' : '' ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <div class="menu-text">Absensi</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="<?= base_url('employee_attandances') ?>" class="menu-link">
                            <div class="menu-text">karyawan</div>
                        </a>
                    </div>
             

                </div>
            </div>


            <!-- BEGIN minify-button -->
            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>
            <!-- END minify-button -->
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
<!-- END #sidebar -->