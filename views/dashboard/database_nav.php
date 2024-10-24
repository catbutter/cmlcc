<div class="card">
    <div class="card-body">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
            <div class="container-fluid"> <a class="navbar-brand" href="#">ข้อมูลปี พ.ศ. <?=$this->uri->segment(3)?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
                    aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard/database/') ?>"><i class='bx bx-home bx-tada me-1' ></i>หน้าหลัก</a></li>
                        <li class="nav-item"><a class="nav-link <?=$this->uri->segment(2)=="info"?'active':''?>" href="<?= base_url('dashboard/info/' . $this->uri->segment(3)) ?>"><i class='bx bx-info-circle me-1'></i>ข้อมูลทั่วไป</a></li>
                        <li class="nav-item"><a class="nav-link <?=$this->uri->segment(2)=="submit"?'active':''?>" href="<?= base_url('dashboard/submit/' . $this->uri->segment(3)) ?>"><i class='bx bx-data bx-tada me-1' ></i>ฐานข้อมูล</a></li>
                        <li class="nav-item"><a class="nav-link <?=$this->uri->segment(2)=="fr"?'active':''?>" href="<?= base_url('dashboard/fr/' . $this->uri->segment(3)) ?>"><i class='bx bx-stats bx-tada me-1' ></i></i>บัญชีรายการ</a></li>
                        <li class="nav-item"><a class="nav-link <?=$this->uri->segment(2)=="report"?'active':''?>" href="<?= base_url('dashboard/report/' . $this->uri->segment(3)) ?>"><i class='bx bxs-report bx-tada me-1' ></i></i>รายงาน</a></li>
                        <li class="nav-item"><a class="nav-link <?=$this->uri->segment(2)=="verify"?'active':''?>" href="<?= base_url('dashboard/verify/' . $this->uri->segment(3)) ?>"><i class='bx bx-package bx-tada me-1' ></i>การทวนสอบ</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#"><i class='bx bx-line-chart-down bx-tada me-1' ></i>เป้าหมาย NetZero</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class='bx bxs-alarm-snooze bx-tada me-1' ></i>กิจกรรมการลด</a></li> -->

                    </ul>

                </div>
            </div>
        </nav>
    </div>
</div>