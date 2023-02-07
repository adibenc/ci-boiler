<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-name" content="<?= $this->security->get_csrf_token_name(); ?>">
        <meta name="csrf-token" content="<?= $this->security->get_csrf_hash(); ?>">

        <title>Site Administrator - Website perush</title>
        <link href="<?=base_url('assets_admin')?>/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon.png" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/tagsinput.css');?>">
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow navbar-light bg-success" id="sidenavAccordion">
            <a class="navbar-brand text-white" href="<?= base_url() ?>">Site Administrator</a>
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
            
            <ul class="navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown no-caret mr-3 d-none d-md-inline">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdownDocs" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="d-none d-md-inline font-weight-500 ">Documentation</div>
                        <i class="fas fa-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                        <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro" target="_blank">
                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="book"></i></div>
                            <div>
                                <div class="small text-gray-500">Documentation</div>
                                Usage instructions and reference
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/components" target="_blank">
                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="code"></i></div>
                            <div>
                                <div class="small text-gray-500">Components</div>
                                Code snippets and reference
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/changelog" target="_blank">
                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="file-text"></i></div>
                            <div>
                                <div class="small text-gray-500">Changelog</div>
                                Updates and changes
                            </div>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown no-caret mr-3 d-md-none">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
                    <!-- Dropdown - Search-->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100">
                            <div class="input-group input-group-joined input-group-solid">
                                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                                <div class="input-group-append">
                                    <div class="input-group-text"><i data-feather="search"></i></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?=base_url('assets/img/user.png')?>" /></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="<?=base_url('assets/img/user.png')?>" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?=$this->session->userdata('nama');?></div>
                                <div class="dropdown-user-details-email"><?=$this->session->userdata('email');?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=site_url('admin/profil')?>">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Account
                        </a>
                        <a class="dropdown-item" href="<?=site_url('user/logout')?>">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <div class="sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="<?=site_url('admin/dashboard')?>">
                                <div class="nav-link-icon"><i data-feather="bar-chart"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?=site_url('admin/slides')?>">
                                <div class="nav-link-icon"><i data-feather="edit"></i></div>
                                Slideshow
                            </a>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
                                <div class="nav-link-icon"><i data-feather="tool"></i></div>
                                Halaman
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUtilities" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?=site_url('admin/pages')?>">Daftar Halaman</a>
                                    <a class="nav-link" href="<?=site_url('admin/pimpinan')?>">Pimpinan</a>
                                    <a class="nav-link" href="<?=site_url('admin/perush_')?>">perush  dari Masa ke Masa</a>
                                    
                                </nav>
                            </div>
                            <a class="nav-link" href="<?=site_url('admin/berita')?>">
                                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                Berita
                            </a>
                            <a class="nav-link" href="<?=site_url('admin/pers')?>">
                                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                Siaran Pers
                            </a>
                            <a class="nav-link" href="<?=site_url('admin/pengumuman')?>">
                                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                Pengumuman
                            </a>
                            <a class="nav-link" href="<?=site_url('admin/artikel')?>">
                                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                Artikel
                            </a>
                            <a class="nav-link" href="<?=site_url('admin/kegiatan')?>">
                                <div class="nav-link-icon"><i data-feather="calendar"></i></div>
                                Kegiatan
                            </a>
                            <a class="nav-link" href="<?=site_url('admin/buronan')?>">
                                <div class="nav-link-icon"><i data-feather="user"></i></div>
                                Buronan
                            </a>
                            <a class="nav-link" href="<?=site_url('admin/layanan')?>">
                                <div class="nav-link-icon"><i data-feather="filter"></i></div>
                                Layanan/ aplikasi
                            </a>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#widgetMenu" aria-expanded="false" aria-controls="collapseUtilities">
                                <div class="nav-link-icon"><i data-feather="tool"></i></div>
                                Widget
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="widgetMenu" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?=site_url('admin/polling')?>">Polling</a>
                                    <a class="nav-link" href="<?=site_url('admin/widget')?>">Infografis</a>
                                    <a class="nav-link" href="<?=site_url('admin/run_text')?>">Teks Berjalan</a>
                                    <!-- <a class="nav-link" href="<?=site_url('admin/infografis')?>">Social Media</a> -->
                                    <a class="nav-link" href="<?=site_url('admin/video')?>">Video/ Youtube</a>
                                    <a class="nav-link" href="<?=site_url('admin/pop_up')?>">Pop Up Info</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="<?=site_url('admin/menu')?>">
                                <div class="nav-link-icon"><i data-feather="menu"></i></div>
                                Menu
                            </a>
                            <a class="nav-link" href="<?=site_url('admin/users')?>">
                                <div class="nav-link-icon"><i data-feather="user"></i></div>
                                User
                            </a>
                        </div>
                    </div>
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Logged in as:</div>
                            <div class="sidenav-footer-title"><?=$this->session->userdata('nama');?></div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                <?php echo $_content;?>
                </main>
                <footer class="footer mt-auto footer-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; Keperushan  Republik Indonesia. 2021</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="<?php echo base_url() ?>js/jquery.min.js" crossorigin="anonymous"></script>
        <!-- <script src="<?php echo base_url() ?>js/scripts-admin.js"></script> -->
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url('assets_admin')?>/js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('js/ckeditor/ckeditor.js');?>"></script>
        <script src="<?= $_baseurl.'assets/js/ajaxer.js' ?>"></script>
        <script>
            const cl = console.log
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })
        </script>
        <?= $_scripts ?>
    </body>
</html>
