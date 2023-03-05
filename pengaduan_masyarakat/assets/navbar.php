<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                  
                    <div class="nav-item dropdown">
                
              
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <?php if ($_SESSION['level'] == 'petugas') { ?>
                            <img class="rounded-circle me-lg-2" src="../assets/img/petugas.jpg" alt="" style="width: 40px; height: 40px;">
                        <?php } ?>
                        <?php if ($_SESSION['level'] == 'admin') { ?>
                            <img class="rounded-circle me-lg-2" src="../assets/img/admin.jpg" alt="" style="width: 40px; height: 40px;">
                        <?php } ?>
                        <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                            <img class="rounded-circle me-lg-2" src="../assets/img/masyarakat.jpg" alt="" style="width: 40px; height: 40px;">
                        <?php } ?>
                         <span class="d-none d-lg-inline-flex"><?= $_SESSION['username'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Switch Accounts</a>
                        </div>
                    </div>
                </div>
            </nav>