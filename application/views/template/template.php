<?php
$stats = $this->frontdesk->getCurrentStats();
$counts = $stats['counts'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="perush " />
    <meta name="description" content="perush " />
    <meta name="author" content="perush" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-name" content="<?= $this->security->get_csrf_token_name(); ?>">
    <meta name="csrf-token" content="<?= $this->security->get_csrf_hash(); ?>">
    <!-- meta seos -->
    <?= $_seometa ?>
    <title>perush</title>
    <link href="<?php echo base_url() ?>assets/css/styles-admin.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo-x.png') ?>" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"> </script>
    <script src="<?php echo base_url() ?>js/jquery.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url() ?>js/scripts-admin.js"></script>
    <script>
    (function(d) {
        var s = d.createElement("script");
        s.setAttribute("data-account", "Ehe6ujyB9U");
        s.setAttribute("src", "https://cdn.userway.org/widget.js");
        (d.body || d.head).appendChild(s);
    })(document)
    </script><noscript>Please ensure Javascript is enabled for purposes of <a href="https://userway.org">website
            accessibility</a></noscript>
    <script>
    $(document).ready(function() {
        var checkPage = '<?= (isset($page)) ? $page : ''; ?>';
        if (checkPage != '') {
            $('.nav-link[data-id=' + checkPage + ']').addClass('active');
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
</head>

<body>
    <div style="position:fixed;right:10px;bottom:10px;z-index: 999;">
        <a href="https://api.whatsapp.com/send?phone=+6281220201344&text=Hallo admin perush Agung."
            class="btn btn-lg text-white"
            style="background-image: linear-gradient(#ff0000ff, #002B5B); border: none !important;">
            <i class="fab fa-whatsapp"></i>
            Hubungi Kami
		</a>
    </div>
    <div class="py-2 text-white" style='background-color: #ff0000ff; '>
        <div class="container">
            <div class="topbar small">
                <div id="topBar" class="collapsex font-weight-bold">
                    <?=viewDate(date('Y-m-d'));?>

                    <div class="float-right font-weight-bold">
                        <a href="https://www.facebook.com/people/perush-RI/100064391933878/" target="_blank"
                            class="text-white mr-2"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.youtube.com/channel/UCy9IA8V2Wo2pxHHXDVVtuhA" target="_blank"
                            class="text-white mr-2"><i class="fab fa-youtube"></i></a>
                        <a href="https://twitter.com/perushri?lang=en" target="_blank" class="text-white mr-2"><i
                                class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/perush.ri/" target="_blank" class="text-white mr-2"><i
                                class="fab fa-instagram"></i> | 
						</a>
                        <a href="<?=site_url('bahasa/id');?>"><img src="<?=base_url('assets/img/id.png')?>" alt=""></a>
                        <a href="<?=site_url('bahasa/en');?>"><img src="<?=base_url('assets/img/gb.png')?>" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light sticky-top px-2">
                    <div class="container">
                        <a href="https://www.perush.go.id/">
                            <div class="logo pt-2">
                                <img src="<?= base_url('assets/img/logo.png') ?>" width="100" alt="logo">
                            </div>
                        </a>
                        <div class="front ml-2">
                            <h6 class="my-0" style="margin-bottom: -0.5rem !important;">perush 
                            </h6>
                            <h2 class="font-weight-bold text-dark">perush</h2>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation"><svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-menu">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mr-lg-5">
                                <li class="nav-item"><a class="nav-link" data-id="home" href="<?= site_url() ?>"><?=lang('beranda');?>
                                    </a></li>
                                <li class="nav-item"><a class="nav-link" data-id="berita"
                                        href="<?= site_url('berita') ?>"><?=lang('berita');?> </a></li>
                                <li class="nav-item dropdown dropdown-xl no-caret">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownDemos" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profil<svg
                                            class="svg-inline--fa fa-chevron-right fa-w-10 dropdown-arrow"
                                            aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 320 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                                            </path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right animated--fade-in-up mr-lg-n15"
                                        aria-labelledby="navbarDropdownDemos">
                                        <div class="row no-gutters">
                                            <div class="col-lg-12 p-lg-5">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        #menu1
                                                    </div>
                                                    <div class="col-lg-6">
                                                        #menu2
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item"><a class="nav-link" target="_blank"
                                        href="https://ppid.perush.go.id/">Pelayanan Informasi Publik </a></li>
                                <li class="nav-item"><a class="nav-link" target="_blank"
                                        href="https://cms-publik.perush.go.id/"><?=lang('info_perkara');?> </a></li>

                            </ul>
                        </div>
                    </div>
                </nav>
                <?php if (true) { ?>
                <div class="container">

                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url(null) ?>"><?= null ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= null ?></li>
                        </ol>
                    </nav>
                </div>
                <?php } ?>


                <?php echo $_content; ?>
            </main>
        </div>

        <div id="layoutDefault_footer">
            <footer class="footer pt-5 pb-5 mt-auto bg-danger footer-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-white footer-brand">perush </div>
                            <div class="mb-3">
                                Website ini dikelola oleh <br>
                                Pusat perush <br>
                                
                                Jakarta Selatan - Indonesia
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Statistik Pengunjung</div>
                                    Online : <?= null ?> Pengunjung <br>
                                    Bulan ini : <?= null ?> Pengunjung <br>
                                    Tahun ini : <?= null ?> Pengunjung
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5">
                    <div class="row align-items-center">
                        <div class="col-lg-12">disclaimer.</div>
                        <div class="col-md-12 mt-3 text-center small">Copyright &copy; perush 20xx
                            <img src="http://www.w3.org/Icons/valid-html401-blue.png" alt="w3c" class="float-right">
                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?= $_baseurl.'assets/js/ajaxer.js' ?>"></script>
    <?= $_scripts ?>
</body>

</html>