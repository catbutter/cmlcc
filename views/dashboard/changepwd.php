<?php $admin = $this->session->userdata('admin_logged_in'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">เปลี่ยนรหัสผ่าน</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">เปลี่ยนรหัสผ่าน</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <?php if ($this->uri->segment(3) == 'fail') { ?>
            <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-dark">เกิดข้อผิดพลาด</h6>
                        <div class="text-dark">ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง <br /><a
                                href="/admin/changepwd">ลองใหม่อีกครั้ง</a></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php } ?>
        <?php if ($this->uri->segment(3) == 'success') { ?>

            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">เรียบร้อย</h6>
                        <div class="text-white">ระบบดำเนินการเปลี่ยนข้อมูลเรียบร้อย</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>


        <?php } ?>

        <?php if ($this->uri->segment(3) == '') { ?>
            <div class="containerz alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-body">กรุณาป้อนข้อมูลต่อไปนี้ให้ถูกต้องครบถ้วน</h5>
                        <ol></ol>
                    </div>
                </div>
            </div>
            <form method="post" autocomplete="off" id="form_changepwd">
						
						<h5>ข้อมูลการเข้าใช้งาน</h5>
						<div class="form-group row mb-2">
							<label for="member_email" class="col-sm-3 col-form-label">ชื่อผู้ใช้</label>
							<div class="col-sm-3">
								<input type="email" class="form-control" readonly
									value="<?= $rsMember['member_email'] ?>">
							</div>
						</div>

						<div class="form-group row mb-2">
							<label for="member_password" class="col-sm-3 col-form-label">รหัสผ่านเดิม</label>
							<div class="col-sm-3">
								<input type="password" class="form-control" name="o_password" id="o_password" required
									title="รหัสผ่านเดิม">
							</div>
						</div>
						<div class="form-group row mb-2">
							<label for="member_password" class="col-sm-3 col-form-label">รหัสผ่านใหม่</label>
							<div class="col-sm-3">
								<input type="password" class="form-control" name="n_password" id="n_password" required
									title="รหัสผ่านใหม่">
							</div>
						</div>
						<div class="form-group row mb-2">
							<label for="member_password" class="col-sm-3 col-form-label">ยืนยันรหัสผ่านใหม่</label>
							<div class="col-sm-3">
								<input type="password" class="form-control" name="c_password" id="c_password" required
									title="ยืนยันรหัสผ่านใหม่">
							</div>
						</div>



						<div class="form-group row">
							<div class="col-sm-9 offset-sm-3">
								<input type="hidden" name="member_code" value="<?= $rsMember['member_code'] ?>" />
								<input type="hidden" name="member_id" value="<?= $rsMember['member_id'] ?>" />
								<button type="submit" class="btn btn-primary "><i class="bx bx-save"></i>
									บันทึกข้อมูล</button>
							</div>
						</div>


					</form>
        <?php } ?>
    </div>
</div>