<?php
$data_value = array();
$data_config = array();
if ($rsGovermentFr != null) {
    $data = json_decode(@$rsGovermentFr[0]->fr_detail);
    $data2 = json_decode(@$rsGovermentFr[0]->fr_config);
    $data_config = (array) @$data2;
    $data_value = (array) @$data;
}
?>
<div class="py-3">
    <form method="post" enctype="multipart/form-data"
        action="<?= base_url('dashboard/fr/' . $this->uri->segment(3)) ?>">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="table-responsive mb-3">
                    <table class="table table-bordered fr-form">
                        <thead class="text-center frmtable">
                            <tr>
                                <th rowspan="3" class="align-middle">
                                    <div id="pw_gov_logo">
                                        <?php if (@$data_value["org_logo"] != null) { ?>
                                            <img src="<?= base_url() ?>uploads/files/<?= @$data_value["org_logo"] ?>"
                                                class="img-fluid" width="80">
                                        <?php } ?>

                                    </div><br />
                                    <a class="btn btn-secondary btn-sm " style="position:relative;" href="javascript:;">
                                        <i class="bx bx-upload"></i>
                                        <input type="file" name="org_logo" id="org_logo"
                                            style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;"
                                            size="40" class="error">
                                        <input type="hidden" name="h_org_logo" value="<?= @$data_value["org_logo"] ?>">
                                    </a>
                                </th>
                                <th colspan="4" class="align-middle frmbox2">รายละเอียดขององค์กร</th>
                                <th colspan="2" class="align-middle frmbox2">TCFO_R_01<br />Version 01 : 31/8/2013</th>
                            </tr>
                            <tr>
                                <th class="align-middle">ชื่อฟอร์ม</th>
                                <th class="align-middle">บัญชีรายการก๊าซเรือนกระจก</th>
                                <th class="align-middle">องค์กร</th>
                                <th class="align-middle"><input class="form-control" type="text" readonly value="<?= @$data_value["org_name"] ?>"></th>
                                <th class="align-middle">หน้าที่ </th>
                                <th class="align-middle">2</th>
                            </tr>
                            <tr>
                                <th class="align-middle">รหัสฟอร์ม</th>
                                <th class="align-middle">Fr-02</th>
                                <th class="align-middle">ผู้จัดทำ</th>
                                <th class="align-middle"><input class="form-control" type="text" readonly value="<?= @$data_value["org_author"] ?>"></th>
                                <th class="align-middle">วันที่จัดทำ</th>
                                <th class="align-middle"><input class="form-control" type="text" readonly value="<?= @$data_value["org_createdate"] ?>"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                                            <p class="text-primary"><i>แผนผังแสดงขอบเขตขององค์กร</i></p>
                
                <form method="post" enctype="multipart/form-data"
                    action="<?= base_url('dashboard/fr/' . $this->uri->segment(3)) ?>">
                    <div id="img-blueprint" class="mb-3">
                            <?php if (@$rsGovermentFr[0]->org_blueprint != null) { ?>
                                <br /><img src="/uploads/files/<?= @$rsGovermentFr[0]->org_blueprint ?>" class="img-fluid">
                            <?php } ?>
                        </div>
                    <div class="form-group mb-3">
                        <a class="btn btn-secondary btn-sm" style="position:relative;" href="javascript:;"><i
                                class="bx bx-upload"></i><input type="file" name="org_blueprint"
                                style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;"
                                size="40" onchange="$(&quot;#img-blueprint&quot;).html($(this).val());" class="error">
                            เลือกไฟล์</a><br />
                        
                    </div>
                    <div class="line"></div>
                    <div class="form-group mb-3">
                        <input type="hidden" name="fr_year_value" value="<?= $this->uri->segment(3) ?>">
                        <input type="hidden" name="fr_no" value="2">
                        <button class="btn btn-primary" type="submit"><i class="bx bx-data"></i>
                            บันทึก</button>
                    </div>

                </form>
            </div>
        </div>
    </form>
</div>