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
<style>
    #sp5 thead tr th {
        text-align: center !important;
        vertical-align: middle !important;
        padding: 10px 0;
        font-weight: normal;
    }

    #sp5 tbody tr td {
        text-align: center;
        vertical-align: middle !important;
        padding: 10px 5px;
    }

    #sp5 tbody tr td.number {
        text-align: right !important;
        vertical-align: middle !important;
    }
</style>
<div class="py-3">
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
                            <th class="align-middle"><input class="form-control" type="text" readonly
                                    value="<?= @$data_value["org_name"] ?>"></th>
                            <th class="align-middle">หน้าที่ </th>
                            <th class="align-middle">5</th>
                        </tr>
                        <tr>
                            <th class="align-middle">รหัสฟอร์ม</th>
                            <th class="align-middle">Fr-05</th>
                            <th class="align-middle">ผู้จัดทำ</th>
                            <th class="align-middle"><input class="form-control" type="text" readonly
                                    value="<?= @$data_value["org_author"] ?>"></th>
                            <th class="align-middle">วันที่จัดทำ</th>
                            <th class="align-middle"><input class="form-control" type="text" readonly
                                    value="<?= @$data_value["org_createdate"] ?>"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <?php
    $s1 = ceil($sum_total);
    $sGHG = ceil($sum_total1);
    $s2 = ceil($sum_total2);
    $s3 = ceil($sum_total3);
    $s1_2 = $s1 + $s2;
    $s1_3 = $s1 + $s2 + $s3;
    $sum_scope1_2 = ($s1_2 != 0 || $s1_2 != null) ? ($s1 * 100 / $s1_2) + ($s2 * 100 / $s1_2) : 0;
    $sum_scope1_3 = ($s1_3 != 0 || $s1_3 != null) ? ($s1 * 100 / $s1_3) + ($s2 * 100 / $s1_3) + ($s3 * 100 / $s1_3) : 0;
    ?>
    <div class="row">
        <div class="col-md-5">

            <table class="table table-bordered" id="sp5">
                <thead>
                    <tr class="bg-info">
                        <th style="background-color: #1b8b90;color:#fff" width="25%">ขอบเขต</th>
                        <th style="background-color: #685896;color:#fff" width="25%">การปล่อยก๊าซเรือนกระจกขององค์กร
                        </th>
                        <th style="background-color: #4c70b3;color:#fff" width="25%">สัดส่วนเมื่อเทียบขอบเขต 1 และ 2
                        </th>
                        <th style="background-color: #4c70b3;color:#fff" width="25%">สัดส่วนเมื่อเทียบขอบเขต 1, 2 และ 3
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #b1dbef;">ประเภท 1</td>
                        <td class="number">
                            <?= @number_format($s1) ?>
                        </td>
                        <td class="number">
                            <?= @number_format($s1 * 100 / $s1_2, 2) ?>
                        </td>
                        <td class="number">
                            <?= @number_format($s1 * 100 / $s1_3, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #b1dbef;">ประเภท 2</td>
                        <td class="number">
                            <?= @number_format($s2) ?>
                        </td>
                        <td class="number">
                            <?= @number_format($s2 * 100 / $s1_2, 2) ?>
                        </td>
                        <td class="number">
                            <?= @number_format($s2 * 100 / $s1_3, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #b1dbef;">ประเภท 3</td>
                        <td class="number">
                            <?= @number_format($s3) ?>
                        </td>
                        <td rowspan="2"></td>
                        <td class="number">
                            <?= @number_format($s3 * 100 / $s1_3, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #b1dbef;">อื่นๆ</td>
                        <td class="number">
                            <?= @number_format($sGHG) ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="background-color: #565d61;color:#fff">รวม Scope 1 & 2</td>
                        <td style="background-color: #959ca0;color:#fff" class="number">
                            <?= @number_format($s1 + $s2) ?>
                        </td>
                        <td style="background-color: #959ca0;color:#fff" class="number" rowspan="2">
                            <?= @number_format($sum_scope1_2, 2) ?>
                        </td>
                        <td style="background-color: #959ca0;color:#fff" class="number" rowspan="2">
                            <?= @number_format($sum_scope1_3, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #565d61;color:#fff">รวม Scope 1 - 3</td>
                        <td style="background-color: #959ca0;color:#fff" class="number">
                            <?= @number_format($s1 + $s2 + $s3) ?>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col-md-7"></div>
    </div>
</div>