<!doctype html>
<html class="dark-theme" lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="/template/images/logo.png" type="image/png" />
	<!--plugins-->
	<link href="<?=base_url('template')?>/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="<?=base_url('template')?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?=base_url('template')?>/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?=base_url('template')?>/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
	<!-- loader-->
	<link href="<?=base_url('template')?>/assets/css/pace.min.css" rel="stylesheet"/>
	<script src="<?=base_url('template')?>/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?=base_url('template')?>/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url('template')?>/assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="<?=base_url('template')?>/assets/css/app.css?v=<?=date('his')?>" rel="stylesheet">
	<link href="<?=base_url('template')?>/assets/css/icons.css" rel="stylesheet">
	<link href="<?=base_url('template')?>/assets/css/custom.css?v=<?=date('his')?>" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="<?=base_url('template')?>/assets/css/dark-theme.css"/>
	<link rel="stylesheet" href="<?=base_url('template')?>/assets/css/semi-dark.css"/>
	<link rel="stylesheet" href="<?=base_url('template')?>/assets/css/header-colors.css"/>
	<title>Chiang Mai Low Carbon City</title>

	<script src="<?=base_url('template/assets/')?>js/jquery.min.js?v=<?=date('his')?>"></script>
	<script src="<?=base_url('template/assets/')?>js/jquery-migrate-1.2.1.min.js?v=<?=date('his')?>"></script>
	<style>
		html.dark-theme .logo-icon
{
  filter: none;
}

	</style>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="/template/assets/images/LOGO.png?v=1" class="img-fluid" alt="logo icon">
				</div>
				
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="<?=base_url('admin')?>">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">ภาพรวม</div>
					</a>
				</li>
				<li class="<?=$active == "member" ?'mm-active':''?>">
					<a href="<?=base_url('admin/member')?>">
						<div class="parent-icon"><i class='bx bxs-school'></i>
						</div>
						<div class="menu-title">ชื่อหน่วยงาน</div>
					</a>
				</li>
				
				<li class="menu-label">ตั้งค่า</li>
				<li class="<?=$active == "changepwd" ?'mm-active':''?>">
					<a href="<?=base_url('admin/changepwd')?>">
						<div class="parent-icon"><i class='bx bx-key'></i>
						</div>
						<div class="menu-title">เปลี่ยนรหัสผ่าน</div>
					</a>
				</li>
				<li class="<?=$active == "myear" ?'mm-active':''?>">
					<a href="<?=base_url('admin/myear')?>">
						<div class="parent-icon"><i class='bx bx-cog'></i>
						</div>
						<div class="menu-title">ปีงบประมาณ</div>
					</a>
				</li>
				<!-- <li class="<?=$active == "ef" ?'mm-active':''?>">
					<a href="<?=base_url('admin/ef')?>">
						<div class="parent-icon"><i class='bx bx-grid-alt'></i>
						</div>
						<div class="menu-title">ขอบเขตข้อมูล</div>
					</a>
				</li> -->
				
				
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					
					<div class="top-menu ms-auto">
						
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="/template/assets/images/avatar.webp" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">SignOutz</p>
								<p class="designattion mb-0">Web Developer</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							
							<li><a class="dropdown-item" href="<?=base_url('admin/changepwd')?>"><i class="bx bx-key"></i><span>เปลี่ยนรหัสผ่าน</span></a></li>
							
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="<?=base_url('auth/logout')?>"><i class='bx bx-log-out-circle'></i><span>ออกจากระบบ</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<?php $this->load->view($view);?>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">หน่วยวิจัยเพื่อการจัดการพลังงานและเศรษฐนิเวศ สถาบันวิจัยพหุศาสตร์ มหาวิทยาลัยเชียงใหม่ (3E)</p>
		</footer>
	</div>
	<!--end wrapper-->
	
	<!-- Bootstrap JS -->
	<script src="<?=base_url('template')?>/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	
	<script src="<?=base_url('template')?>/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?=base_url('template')?>/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?=base_url('template')?>/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

	

	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
	<script type="text/javascript" src="<?=base_url('template/assets/')?>/js/jquery-validation/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?=base_url('template/assets/')?>/js/jquery-validation/js/additional-methods.min.js"></script>

	<!--app JS-->
	<script src="<?=base_url('template')?>/assets/js/app.js"></script>
	<script src="<?=base_url('template')?>/assets/js/admin.js?v=<?=date('his')?>"></script>
</body>

</html>