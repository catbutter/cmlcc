<script src='https://www.google.com/recaptcha/api.js?hl=th'></script>
<div class="d-flex align-items-center justify-content-center my-lg-0" style="height:80vh">
	<div class="container-fluid">
		<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
			<div class="col mx-auto">

				<div class="card">
					<div class="card-body">
						<div class="p-2 rounded">
							<div class="text-center">
								<h3 class="">เข้าสู่ระบบ</h3>
								<p>หากคุณยังไม่ได้สมัครใช้งาน? <a
										href="<?= base_url('auth/register') ?>">ลงทะเบียนที่นี่</a>
								</p>
							</div>

							<?php echo validation_errors(); ?>

							<div class="form-body">
								<form method="post" class="row g-3">
									<div class="col-12">
										<label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
										<input type="text" class="form-control" id="username" name="username"
											placeholder="ชื่อผู้ใช้งาน">
									</div>
									<div class="col-12">
										<label for="inputChoosePassword" class="form-label">รหัสผ่าน</label>
										<div class="input-group" id="show_hide_password">
											<input type="password" class="form-control border-end-0" id="password"
												name="password" placeholder="รหัสผ่าน"> <a href="javascript:;"
												class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
												checked>
											<label class="form-check-label"
												for="flexSwitchCheckChecked">จดจำการเข้าสู่ระบบ</label>
										</div>
									</div>
									<div class="col-md-6 text-end"> <a href="<?= base_url('auth/forgot') ?>">ลืมรหัสผ่าน
											?</a>
									</div>
									<div class="col-12">
										<div style="width:305px;margin:0 auto;">
											<div class="g-recaptcha" data-sitekey="6LctcV8UAAAAAMLFuMra0lGAGSP2Qn3Q60DmAd5I"></div>
										</div>
									</div>
									<div class="col-12">
										<div class="d-grid">
											<button type="submit" class="btn btn-primary"><i
													class="bx bxs-lock-open"></i>ยืนยันเข้าสู่ระบบ</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end row-->
	</div>
</div>