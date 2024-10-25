<?php $admin = $this->session->userdata('admin_logged_in'); ?>
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
    <a href="<?=base_url('dashboard/faculty/add')?>" class="btn btn-sm btn-info me-2"><i class='bx bx-plus' ></i>เพิ่มคณะ</a>
	</div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อคณะ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>วันที่สร้าง</th>
                    <th>ใช้งานล่าสุด</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;foreach($rsList as $item){?>
                    <tr>
                        <td><?=++$i?></td>
                        <td><?=$item['faculty_name']?></td>
                        <td><?=$item['faculty_username']?></td>
                        <td><?=$item['createdate']?></td>
                        <td><?=$item['logindate']!=null ? $item['logindate']:'-'?></td>
                        <td>
                            <a href="/dashboard/faculty/edit/<?=$item['faculty_code']?>" class="btn btn-sm btn-info ms-1"><i class="bx bx-edit"></i>แก้ไข</a>
                            <a onclick="return confirm('คุณต้องการลบใช่หรือไม่');" href="/dashboard/faculty/del/<?=$item['faculty_code']?>" class="btn btn-sm btn-warning ms-1"><i class="bx bx-trash"></i>ลบ</a>
                      </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        
    </div>
</div>