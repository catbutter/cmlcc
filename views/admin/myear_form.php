<?php $admin = $this->session->userdata('admin_logged_in'); ?>
<?php 
$year_value="";
$year_name ="";
$active="";
$isshow="";
$createdate=date('Y-m-d H:i:s');

if($rs!=null){
    $year_value=$rs[0]->year_value;
    $year_name =$rs[0]->year_name;
    $active=$rs[0]->active;
    $isshow=$rs[0]->isshow;
    $createdate=$rs[0]->createdate;
}
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">กำหนดปีงบประมาณ</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">กำหนดปีงบประมาณ</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <a href="<?=base_url('admin/myear/')?>" class="btn btn-sm btn-info me-2"><i class='bx bx-undo' ></i> กลับ</a>
	</div>
</div>

<div class="card">
    <div class="card-body">
        
    <form class="form-horizontal" method="post" role="form" id="fr0"> 
        <div class="row mb-3">
            <label for="year_value" class="col-sm-3 col-form-label">ปีงบประมาณ</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="year_value" id="year_value" title="ปีงบประมาณ" required value="<?=$year_value?>" <?=$year_value!=null?'readonly':''?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="year_name" class="col-sm-3 col-form-label">รายละเอียด</label>
            <div class="col-sm-4">
            <input type="text" class="form-control" name="year_name" id="year_name" title="รายละเอียด" required value="<?=$year_name?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="isshow" class="col-sm-3 col-form-label">สถานะการใช้งาน</label>
            <div class="col-sm-4">
                <div class="radio-list pl-12">
					<label class="radio-inline">
					<input type="radio" name="isshow" value="1" <?=$isshow==1?'checked':''?> <?=$isshow==''?'checked':''?>> เปิดใช้งาน </label>
					<label class="radio-inline">
					<input type="radio" name="isshow" value="0" <?=$isshow==0?'checked':''?> > ปิด </label>	
				</div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="isshow" class="col-sm-3 col-form-label">เลือกเป็นปีหลัก</label>
            <div class="col-sm-4">
                <div class="radio-list pl-12">
					<label class="radio-inline">
					<input type="radio" name="active" value="1" <?=$active==1?'checked':''?> <?=$active==''?'checked':''?>> active </label>
					<label class="radio-inline">
					<input type="radio" name="active" value="0" <?=$active==0?'checked':''?> > null </label>	
				</div>
            </div>
        </div>	
        <div class="mt-3">
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-sm btn-primary"><i class='bx bx-save'></i> บันทึก</button>
                    <a href="/admin/myear" class="btn btn-sm btn-secondary me-2"><i class='bx bx-undo' ></i> ยกเลิก</a>
                    
                </div>
            </div>
		</div>	
	</form>

    </div>
</div>