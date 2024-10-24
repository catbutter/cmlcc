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
    <form method="post" enctype="multipart/form-data" action="<?= base_url('dashboard/fr/' . $this->uri->segment(3)) ?>">
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
                                <th class="align-middle"><input class="form-control" type="text" name="org_name"
                                        value="<?= @$data_value["org_name"] ?>" required></th>
                                <th class="align-middle">หน้าที่ </th>
                                <th class="align-middle">1</th>
                            </tr>
                            <tr>
                                <th class="align-middle">รหัสฟอร์ม</th>
                                <th class="align-middle">Fr-01</th>
                                <th class="align-middle">ผู้จัดทำ</th>
                                <th class="align-middle"><input class="form-control" type="text" name="org_author"
                                        value="<?= @$data_value["org_author"] ?>"></th>
                                <th class="align-middle">วันที่จัดทำ</th>
                                <th class="align-middle"><input class="form-control text-center" type="text"
                                        style="min-width:120px;" name="org_createdate"
                                        value="<?= @$data_value["org_createdate"] ?>"
                                        placeholder="ตย. 01/04/<?= $this->uri->segment(3) ?>"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <div class="gov_img">
                    <div id="pw_gov_image">
                        <?php if (@$data_value["org_image"] != null) { ?>
                            <img src="<?= base_url() ?>uploads/files/<?= @$data_value["org_image"] ?>" class="img-fluid">
                        <?php } else { ?>
                            <img src="https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg" class="img-fluid">
                        <?php } ?>
                    </div>
                    <a class="btn btn-secondary btn-sm gov_img_a" href="javascript:;">
                        <i class="bx bx-upload"></i>
                        <input type="file" name="org_image" id="org_image"
                            style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;"
                            size="40" class="error">
                        <input type="hidden" name="h_org_image" value="<?= @$data_value["org_image"] ?>">
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <table class="table table-bordered fr-form">
                    <tbody class="frmtable">
                    <tr class="frmbox2">
                        <td class="align-middle" colspan="2"><span class="p-2">ขอบเขตขององค์กร</span></td>
                    </tr>
                    <tr>
                        <td class="align-middle" style="width:150px;"><span class="p-2">ประเภท 1</span></td>
                        <td><input class="form-control" type="text" name="org_scope_1" value="<?=@$data_value["org_scope_1"]?>"></td>
                    </tr>
                    <tr>
                        <td class="align-middle" style="width:150px;"><span class="p-2">ประเภท 2</span></td>
                        <td><input class="form-control" type="text" name="org_scope_2" value="<?=@$data_value["org_scope_2"]?>"></td>
                    </tr>
                    <tr>
                        <td class="align-middle" style="width:150px;"><span class="p-2">ประเภท 3</span></td>
                        <td><input class="form-control" type="text" name="org_scope_3" value="<?=@$data_value["org_scope_3"]?>"></td>
                    </tr>
                    <tr>
                        <td class="align-middle" style="width:150px;"><span class="p-2">ระยะเวลาเก็บข้อมูล</span></td>
                        <td><input class="form-control" type="text" name="org_scope_period_date" value="<?=@$data_value["org_scope_period_date"]?>"></td>
                    </tr>			
                    </tbody>
                </table>
                
                <table class="table table-bordered fr-form">
                    <tbody class="frmtable">
                    <tr class="frmbox2">
                        <td class="align-middle" colspan="2"><span class="p-2">ข้อมูลองค์กร</span></td>
                    </tr>
                    <tr>
                        <td class="align-middle text-center" width="10">1.</td>
                        <td class="align-middle"><input class="form-control" type="text" name="org_data_1" value="<?=@$data_value["org_data_1"]?>"></td>
                    </tr>
                    <tr>
                        <td class="align-middle text-center">2.</td>
                        <td class="align-middle"><input class="form-control" type="text" name="org_data_2" value="<?=@$data_value["org_data_2"]?>"></td>
                    </tr>
                    <tr>
                        <td class="align-middle text-center">3.</td>
                        <td class="align-middle"><input class="form-control" type="text" name="org_data_3" value="<?=@$data_value["org_data_3"]?>"></td>
                    </tr>
                    <tr>
                        <td class="align-middle text-center">4.</td>
                        <td class="align-middle"><input class="form-control" type="text" name="org_data_4" value="<?=@$data_value["org_data_4"]?>"></td>
                    </tr>
                    <tr>
                        <td class="align-middle text-center">5.</td>
                        <td class="align-middle"><input class="form-control" type="text" name="org_data_5" value="<?=@$data_value["org_data_5"]?>"></td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered fr-form">
                    <tbody class="frmtable">
                    <tr>
                        <td class="align-middle" style="width:150px;"><span class="p-2">สถานที่ติดต่อ</span></td>
                        <td class="align-middle"><input class="form-control" type="text" name="org_data_addr" value="<?=@$data_value["org_data_addr"]?>"></td>
                    </tr>
                    <tr>
                        <td class="align-middle"><span class="p-2">วันขอขึ้นทะเบียน</span></td>
                        <td class="align-middle"><input class="form-control" type="text" name="org_date_regist_date" value="<?=@$data_value["org_date_regist_date"]?>" placeholder="ตย. 01/04/<?=$this->uri->segment(3)?>"></td>
                    </tr>
                    </tbody>
                </table>
                <input type="hidden" name="fr_year_value" value="<?=$this->uri->segment(3)?>">
                <input type="hidden" name="fr_no" value="1">
                <button type="submit" class="btn btn-sm btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
            <h5 class="mt-3 text-center" style="background-color: #e84116;color: #fff;padding: 5px;">การแสดงเครื่องหมาย</h5>
                <p class="text-center p-5"><img src="/uploads/cfo.png" style="max-width:200px;"></p>
            </div>
            <div class="col-md-6">
            <h5 class="mt-3 text-center" style="background-color: #e84116;color: #fff;padding: 5px;">กราฟแท่งแสดงการปล่อย GHG แต่ละขอบเขต</h5>
                <div id="sp2_container" style="width:100%;height:350px;"></div>
            </div>
        </div>
    </form>
</div>
<script>
    $(function () {
        var preview = $("#pw_gov_logo");
        $("#org_logo").change(function (event) {
            var input = $(event.currentTarget);
            var file = input[0].files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                image_base64 = e.target.result;
                preview.html("<img src='" + image_base64 + "' style='width:80px;padding:5px;'/><br/>");
            };
            reader.readAsDataURL(file);
        });

        var preview2 = $("#pw_gov_image");
        $("#org_image").change(function (event) {
            var input = $(event.currentTarget);
            var file = input[0].files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                image_base64 = e.target.result;
                preview2.html("<img src='" + image_base64 + "' style='max-width:100%;padding:5px;'/><br/>");
            };
            reader.readAsDataURL(file);
        });
    });
</script>