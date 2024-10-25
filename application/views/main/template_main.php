<?php
$member = $this->session->userdata('member_logged_in');
$admin = $this->session->userdata('admin_logged_in');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chiang Mai Low Carbon City</title>

    <link rel="icon" href="/template/assets/images/favicon.png?v=5" type="image/png" />

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="/template/animate/animate.min.css"/>
    <link href="/template/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">    
    <link href="<?= base_url('template/') ?>css/apps.css?v=<?= date('his') ?>" rel="stylesheet">


</head>

<body>
    <header class="border-bottom">
        <nav class="navbar navbar-expand-lg rounded" aria-label="Eleventh navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=base_url()?>">
                    <img src="/template/assets/images/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample09">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('dashboard/database') ?>">ฐานข้อมูลก๊าซเรือนกระจก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= base_url('dashboard/target') ?>">การตั้งเป้าหมายการลดก๊าซเรือนกระจก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('dashboard/less') ?>">การลดก๊าซเรือนกระจก</a>
                        </li>
                    </ul>
                    <?php if ($admin) { ?>
                        <a class="py-2 link-body-emphasis text-decoration-none" href="<?= base_url('admin') ?>">แอดมิน</a>
                    <?php } else if ($member) { ?>
                            <a class="py-2 link-body-emphasis text-decoration-none"
                                href="<?= base_url('admin') ?>">บัญชีผู้ใช้</a>
                    <?php } else { ?>
                            <a class="py-2 link-body-emphasis text-decoration-none btn btn-primary btn-sm"
                                href="<?= base_url('auth/login') ?>"><i class='bx bx-lock-alt'></i> เข้าสู่ระบบ</a>
                    <?php } ?>

                </div>
            </div>
        </nav>
    </header>

    <?php $this->load->view($view); ?>


    <footer class="py-3">
        <p class="text-center m-0 small">หน่วยวิจัยเพื่อการจัดการพลังงานและเศรษฐนิเวศ สถาบันวิจัยพหุศาสตร์
            มหาวิทยาลัยเชียงใหม่ (3E)</p>
    </footer>
    <!-- jQuery (ถ้าใช้) -->
    <!-- jQuery (ถ้าใช้) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/template/owlcarousel/owl.carousel.min.js"></script>  
    <script src="/template/wow/wow.min.js"></script>                  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


    <script type="text/javascript"
        src="<?= base_url('template/') ?>/js/jquery-validation/js/jquery.validate.min.js"></script>
    <script type="text/javascript"
        src="<?= base_url('template/') ?>/js/jquery-validation/js/additional-methods.min.js"></script>
    <script src="<?= base_url('template/') ?>js/apps.js?v=<?= date('his') ?>"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>