<?php $admin = $this->session->userdata('admin_logged_in'); ?>
<?php 
$member_permission = array();
if($rs){
    $member_permission = (array) @json_decode(@$rs[0]['member_permission']);
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
        <a href="<?=base_url('admin/member/')?>" class="btn btn-sm btn-info me-2"><i class='bx bx-undo' ></i> กลับ</a>
	</div>
</div>

<div class="card">
    <div class="card-body">
        
    <form class="form-horizontal" method="post" role="form" id="fr0"> 
        <div class="row mb-3">
            <label for="member_name" class="col-sm-3 col-form-label">ชื่อหน่วยงาน</label>
            <label for="member_name" class="col-sm-3 col-form-label"><?=$rs[0]['member_name']?></label>
        </div>
        <div class="row mb-3">
            <label for="member_name" class="col-sm-3 col-form-label">ประเภท</label>
            <label for="member_name" class="col-sm-3 col-form-label"><?=$rs[0]['type_name']?></label>
        </div>
        <div class="row mb-3">
            <label for="member_name" class="col-sm-3 col-form-label">ที่อยู่</label>
            <label for="member_name" class="col-sm-3 col-form-label">
                <?=$rs[0]['member_addr']?>
                ตำบล<?=$rs[0]['DISTRICT_NAME']?>, อำเภอ<?=$rs[0]['AMPHUR_NAME']?>, จังหวัด<?=$rs[0]['PROVINCE_NAME']?>
            </label>
        </div>
        <div class="row mb-3">
            <label for="member_name" class="col-sm-3 col-form-label">พิกัด</label>
            <label for="member_name" class="col-sm-3 col-form-label"><?=$rs[0]['member_lat']?>, <?=$rs[0]['member_lon']?></label>
        </div>
        <div class="row mb-3">
            <label for="member_name" class="col-sm-3 col-form-label">อีเมล์</label>
            <label for="member_name" class="col-sm-3 col-form-label"><?=$rs[0]['member_email']?></label>
        </div>
        <div class="row mb-3">
            <label for="isshow" class="col-sm-3 col-form-label">สถานะการใช้งาน</label>
            <div class="col-sm-4">
                <div class="radio-list pl-12">
					<label class="radio-inline">
					<input type="radio" name="status" value="1" <?=$rs[0]['status']==1?'checked':''?>> อนุมัติการใช้งาน </label>
					<label class="radio-inline">
					<input type="radio" name="status" value="0" <?=$rs[0]['status']==0?'checked':''?> > รออนุมัติ </label>	
				</div>
            </div>
        </div>	
        <input type="hidden" name="send" value="0"> 
        <?php if($rs[0]['status']==1){?>
        <div class="row mb-3">
            <label for="send" class="col-sm-3 col-form-label">ส่งอีเมล์</label>
            <div class="col-sm-4">
                <?php if($rs[0]['send']==1){?>
                    <span class="text-success">ส่งอีเมล์เรียบร้อย</span>
                <?php }else{?>
                    <div class="checkbox-list">
                        <label class="checkbox-inline me-2"><input type="checkbox" id="send" name="send" value="1"> ส่งอีเมล์ให้มหาวิทยาลัย </label>	
                    </div>
                <?php }?>
            </div>
        </div>	
        <!-- <div class="row mb-3">
            <label for="active" class="col-sm-3 col-form-label">การยืนยันอีเมล์</label>
            <div class="col-sm-4">
                <?php if($rs[0]['active']==1){?>
                    <span class="text-success">ยืนยันอีเมล์เรียบร้อย</span>
                <?php }else{?>
                    <span class="text-warning">ยังไม่ได้ยืนยันอีเมล์</span>
                <?php }?>
            </div>
        </div>	 -->
        <?php }?>
        
        <div class="row mb-3">
            <label for="isshow" class="col-sm-3 col-form-label">กำหนดสิทธิการใช้งาน</label>
            <div class="col-sm-4">
                <div class="checkbox-list">
					<?php foreach($rsYearConfig as $item){?>
					    <label class="checkbox-inline me-2">
							<input type="checkbox" id="inlineCheckbox<?=$item->year_value?>" name="member_permission[]" value="<?=$item->year_value?>" <?=in_array($item->year_value, $member_permission)?'checked':''?>> <?=$item->year_value?> </label>
						<?php }?>
				</div>
            </div>
        </div>	
        <div class="mt-3">
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <input type="hidden" name="member_id" value="<?=$rs[0]['member_id']?>">
                    <input type="hidden" name="member_code" value="<?=$rs[0]['member_code']?>">
                    <button type="submit" class="btn btn-sm btn-primary"><i class='bx bx-save'></i> บันทึก</button>
                    <a href="/admin/member" class="btn btn-sm btn-secondary me-2"><i class='bx bx-undo' ></i> ยกเลิก</a>
                    
                </div>
            </div>
		</div>	
	</form>

    </div>
</div>