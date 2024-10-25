<?php $s_member = $this->session->userdata('member_logged_in'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">ข้อมูลส่วนตัว</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">ข้อมูลส่วนตัว</li>
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
                        <h5 class="text-body">กรุณาตรวจสอบข้อมูล</h5>
                        <ol></ol>
                    </div>
                </div>
            </div>
            <form method="post" id="frm_profile">
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">ชื่อหน่วยงาน</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="member_name" name="member_name" value="<?=$rsMember['member_name']?>" title="ชื่อโรงเรียน">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">ประเภทหน่วยงาน</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="member_type_id" id="member_type_id" title="ประเภทหน่วยงาน"required >
                             <option value=""> เลือกประเภทหน่วยงาน</option>
                                <?php foreach($rsType as $item){?>
                                    <option value="<?=$item['type_id']?>" <?=$rsMember['member_type_id']==$item['type_id']?'selected':''?>> <?=$item['type_name']?></option>
                                <?php }?>
                        </select>
                    </div>
                </div>
                <div id="member_type_id_div" style="<?=$rsMember['member_type_id']==7?'':'display:none;'?>">
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">รูปแบบการเก็บข้อมูล</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="member_dataset" id="member_dataset" title="รูปแบบการเก็บข้อมูล" required >
                            <option value=""> เลือกรูปแบบการเก็บข้อมูล </option>
                            <option value="Fiscal" <?=$rsMember['member_dataset']=="Fiscal"?'selected':''?>> ปีงบประมาณ (ต.ค. - ก.ย.)</option>
                            <option value="Year" <?=$rsMember['member_dataset']=="Year"?'selected':''?>> ปี พ.ศ. (ม.ค. - ธ.ค.)</option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">ที่อยู่</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="member_addr" rows="4"><?=$rsMember['member_addr']?></textarea>
                    </div>
                </div>
                
                <div class="form-group row mb-3">
                            <label for="member_name" class="col-sm-2 col-form-label">จังหวัด *</label>
                            <div class="col-sm-4">
                                <input type="hidden" name="member_province_id" value="38">
                                <input type="text" value="เชียงใหม่" readonly class="form-control">
                               
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="member_name" class="col-sm-2 col-form-label">อำเภอ *</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="member_amphur_id" id="member_amphur_id" title="อำเภอ"
                                    required >
                                    <?php foreach($rsAM as $item){?>
                <option value="<?=$item->AMPHUR_ID?>" <?=$rsMember['AMPHUR_ID']==$item->AMPHUR_ID?'selected':''?>> <?=$item->AMPHUR_NAME?></option>
            <?php }?>
                                  

                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="member_name" class="col-sm-2 col-form-label">ตำบล *</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="member_district_id" id="member_district_id"
                                    title="ตำบล" required >
                                    <option value="<?= $rsMember['member_district_id'] ?>" selected>
                                        <?= $rsMember['DISTRICT_NAME'] ?>
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="member_lat" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-9">
                                <div id="mapz" style="width:100%;height:300px;"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="member_lat" class="col-sm-2 col-form-label">พิกัด *</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="member_lat" name="member_lat"
                                    placeholder="ละติจูด" title="ละติจูด" required
                                    value="<?= $rsMember['member_lat'] ?>">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="member_lon" name="member_lon"
                                    placeholder="ลองจิจูด" title="ลองจิจูด" required
                                    value="<?= $rsMember['member_lon'] ?>">
                            </div>
                        </div>

                <div class="row mb-3">

                    <div class="col-sm-4 offset-sm-2">
                        <input type="hidden" name="member_id" value="<?=$rsMember['member_id']?>">
                        <input type="hidden" name="member_code" value="<?=$rsMember['member_code']?>">
                        <button type="submit" class="btn btn-primary"><i class='bx bx-save'></i>
                            บันทึกข้อมูล</button>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
