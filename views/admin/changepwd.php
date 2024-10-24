<?php $admin = $this->session->userdata('admin_logged_in'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">เปลี่ยนรหัสผ่าน</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="bx bx-home-alt"></i></a>
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
                        <h5 class="text-body">กรุณาตรวจสอบข้อมูล</h5>
                        <ol></ol>
                    </div>
                </div>
            </div>
            <form method="post" id="frm_changepwd">
                <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label">ชื่อผู้ใช้</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?= $admin['username'] ?>" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="displayname" class="col-sm-3 col-form-label">ชื่อที่แสดง</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="displayname" name="displayname"
                            value="<?= $admin['displayname'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="displayname" class="col-sm-3 col-form-label">รหัสผ่าน</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="o_password" name="o_password" required
                            title="รหัสผ่าน">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="displayname" class="col-sm-3 col-form-label">รหัสผ่านใหม่</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="n_password" name="n_password" required
                            title="รหัสผ่านใหม่">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="displayname" class="col-sm-3 col-form-label">ยืนยันรหัสผ่าน</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="c_password" name="c_password" required
                            title="ยืนยันรหัสผ่าน">
                    </div>
                </div>
                <div class="row mb-3">

                    <div class="col-sm-4 offset-sm-3">
                        <button type="submit" class="btn btn-primary"><i class='bx bx-save'></i>
                            บันทึกข้อมูล</button>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>