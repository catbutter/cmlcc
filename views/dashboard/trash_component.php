<?php 
	$trash_proportion = explode(",",$trash_component[0]->trash_proportion);
	$trash_doc = explode(",",$trash_component[0]->trash_doc);
?>
<tr class="frmbox">
        <td colspan="19">
            <form method="post" enctype="multipart/form-data">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr class="table-light">
                                <th width="50">
                                    <a href="javascript:void(0)" class="btn btn-danger btn-del" style="margin-bottom: 5px;"><i class="bx bx-trash"></i></a>
                                </th>
                                <th width="150" class="text-left">วิธีการจัดการขยะ</th>
                                <th style="width: 250px;" colspan="3">
                                    <select class="form-control" name="submit_value[val_type]" required="" style="width: 300px;">
                                        <option value="">เลือกวิธีการจัดการขยะ</option>
                                        <option value="1">การจัดการของเสียด้วยวิธีการเทกองลึก > 5 m.</option>
                                        <option value="2">การจัดการของเสียด้วยวิธีการเทกองลึก &lt; 5 m.</option>
                                        <option value="3">การจัดการของเสียด้วยวิธีการฝังกลบ</option>
                                        <option value="4">การจัดการของเสียด้วยวิธีการไหม้ (เตาเผา)</option>
                                        <option value="5">การจัดการของเสียด้วยวิธีการไหม้ (เผาเทกอง)</option>
                                        <option value="6">การจัดการของเสียด้วยวิธีการทางชีวภาพ (Composting)</option>
                                        <option value="7">การจัดการของเสียด้วยวิธีการทางชีวภาพ (Anaerobic digestion) </option>
                                        <option value="8">การจัดการของเสียด้วยวิธีการฝังกลบโดยนำก๊าซมีเทนที่ได้ไปผลิตไฟฟ้า </option>
                                        <option value="9">การจัดการขยะด้วยวิธีการ RDF และเผาในเตาเผา </option>
                                        <option value="10">การจัดการขยะด้วยวิธีการทำ Biogas โดยนำก๊าซมีเทนที่ได้ไปผลิตไฟฟ้า </option>
                                    </select>
                                </th>
                                <th colspan="16"></th>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                                <th class="text-center" colspan="2" style="width: 100px;">ปี พ.ศ.</th>
                                <th class="text-center">ปริมาณขยะ</th>
                                <th class="text-center"><input type="text" class="form-control" name="submit_value[trash_info]" value="" /></th>
                                <th class="text-center">(ตัน/ปี)</th>
                                <th colspan="12"></th>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <th class="text-start" colspan="17">
                                    <button type="button" class="btn btn-info btnAddtrash" style="margin-bottom: 5px;"><i class="bx bx-plus"></i></button>
                                </th>
                            </tr>
                            <tr>
                                <th width="50"></th>
                                <th width="150" class="text-left">องค์ประกอบขยะ</th>
                                <th style="width: 250px; text-align: left;" colspan="3">
                                    <label class="radio-inline" style="margin: 0;"> <input type="radio" name="submit_value[trash_type]" value="1" /> มี</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline" style="margin: 0;"> <input type="radio" name="submit_value[trash_type]" value="0" checked="" /> ไม่มี</label>
                                </th>
                                <th colspan="14"></th>
                            </tr>
                            <tr class="table-secondary">
                                <th width="50"></th>
                                <th width="150" class="text-left" colspa="4"></th>
                                <th width="80">หน่วย</th>
                                <th>เศษอาหาร</th>
                                <th>กระดาษ</th>
                                <th>พลาสติก</th>
                                <th>แก้ว</th>
                                <th>โลหะ</th>
                                <th>ยาง/หนัง</th>
                                <th>ผ้า</th>
                                <th>ไม้/ใบไม้</th>
                                <th>หิน/กระเบื้อง</th>
                                <th>อื่นๆ</th>
                                <th colspan="4"></th>
                            </tr>
                            <tr>
                                <th width="50"></th>
                                <th width="150" class="text-left" colspa="4">สัดส่วน</th>
                                <th>%</th>

				<?php foreach($trash_proportion as $kk=>$vv){?>
                                <td><input type="number" step="0.0001" style="width:100px" name="submit_value[value_proportion_<?=($kk+1)?>]" class="form-control text-right" value="<?=$vv?>" /></td>
				<?php }?>
                                
                                <th colspan="4"></th>
                            </tr>
                            <tr>
                                <th width="50"></th>
                                <th width="150" class="text-left" colspa="4">doc<sub>i</sub></th>
                                <th>% Wet</th>
				<?php foreach($trash_doc as $k=>$v){?>
                                <td><input type="number" step="0.0001" style="width:100px" name="submit_value[value_doc_<?=($k+1)?>]" class="form-control text-right" value="<?=$v?>" /></td>
<?php }?>
                                
                                <th colspan="4"></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-right" colspan="2">ไฟล์หลักฐาน :</td>
                                <td colspan="2">
                                    <div style="width: 200px;">
                                        <a class="btn btn-secondary" style="position: relative;" href="javascript:;">
                                            <i class="bx bx-upload"></i>
                                            <input
                                                type="file"
                                                name="submit_file"
                                                style="
                                                    position: absolute;
                                                    z-index: 2;
                                                    top: 0;
                                                    left: 0;
                                                    filter: alpha(opacity=0);
                                                    width: 40px;
                                                    -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)';
                                                    opacity: 0;
                                                    background-color: transparent;
                                                    color: transparent;
                                                "
                                                size="40"
                                                onchange='$("#submit_file_temp").html($(this).val());'
                                                class="error"
                                            />
                                        </a>
                                        <span id="submit_file_temp"></span>
                                    </div>
                                </td>
                                <td colspan="14"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="16" class="text-left">
                                    <input type="hidden" name="submit_scope_id" value="<?=$sub?>" /> <input type="hidden" name="submit_tab" value="1" /> <input type="hidden" name="submit_id" />
                                    <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </td>
    </tr>
