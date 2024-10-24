<script src='https://www.google.com/recaptcha/api.js?hl=th'></script>

		<div class="d-flex align-items-center justify-content-center py-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">
					
						<div class="card">
							<div class="card-body">
								<div class="p-2 rounded">
									<div class="text-center">
										<h3 class="">ลงทะเบียนโรงเรียน</h3>
										<p>หากเคยลงทะเบียนแล้ว ? <a href="/auth/login">เข้าสู่ระบบที่นี่</a>
										</p>
									</div>

									<div class="form-body">
                                        <div class="containerz alert alert-warning" style="display: none;margin-top:20px;" >
                                            <h5>กรุณาป้อนข้อมูลต่อไปนี้ให้ถูกต้องครบถ้วน</h5>
                                            <ol></ol>
                                        </div>
										<form method="post" autocomplete="off" class="g-3" id="form_register">

                                            <div class="mb-3 row">
                                                <label for="member_name" class="col-sm-3 col-form-label">ชื่อหน่วยงาน*</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="member_name" name="member_name" title="ชื่อหน่วยงาน" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="member_name" class="col-sm-3 col-form-label">ประเภท</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="member_type_id" id="member_type_id" title="ประเภทหน่วยงาน" required>
                                                        <option value=""> เลือกข้อมูล </option>
                                                        <?php foreach($rsType as $item){?>
                                                            <option value="<?=$item['type_id']?>"><?=$item['type_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                           
                                            <div class="mb-3 row">
                                                <label for="member_name" class="col-sm-3 col-form-label">ที่อยู่</label>
                                                <div class="col-sm-9">
                                                    <textarea name="member_addr" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="member_province_id" class="col-sm-3 col-form-label">จังหวัด*</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="member_province_id" value="38">
                                                    <input type="text" value="เชียงใหม่" class="form-control" readonly>
                                                    <!-- <select class="form-control" name="member_province_id" id="member_province_id" title="จังหวัด" required>
                                                        <option value=""> เลือกข้อมูล </option>
                                                        <?php foreach($rsProvince as $item){?>
                                                        <option value="<?=$item->PROVINCE_ID?>"> <?=$item->PROVINCE_NAME?> </option>
                                                        <?php }?>
                                                    </select> -->
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="member_amphur_id" class="col-sm-3 col-form-label">อำเภอ*</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="member_amphur_id" id="member_amphur_id" title="อำเภอ" required>
                                                        <option value=""> เลือกข้อมูล </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="member_district_id" class="col-sm-3 col-form-label">ตำบล*</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="member_district_id" id="member_district_id" title="ตำบล" required>
                                                        <option value=""> เลือกข้อมูล </option>
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="mb-3 row">
                                                <label for="member_email" class="col-sm-3 col-form-label">ชื่อผู้ใช้(อีเมล์)*</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="member_email" name="member_email" required title="ชื่อผู้ใช้(อีเมล์)">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="member_password" class="col-sm-3 col-form-label">รหัสผ่าน*</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="member_password" name="member_password" required title="รหัสผ่าน">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="member_password_c" class="col-sm-3 col-form-label">ยืนยันรหัสผ่าน*</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="member_password_c" name="member_password_c" required title="ยืนยันรหัสผ่าน">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col-sm-9 offset-sm-3">
                                                    <div class="g-recaptcha" data-sitekey="6LctcV8UAAAAAMLFuMra0lGAGSP2Qn3Q60DmAd5I"></div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>สมัครใช้งานระบบ</button>
                                                    </div>
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
	