<?php $admin = $this->session->userdata('admin_logged_in'); ?>
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
    <a href="<?=base_url('admin/myear/add')?>" class="btn btn-sm btn-info me-2"><i class='bx bx-plus' ></i> เพิ่มปี พ.ศ.</a>
	</div>
</div>

<div class="card">
    <div class="card-body">
        
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ปีงบประมาณ</th>
                    <th>รายละเอียด</th>
                    <th>สถานะ</th>
                    <th>เลือกเป็นปีหลัก</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;foreach($rsList as $item){?>
                    <tr>
                        <td><?=++$i?>. </td>
                        <td><?=$item->year_value?></td>
                        <td><?=$item->year_name?></td>
                        <td><?=$item->isshow==1? "<span class='text-success'><i class='bx bxs-check-circle'></i></span>":''?></td>
                        <td><?=$item->active==1? "<span class='text-success'><i class='bx bxs-check-circle'></i></span>":''?></td>
                        <td>
                            <a href="/admin/ef/edit/<?=$item->year_value?>" class="btn btn-sm btn-primary ms-1"><i class="bx bx-data"></i>กำหนดขอบเขต</a>
                            <a href="/admin/myear/edit/<?=$item->year_value?>" class="btn btn-sm btn-info ms-1"><i class="bx bx-edit"></i>แก้ไข</a>
                            <a onclick="return confirm('คุณต้องการลบใช่หรือไม่');" href="/admin/myear/edit/<?=$item->year_value?>" class="btn btn-sm btn-warning ms-1"><i class="bx bx-trash"></i>ลบ</a>

                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        


    </div>
</div>