<?php 
$faculty_id = null;
$faculty_name = null;
$faculty_username = null;
$faculty_code = null;
$faculty_status = null;
if($rs){
    $faculty_id = $rs[0]['faculty_id'];
    $faculty_name = $rs[0]['faculty_name'];
    $faculty_username = $rs[0]['faculty_username'];
    $faculty_code = $rs[0]['faculty_code'];
    $faculty_status = $rs[0]['faculty_status'];
}

?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">ข้อมูลคณะ</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">ข้อมูลคณะ</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
    <a href="<?=base_url('dashboard/faculty/')?>" class="btn btn-sm btn-info me-2"><i class='bx bx-undo' ></i>กลับ</a>
	</div>
</div>

<div class="card">
    <div class="card-body">
        
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
            <form method="post" autocomplete="off" id="<?=$faculty_code==null?'form_faculty':''?>">

                <div class="form-group row mb-3">
					<label for="faculty_name" class="col-sm-3 col-form-label">โรงเรียน</label>
					<label for="faculty_name" class="col-sm-9 col-form-label"><?=$this->session->userdata('member_logged_in')['member_name']?></label>
				</div>
                <div class="form-group row mb-3">
					<label for="faculty_name" class="col-sm-3 col-form-label">คณะ</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="faculty_name" id="faculty_name" value="<?=$faculty_name?>" required title="คณะ">
					</div>
				</div>
				<div class="form-group row mb-3">
					<label for="faculty_username" class="col-sm-3 col-form-label">ชื่อผู้ใช้</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="faculty_username" id="faculty_username" value="<?=$faculty_username?>" title="ชื่อผู้ใช้" <?=$faculty_username!=''?'readonly':''?> required>
					</div>
                    <?php if($faculty_username==''){?>
                    <label for="faculty_username" class="col-sm-6 col-form-label">เมื่อสร้างคณะครั้งแรกระบบจะสร้างรหัสผ่านให้เหมือนชื่อผู้ใช้โดยอัตโนมัติ*</label>
                    <?php }?>
                </div>
				<div class="form-group row mb-3">
					<label for="faculty_username" class="col-sm-3 col-form-label">สถานะการใช้งาน</label>
					<div class="col-sm-3">
                        <div class="radio-list pl-12">
                            <label class="radio-inline">
                            <input type="radio" name="faculty_status" value="1" <?=$faculty_status==1?'checked':''?> > อนุมัติการใช้งาน </label>
                            <label class="radio-inline">
                            <input type="radio" name="faculty_status" value="0" <?=$faculty_status==0?'checked':''?> > รอการอนุมัติ </label>	
                        </div>
					</div>
				</div>



				<div class="form-group row">
					<div class="col-sm-9 offset-sm-3">
						<input type="hidden" name="faculty_id" id="faculty_id" value="<?= $faculty_id ?>" />
						<input type="hidden" name="faculty_code" id="faculty_code" value="<?= $faculty_code ?>" />
						<button type="submit" class="btn btn-primary btn-sm"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
                    </div>
				</div>


			</form>
        
    </div>
</div>