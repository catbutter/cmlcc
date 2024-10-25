<?php $admin = $this->session->userdata('admin_logged_in'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">หน่วยงาน</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">หน่วยงาน</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>#</th>
                    <th>ชื่อหน่วยงาน</th>
                    <th>ประเภทหน่วยงาน</th>
                    <th width="120">ฐานข้อมูล</th>
                    <th width="120">เป้าหมาย</th>
                    <th width="120">กิจกรรมลด</th>
                    <th>สถานะ</th>
                    <th width="180">วันที่สมัคร</th>
                    <th width="180"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;foreach($rsList as $item){?>
                    <tr>
                        <td><?=++$i;?></td>
                        <td><?=$item['member_name']?></td>
                        <td><?=$item['type_name']?></td>
                        <td class="text-center"><span class='text-mute'><i class='bx bx-x'></i></span></td>
                        <td class="text-center"><span class='text-mute'><i class='bx bx-x'></i></span></td>
                        <td class="text-center"><span class='text-mute'><i class='bx bx-x'></i></span></td>
                        <td class="text-center"><?=$item['status']==1?"<span class='text-success'><i class='bx bxs-check-circle'></i> Approve</span>":"<span class='text-warning'><i class='bx bx-stop-circle' ></i> Waiting</span>"?></td>
                        <td class="text-center"><?=$item['createdate']?></td>
                        <td class="text-end">
                            <a href="/admin/member/edit/<?=$item['member_id']?>" class="btn btn-sm btn-info ms-1"><i class="bx bx-edit"></i>แก้ไข</a>
                            <a onclick="return confirm('คุณต้องการลบใช่หรือไม่');" href="/admin/member/edit/<?=$item['member_id']?>" class="btn btn-sm btn-warning ms-1"><i class="bx bx-trash"></i>ลบ</a>


                        </td>
                    </tr>
                <?php }?>
            </tbody>

        </table>

        
    </div>
</div>