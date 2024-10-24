<?php $this->load->view('dashboard/database_nav'); ?>
<style>
    input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	  -webkit-appearance: none; 
	  margin: 0; 
	}
	input[type=number] {
		-moz-appearance:textfield; /* Firefox */
	}
	.NonWarp{
		white-space: nowrap;
	}
    .form-control{
        padding: .175rem .55rem;
        color:#333;
        font-size:12px;
    }
    .gov_table th {
  text-align: center;
}
.gov_table th {
  padding: 5px;
  vertical-align: middle;
  border-top: 1px solid #dee2e6;
}
input:read-only {
  background-color: #eee;
}

.frmbox2 {
  background-color:rgb(193, 193, 193);
  color: #333;
}
.gov_table th {
  text-align: center;
}
.gov_table td{
  padding: 5px;
  vertical-align: middle;
  border-top: 1px solid #dee2e6;
}
.frmtable {
  background-color: rgb(255, 255, 255);
}
</style>

<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-12">
                <h4>บันทึกข้อมูลก๊าซเรือนกระจกองค์กร</h4>
            </div>
        </div>
        <div class="line"></div>


        <?php
        $ar_tree =array('','ชนิดต้นไม้', 'สถานที่ปลูก' , 'ปีที่ปลูก', 'ความสูง<br/>(เมตร)', 'เส้นรอบวง<br/>(เซนติเมตร)', 'จำนวน<br/>(ต้น)', 'เส้นผ่านศูนย์กลาง<br/>(เซนติเมตร)', 'มวลชีวภาพของต้นไม้<br/>(kg/tree)');
        $chtab = @$this->input->get('tab');
        $addInput = array(1=>'btnAddInput',2=>'btnAddScope8',3=>'btnAddScope9',4=>'btnAddScope10',5=>'btnAddInput49',6=>'btnAddInput49',7=>'btnAddInput49',8=>'btnAddInput49',9=>'btnAddTree',10=>'btnAddInput',11=>'btnAddInput',12=>'btnAddInput',13=>'btnAddInput');
        ?>
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= $chtab == 1 ? 'active' : '' ?><?=$chtab==null?'active':''?>" data-bs-toggle="pill" href="#scope1" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class='bx bxs-hot font-18 me-1'></i>
                        </div>
                        <div class="tab-title">ขอบเขตที่ 1</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= $chtab == 2 ? 'active' : '' ?>" data-bs-toggle="pill" href="#scope2" role="tab"
                    aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class='bx bxs-bolt font-18 me-1' ></i>
                        </div>
                        <div class="tab-title">ขอบเขตที่ 2</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= $chtab == 3 ? 'active' : '' ?>" data-bs-toggle="pill" href="#scope3" role="tab"
                    aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class='bx bx-trash font-18 me-1'></i>
                        </div>
                        <div class="tab-title">ขอบเขตที่ 3</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?= $chtab == 4 ? 'active' : '' ?>" data-bs-toggle="pill" href="#scope4" role="tab"
                    aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class='bx bxs-tree font-18 me-1' ></i>
                        </div>
                        <div class="tab-title">ข้อมูลต้นไม้</div>
                    </div>
                </a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade <?= $chtab == 1 ? 'show active' : '' ?><?=$chtab==null?'show active':''?>" id="scope1" role="tabpanel">
                <?php $scope_tab=1;?>
			    <?php foreach($rsScope1 as $item){ ?>
					
                    <p class="scope-section"><?=$item["name"]?> </p>
										<div class="table-responsive mb-5">
											<table class="table gov_table">
												<?php foreach($item['list'] as $subKey=>$subItem){?>
													<tr>
														<td style="<?=$subKey==0?'border-top: 0;':''?>width:50px;"><button class="btn btn-info <?=$addInput[$subItem['scope_category']]?>" scope-data="<?=$subItem["scope_id"]?>" scope-unit="<?=$subItem["scope_unit"]?>" scope-year="<?=substr($this->uri->segment(3),-2)?>" scope-tab=<?=$scope_tab?>><i class="bx bx-plus"></i></button></td>
														<td style="<?=$subKey==0?'border-top: 0;':''?>" colspan="18" class="align-middle"><?=$subItem["scope_name"]?></td>
													</tr>
													<?php if($subItem['scope_category']==1||$subItem['scope_category']==10||$subItem['scope_category']==11||$subItem['scope_category']==12||$subItem['scope_category']==13){ ?>
														<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
															<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){ ?>
																<?php 
																$data = json_decode(@$submitValue->submit_detail);
																$data_value = (array) @$data;
																?>
																<?php if($frow==0){$frow++;?>
																	<tr class="frmbox2">
																		<th width="50"></th>
																		<th>แหล่งการปล่อย</th>
																		<th>หน่วย</th>
																		<th>รวม</th>
																		<?php for($mloop=1; $mloop<=12; $mloop++){?>
																			<?php 
																				$shw_year = substr($this->uri->segment(3),-2);
																				if($mloop<4){
																					$shw_year-=1;
																				}else{
																					$shw_year;
																				}
																			?>
																			<th class="text-center"><?=getGroupYear($mloop, $rsMember['member_dataset'])?> <?=$shw_year?></th>
																		<?php }?>
																		<th>ไฟล์หลักฐาน</th>
																		<th></th>
																	</tr>	
																<?php } ?>
																<form method="post" enctype="multipart/form-data">
																<tr class="frmtable">
																	<td><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></td>
																	<td>
																		<input type="text" name="submit_name" autocomplete="off" required="" value="<?=$submitValue->submit_name?>" style="width:150px;" class="form-control">
																	</td>
																	<td class="text-center align-middle NonWarp"><?=$subItem["scope_unit"]?></td>
																	<td>
																		<?php $s_total=0;for($mloop=1; $mloop<=12; $mloop++){?>
																			<?php if(@$data_value["value_".$mloop]){?>
																				<?php $s_total+=@$data_value["value_".$mloop];?>
																			<?php }?>
																		<?php }?>
																		<input type="text" readonly style="width:80px;" class="form-control text-end" value="<?=number_format($s_total,4)?>">
																	</td>
																	<?php for($mloop=1; $mloop<=12; $mloop++){?>
																		<td>
																			<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_".$mloop]?>">
																		</td>
																		<?php if(@$data_value["value_".$mloop]){?>
																			<?php $s_total+=@$data_value["value_".$mloop];?>
																		<?php }?>
																	<?php }?>
																	<td>
																		<div style="width:120px;">
																		<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a>
																		<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																		</div>
																	</td>
																	<td>
																		<input type="hidden" name="submit_scope_id" value="<?=$submitValue->submit_scope_id?>">
																		<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																		<input type="hidden" name="submit_tab" value="1">
																		<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึก</button>
																	</td>
																</tr>
																</form>
															<?php } ?>			
														<?php }?>
													<?php }?>
													<?php if($subItem['scope_category']==2){ ?>
														<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
															<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){?>
																<?php $data = json_decode(@$submitValue->submit_detail);$data_value = (array) @$data;?>
																<tr class="frmtable">
																	<td colspan="19">
															
																	<form method="post" enctype="multipart/form-data">
																		<div class="table-responsive"> 
																			<table class="table">
																				<tbody>
																					<tr class="frmbox2">
																						<th width="50"><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></td>
																						<th><input type="text" name="submit_name" value="<?=$submitValue->submit_name?>" required class="form-control text-left" style="width:150px;"></th>
																						<th>หน่วย</th>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<?php 
																								$shw_year = substr($this->uri->segment(3),-2);
																								if($mloop<4){
																									$shw_year-=1;
																								}else{
																									$shw_year;
																								}
																							?>
																							<th class="text-center"><?=getGroupYear($mloop, $rsMember['member_dataset'])?> <?=$shw_year?></th>
																						<?php }?>
																					</tr>
																					<tr>
																						<td></td>
																						<td>ปริมาณ </td>
																						<td>ลบ.ม./เดือน</td>
																						<?php 
																							$tow_total =0;	
																							$tow_mass =0;	
																							$tow_mass2 =0;	
																						?>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_mass_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_mass_".$mloop]?>">
																							</td>
																						<?php }?>
																					</tr>
																					<tr>
																						<td></td>
																						<td>ค่า BOD ขาเข้า </td>
																						<td>มก./ลิตร</td>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" name="submit_value[bod_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["bod_".$mloop]?>">
																							</td>
																						<?php $tow_mass = floatval($data_value["value_mass_".$mloop]);?>
																						<?php $tow_mass2 = floatval($data_value["bod_".$mloop]);?>
																						<?php $tow_total+=$tow_mass*$tow_mass2;}?>
																					</tr>
																					<tr>
																						<td></td>
																						<td>ประเภทระบบบำบัดฯ</td>
																						<td colspan="6">
																							<select class="form-control" name="submit_value[val_type]" required>
																								<option value="">เลือกประเภท</option>
																								<option value="1" <?=@$data_value["val_type"]==1?'selected':''?>>ปล่อยน้ำเสียลงสู่ทะเล แม่น้ำ บึง โดยตรง</option>
																								<option value="2" <?=@$data_value["val_type"]==2?'selected':''?>>บ่อปรับเสถียร (Stabilization Pond)</option>
																								<option value="3" <?=@$data_value["val_type"]==3?'selected':''?>>คลองวนเวียน (Oxidation Ditch)</option>
																								<option value="4" <?=@$data_value["val_type"]==4?'selected':''?>>บ่อเติมอากาศ (Aerated Lagoon)</option>
																								<option value="5" <?=@$data_value["val_type"]==5?'selected':''?>>ระบบตะกอนเร่ง (Activated Sludge)</option>
																								<option value="6" <?=@$data_value["val_type"]==6?'selected':''?>>ระบบตะกอนเร่งแบบปรับเสถียรสัมผัส (Contact Stabilization AS)</option>
																								<option value="7" <?=@$data_value["val_type"]==7?'selected':''?>>ระบบตะกอนเร่งแบบสองขั้นตอน (Two-Stage AS Process)</option>
																								<option value="8" <?=@$data_value["val_type"]==8?'selected':''?>>ระบบผสมระหว่างตัวกลางหมุนชีวภาพและตะกอนเร่ง (Combination of Fixed AS)</option>
																								<option value="9" <?=@$data_value["val_type"]==9?'selected':''?>>แผ่นจานหมุนชีวภาพ (Rotating Biological Contractor)</option>
																								<option value="10" <?=@$data_value["val_type"]==10?'selected':''?>>บึงประดิษฐ์ (Constructed Wetland)</option>
																								<option value="11" <?=@$data_value["val_type"]==11?'selected':''?>>บ่อกรองไร้อากาศ (Anaerobic filter)</option>
																								<option value="12" <?=@$data_value["val_type"]==12?'selected':''?>>บ่อเกรอะ (Septic Tank)</option>
																								<option value="13" <?=@$data_value["val_type"]==13?'selected':''?>>บ่อซึม (Latrine)</option>

																							</select>
																						</td>
																						<td class="text-end"><strong>kg CH<sub>4</sub> : </strong></td>
																						<td colspan="6"><input type="text" step="0.0001" readonly class="form-control" value="<?=calculateEF(getMCF_65($data_value["val_type"]),$tow_total/1000)?>"></td>
																					</tr>
																					<tr>
																						<td colspan="2"></td>
																						<td class="text-end" colspan="1">ไฟล์หลักฐาน :</td>
																						<td colspan="16">
																							<div style="width:100%;">
																							<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a>
																							<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																							</div>
																						</td>
																					</tr>
																					<tr>
																						<td colspan="3"></td>
																						<td colspan="15">
																							<input type="hidden" name="submit_scope_id" value="<?=$submitValue->submit_scope_id?>">
																							<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																							<input type="hidden" name="submit_tab" value="1">
																							<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</form>
																</tr>
																<?php }?>
														<?php }?>
													<?php }?>
													<?php if($subItem['scope_category']==3){ ?>
														<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
															<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){?>
																<?php $data = json_decode(@$submitValue->submit_detail);$data_value = (array) @$data;?>
																<tr class="frmtable">
																	<td colspan="19">
																	<form method="post" enctype="multipart/form-data">
																		<div class="table-responsive"> 
																			<table class="table">
																				<tbody>
																					<tr class="frmbox2">
																						<th width="50"><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></th>
																						<th colspan="3"><input type="text" name="submit_name" required class="form-control text-left" value="<?=$submitValue->submit_name?>" placeholder="ชื่อสำนักงาน/ศูนย์/โรงเรียน" style="min-width:150px;"></th>
																						<th><div style="width:100px;">หน่วย</div></th>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<?php 
																								$shw_year = substr($this->uri->segment(3),-2);
																								if($mloop<4){
																									$shw_year-=1;
																								}else{
																									$shw_year;
																								}
																							?>
																							<th class="text-center"><?=getGroupYear($mloop, $rsMember['member_dataset'])?> <?=$shw_year?></th>
																						<?php }?>
																						<th>รวม</th>
																					</tr>
																						
																					<tr>
																						<td></td>
																						<td colspan="3">
																							<select class="form-control" name="submit_value[val_type]" required>
																								<option value="">เลือกประเภท</option>
																								<option value="1" <?=@$data_value["val_type"]==1?'selected':''?>>จำนวนบุคลากร</option>
																								<option value="2" <?=@$data_value["val_type"]==2?'selected':''?>>จำนวนนักศึกษา</option>
																							</select>
																						</td>
																						<td class="text-center">คน</td>
																						<?php $sum_pop = 0;?>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_pop_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_pop_".$mloop]?>">
																							</td>
																							<?php $sum_pop += @floatval($data_value["value_pop_".$mloop]);?>
																						<?php }?>
																						<td><input type="text" readonly class="form-control text-end" style="width:80px;" value="<?=number_format($sum_pop,4)?>"></td>
																					</tr>
																					<tr>
																						<td></td>
																						<td colspan="3">วันทำงาน</td>
																						<td class="text-center">วัน</td>
																						<?php $sum_day = 0;?>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_day_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_day_".$mloop]?>">
																							</td>
																							<?php $sum_day += @floatval($data_value["value_day_".$mloop]);?>
																						<?php }?>
																						<td><input type="text" readonly class="form-control text-end" style="width:80px;" value="<?=number_format($sum_day,4)?>"></td>
																					</tr>
																					<tr>
																						<td></td>
																						<td colspan="3">TOW</td>
																						<td class="text-center">kg BOD</td>
																						<?php $sum_tow = 0;?>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" readonly class="form-control text-end" value="<?=number_format(floatval($data_value["value_pop_".$mloop])*18.3*0.001*1*floatval($data_value["value_day_".$mloop]),4)?>">
																							</td>
																							<?php $sum_tow += @floatval($data_value["value_pop_".$mloop])*18.3*0.001*1*@floatval($data_value["value_day_".$mloop]);?>
																						<?php }?>
																						<td><input type="text" readonly class="form-control text-end" style="width:80px;" value="<?=number_format($sum_tow,4)?>"></td>
																					</tr>
																					<tr>
																						<td></td>
																						<td colspan="3">Emission Factor</td>
																						<td class="text-center">kg CH<sub>4</sub> / kg BOD</td>
																						<?php $sum_bod = 0;?>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" readonly class="form-control text-end" value="<?=number_format(0.6*0.5,4)?>">
																							</td>
																							<?php $sum_bod += 0.6*0.5;?>
																						<?php }?>
																						<td><input type="text" readonly class="form-control text-end" style="width:80px;" value="<?=number_format($sum_bod,4)?>"></td>
																					</tr>
																					<tr>
																						<td></td>
																						<td colspan="3">ปริมาณการปล่อย CH<sub>4</sub></td>
																						<td class="text-center">กก. CH<sub>4</sub></td>
																						<?php $sum_ch = 0;?>
																						<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" readonly class="form-control text-end" value="<?=number_format(1*1*(floatval($data_value["value_pop_".$mloop])*18.3*0.001*1*floatval($data_value["value_day_".$mloop]))*(0.6*0.5),4)?>">
																							</td>
																							<?php $sum_ch += 1*1*(@floatval($data_value["value_pop_".$mloop])*18.3*0.001*1*@floatval($data_value["value_day_".$mloop]))*(0.6*0.5);?>
																						<?php }?>
																						<td><input type="text" readonly class="form-control text-end" style="width:80px;" value="<?=number_format($sum_ch,4)?>"></td>
																					</tr>
																					<tr>
																						<td colspan="4"></td>
																						<td class="text-end" colspan="1">ไฟล์หลักฐาน :</td>
																						<td colspan="14">
																							<div style="width:100%;">
																							<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a>
																							<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																							</div>
																						</td>
																					</tr>
																					<tr>
																						<td colspan="5"></td>
																						<td colspan="14">
																							<input type="hidden" name="submit_scope_id" value="<?=$submitValue->submit_scope_id?>">
																							<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																							<input type="hidden" name="submit_tab" value="1">
																							<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button>
																						</td>
																					</tr>
																					
																				</tbody>
																			</table>
																		</div>
																	</form>
																</td>
															</tr>
															<?php }?>
														<?php }?>
													<?php }?>
													<?php if($subItem['scope_category']==4){ ?>
														<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
															<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){?>
																<?php $data = json_decode(@$submitValue->submit_detail);$data_value = (array) @$data;?>
																<tr class="frmtable">
																	<td colspan="19">
																		<form method="post" enctype="multipart/form-data">
																			<div class="table-responsive"> 
																				<table class="table">
																					<tbody>
																						<tr class="frmbox2">
																							<th width="50"><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></th>
																							<th width="150" class="text-left">วิธีการจัดการขยะ</th>
																							<th style="width: 300px;" colspan="3">
																								<select class="form-control" name="submit_value[val_type]" required style="width:300px;">
																									<option value="">เลือกวิธีการจัดการขยะ</option>
																									<?php $list = $this->uri->segment(3)<2565?getTrashType():getTrashType2565();?>
																									<?php foreach($list as $k=>$v){?>
																										<option value="<?=$k?>" <?=@$data_value["val_type"]==$k?'selected':''?>><?=$v?></option>
																									<?php }?>
																								</select>
																							</th>
																							<th colspan="14"></th>
																						</tr>
																						<tr>
																							<th colspan="2"></th>
																							<th class="text-center" colspan="2" style="width: 100px;">ปี พ.ศ.</th>
																							<th class="text-center">ปริมาณขยะ</th> 
																							<th class="text-center">
																								<input type="text" class="form-control" name="submit_value[trash_info]" value="<?=$data_value["trash_info"]?>">
																							</th>
																							<th class="text-center">(ตัน/ปี)</th>
																							<th colspan="12"></th>
																						</tr>
																						<tr>
																							<td colspan="2"></td>
																							<th class="text-start" colspan="5"><button type="button" class="btn btn-info btnAddtrash" style=""><i class="bx bx-plus"></i></button></th>
																							<th colspan="12"></th>
																						</tr>
																						
																						<?php if(!empty($data_value["trash_year"])){asort($data_value["trash_year"]);?>
																							<?php foreach($data_value["trash_year"] as $k=>$item){?>
																							<tr class="">
																								<td colspan="2"></td>
																								<td class=" text-center"><a href="javascript:void(0)" class="btn btn-danger btn-del2" style=""><i class="bx bx-trash"></i></a></td>
																								<td >
																									<input type="number" class="form-control" step="0.0001" name="submit_value[trash_year][]" value="<?=$data_value["trash_year"][$k]?>">
																								</td>
																								<td colspan="3">
																									<input type="number" class="form-control" step="0.0001" name="submit_value[trash_value][]" value="<?=$data_value["trash_value"][$k]?>">
																								</td>
																								<td colspan="15"></td>
																							</tr>
																							<?php }?>
																						
																						<?php }?>

																						<tr>
																							<th width="50"></th>
																							<th width="150" class="text-left">องค์ประกอบขยะ</th>
																							<th style="width: 250px;text-align:left;" colspan="3">
																								<label class="radio-inline" style="margin:0;"><input type="radio" name="submit_value[trash_type]" value="1" <?=$data_value["trash_type"]==1?'checked':''?> <?=$data_value["trash_type"]==null?'checked':''?>> มี</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																								<label class="radio-inline" style="margin:0;"><input type="radio" name="submit_value[trash_type]" value="0" <?=$data_value["trash_type"]==0?'checked':''?>> ไม่มี</label>
																							</th>
																							<th colspan="14"></th>
																						</tr>
																						<tr class="frmbox2">
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
																							<?php $doc =0;?>
																							<?php for($mloop=1; $mloop<=10; $mloop++){?>
																								<td>
																									<input type="number" step="0.0001" name="submit_value[value_proportion_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_proportion_".$mloop]?>">
																								</td>
																							<?php }?>
																							<th colspan="4"></th>
																						</tr>
																						<tr>
																							<th width="50"></th>
																							<th width="150" class="text-left" colspa="4">doc<sub>i</sub></th>
																							<th>% Wet</th>
																							<?php for($mloop=1; $mloop<=10; $mloop++){?>
																								<td>
																									<input type="number" step="0.0001" name="submit_value[value_doc_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_doc_".$mloop]?>">
																								</td>
																							<?php $doc+=(@$data_value["value_proportion_".$mloop]*@$data_value["value_doc_".$mloop])/100;}?>
																							<th colspan="4"></th>
																						</tr>
																						<?php 
																							$doc = $doc/100;
																							$mcf = @getMCFTrash($data_value["val_type"]);
																							//calculateTrash($doc,$mcf,$data_value["trash_year"],$data_value["trash_value"]);	
																						?>
																						<tr>
																							<td></td>
																							<?php if(@$data_value["val_type"]<4){?>
																							<td colspan="2" class="text-end"><strong>CH<sub>4</sub> emission (kgCH<sub>4</sub>): </strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash($doc,$mcf,@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																							<?php }else if(@$data_value["val_type"]==4 || @$data_value["val_type"]==9){?>
																							<td colspan="2" class="text-end"><strong>C0<sub>2</sub> emission (kgCO<sub>2</sub>): </strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash4(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																							<?php }else if(@$data_value["val_type"]==5){?>
																							<td colspan="2" class="text-end"><strong>C0<sub>2</sub> emission (kgCO<sub>2</sub>): </strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash5(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																							<?php }else if(@$data_value["val_type"]==6){?>
																							<td colspan="2" class="text-end"><strong>CH<sub>4</sub> emission (kgCH<sub>4</sub>): </strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash6(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																							<?php }else if(@$data_value["val_type"]==7 || @$data_value["val_type"]==10){?>
																							<td colspan="2" class="text-end"><strong>CH<sub>4</sub> emission (kgCH<sub>4</sub>): </strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash7(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																							<?php }?>
																							<td colspan="14" class="text-left"></td>
																						</tr>
																						<?php if(@$data_value["val_type"]==6){?>
																						<tr>
																							<td></td>
																							<td colspan="2" class="text-end"><strong>N<sub>2</sub>O emission (kgN<sub>2</sub>O):</strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash8(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																							<td colspan="14" class="text-left"></td>
																						</tr>
																						<?php }else if(@$data_value["val_type"]==7){?>
																						<tr>
																							<td></td>
																							<td colspan="2" class="text-end"><strong>N<sub>2</sub>O emission (kgN<sub>2</sub>O):</strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrashAnaerobic(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																							<td colspan="14" class="text-left"></td>
																						</tr>
																						<?php }?>
																						<?php if(@$data_value["val_type"]==8){?>
																						<tr>
																							<td></td>
																							<td colspan="2" class="text-end"><strong>CH<sub>4</sub> emission (kgCH<sub>4</sub>): </strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash($doc,$mcf,@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																							<td colspan="14" class="text-left"></td>
																						</tr>
																						<tr>
																							<td></td>
																							<td colspan="2" class="text-end"><strong>CO<sub>2</sub> emission (kgCO<sub>2</sub>): </strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=number_format((rmComma(calculateTrash($doc,$mcf,@$data_value["trash_year"],@$data_value["trash_value"]))*44)/14,2)?>"></td>
																							<td colspan="14" class="text-left"></td>
																						</tr>
																						<?php }?>
																						<?php if(@$data_value["val_type"]==10){?>
																						<tr>
																							<td></td>
																							<td colspan="2" class="text-end"><strong>CO<sub>2</sub> emission (kgCO<sub>2</sub>): </strong></td>
																							<td colspan="2"><input type="text" readonly class="form-control" value="<?=number_format((rmComma(calculateTrash7(@$data_value["trash_year"],@$data_value["trash_value"]))*44)/14,2)?>"></td>
																							<td colspan="14" class="text-left"></td>
																						</tr>
																						<?php }?>
																						<tr>
																							<td></td>
																							<td colspan="2" class="text-end">ไฟล์หลักฐาน</td>
																							<td colspan="2">
																								<div style="width:120px;">
																								<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a>
																								<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																								</div>
																							</td>
																							<td colspan="14"></td>
																						</tr>
																						<tr>
																							<td colspan="3"></td>
																							<td colspan="16" class="text-left">
																								<input type="hidden" name="submit_scope_id" value="<?=$subItem["scope_id"]?>">
																								<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																								<input type="hidden" name="submit_tab" value="1">
																								<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button>
																							</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</form>
																	</td>
																</tr>
															<?php }?>
														<?php }?>
													<?php }?>
												<?php } ?>
											</table>
										</div>
                <?php }?>
                <?php foreach($rsScopeGHG as $item){ ?>
					<p class="scope-section2"><?=$item["name"]?> </p>
                   
										<div class="table-responsive mb-5">
											<table class="table gov_table">
												<?php foreach($item['list'] as $subKey=>$subItem){?>
													<tr>
														<td style="<?=$subKey==0?'border-top: 0;':''?>width:50px;"><button class="btn btn-info <?=$addInput[$subItem['scope_category']]?>" scope-data="<?=$subItem["scope_id"]?>" scope-unit="<?=$subItem["scope_unit"]?>" scope-year="<?=substr($this->uri->segment(3),-2)?>" scope-tab=<?=$scope_tab?>><i class="bx bx-plus"></i></button></td>
														<td style="<?=$subKey==0?'border-top: 0;':''?>" colspan="18" class="align-middle"><?=$subItem["scope_name"]?></td>
													</tr>
													<?php if($subItem['scope_category']==1||$subItem['scope_category']==10||$subItem['scope_category']==11||$subItem['scope_category']==12||$subItem['scope_category']==13){ ?>
														<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
															<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){ ?>
																<?php 
																$data = json_decode(@$submitValue->submit_detail);
																$data_value = (array) @$data;
																?>
																<?php if($frow==0){$frow++;?>
																	<tr class="frmbox2">
																		<th width="50"></th>
																		<th>แหล่งการปล่อย</th>
																		<th>หน่วย</th>
																		<th>รวม</th>
																		<?php for($mloop=1; $mloop<=12; $mloop++){?>
																			<?php 
																				$shw_year = substr($this->uri->segment(3),-2);
																				if($mloop<4){
																					$shw_year-=1;
																				}else{
																					$shw_year;
																				}
																			?>
																			<th class="text-center"><?=getGroupYear($mloop, $rsMember['member_dataset'])?> <?=$shw_year?></th>
																		<?php }?>
																		<th>ไฟล์หลักฐาน</th>
																		<th></th>
																	</tr>	
																<?php } ?>
																<form method="post" enctype="multipart/form-data">
																<tr class="frmtable">
																	<td><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></td>
																	<td>
																		<input type="text" name="submit_name" autocomplete="off" required="" value="<?=$submitValue->submit_name?>" style="width:150px;" class="form-control">
																	</td>
																	<td class="text-center align-middle NonWarp"><?=$subItem["scope_unit"]?></td>
																	<td>
																		<?php $s_total=0;for($mloop=1; $mloop<=12; $mloop++){?>
																			<?php if(@$data_value["value_".$mloop]){?>
																				<?php $s_total+=@$data_value["value_".$mloop];?>
																			<?php }?>
																		<?php }?>
																		<input type="text" readonly style="width:80px;" class="form-control text-end" value="<?=number_format($s_total,4)?>">
																	</td>
																	<?php for($mloop=1; $mloop<=12; $mloop++){?>
																		<td>
																			<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_".$mloop]?>">
																		</td>
																		<?php if(@$data_value["value_".$mloop]){?>
																			<?php $s_total+=@$data_value["value_".$mloop];?>
																		<?php }?>
																	<?php }?>
																	<td>
																		<div style="width:120px;">
																		<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a>
																		<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																		</div>
																	</td>
																	<td>
																		<input type="hidden" name="submit_scope_id" value="<?=$submitValue->submit_scope_id?>">
																		<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																		<input type="hidden" name="submit_tab" value="1">
																		<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึก</button>
																	</td>
																</tr>
																</form>
															<?php } ?>			
														<?php }?>
													<?php }?>
												<?php } ?>
											</table>
										</div>
                <?php }?>
			</div>
			<div class="tab-pane fade <?= $chtab == 2 ? 'show active' : '' ?>" id="scope2" role="tabpanel">
			    <?php $scope_tab=2;?>
			    <?php foreach($rsScope2 as $item){ ?>
					<p class="scope-section"><?=$item["name"]?> </p>
                    <div class="table-responsive mb-5">
											<table class="table gov_table">
												<?php foreach($item['list'] as $subKey=>$subItem){?>
													<tr>
														<td style="<?=$subKey==0?'border-top: 0;':''?>width:50px;"><button class="btn btn-info <?=$addInput[$subItem['scope_category']]?>" scope-data="<?=$subItem["scope_id"]?>" scope-unit="<?=$subItem["scope_unit"]?>" scope-year="<?=substr($this->uri->segment(3),-2)?>" scope-tab=<?=$scope_tab?>><i class="bx bx-plus"></i></button></td>
														<td style="<?=$subKey==0?'border-top: 0;':''?>" colspan="18" class="align-middle"><?=$subItem["scope_name"]?></td>
													</tr>
													<?php if($subItem['scope_category']==12){ ?>
														<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
															<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){ ?>
																<?php 
																$data = json_decode(@$submitValue->submit_detail);
																$data_value = (array) @$data;
																?>
																<?php if($frow==0){$frow++;?>
																	<tr class="frmbox2">
																		<th width="50"></th>
																		<th>แหล่งการปล่อย</th>
																		<th>หน่วย</th>
																		<th>รวม</th>
																		<?php for($mloop=1; $mloop<=12; $mloop++){?>
																			<?php 
																				$shw_year = substr($this->uri->segment(3),-2);
																				if($mloop<4){
																					$shw_year-=1;
																				}else{
																					$shw_year;
																				}
																			?>
																			<th class="text-center"><?=getGroupYear($mloop, $rsMember['member_dataset'])?> <?=$shw_year?></th>
																		<?php }?>
																		<th>ไฟล์หลักฐาน</th>
																		<th></th>
																	</tr>	
																<?php } ?>
																<form method="post" enctype="multipart/form-data">
																<tr class="frmtable">
																	<td><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></td>
																	<td>
																		<input type="text" name="submit_name" autocomplete="off" required="" value="<?=$submitValue->submit_name?>" style="width:150px;" class="form-control">
																	</td>
																	<td class="text-center align-middle NonWarp"><?=$subItem["scope_unit"]?></td>
																	<td>
																		<?php $s_total=0;for($mloop=1; $mloop<=12; $mloop++){?>
																			<?php if(@$data_value["value_".$mloop]){?>
																				<?php $s_total+=@$data_value["value_".$mloop];?>
																			<?php }?>
																		<?php }?>
																		<input type="text" readonly style="width:80px;" class="form-control text-end" value="<?=number_format($s_total,4)?>">
																	</td>
																	<?php for($mloop=1; $mloop<=12; $mloop++){?>
																		<td>
																			<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_".$mloop]?>">
																		</td>
																		<?php if(@$data_value["value_".$mloop]){?>
																			<?php $s_total+=@$data_value["value_".$mloop];?>
																		<?php }?>
																	<?php }?>
																	<td>
																		<div style="width:120px;">
																		<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a>
																		<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																		</div>
																	</td>
																	<td>
																		<input type="hidden" name="submit_scope_id" value="<?=$submitValue->submit_scope_id?>">
																		<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																		<input type="hidden" name="submit_tab" value="2">
																		<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึก</button>
																	</td>
																</tr>
																</form>
															<?php } ?>			
														<?php }?>
													<?php }?>
												<?php } ?>
											</table>
										</div>
                <?php }?>
			</div>
			<div class="tab-pane fade <?= $chtab == 3 ? 'show active' : '' ?>" id="scope3" role="tabpanel">
			    <?php $scope_tab=3;?>
			    <?php foreach($rsScope3 as $item){ ?>
					<p class="scope-section"><?=$item["name"]?> </p>
                    <div class="table-responsive mb-5">
											<table class="table gov_table">
												<?php foreach($item['list'] as $subKey=>$subItem){?>
													<?php if($subItem['scope_category']==4||$subItem['scope_category']==12){ ?>
														<tr>
															<td style="<?=$subKey==0?'border-top: 0;':''?>width:50px;"><button class="btn btn-info <?=$addInput[$subItem['scope_category']]?>" scope-data="<?=$subItem["scope_id"]?>" scope-unit="<?=$subItem["scope_unit"]?>" scope-year="<?=substr($this->uri->segment(3),-2)?>" scope-tab=<?=$scope_tab?>><i class="bx bx-plus"></i></button></td>
															<td style="<?=$subKey==0?'border-top: 0;':''?>" colspan="18" class="align-middle"><?=$subItem["scope_name"]?></td>
														</tr>
														<?php if($subItem['scope_category']==12){ ?>
															<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
																<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){ ?>
																	<?php 
																	$data = json_decode(@$submitValue->submit_detail);
																	$data_value = (array) @$data;
																	?>
																	<?php if($frow==0){$frow++;?>
																		<tr class="frmbox2">
																			<th width="50"></th>
																			<th>แหล่งการปล่อย</th>
																			<th>หน่วย</th>
																			<th>รวม</th>
																			<?php for($mloop=1; $mloop<=12; $mloop++){?>
																				<?php 
																					$shw_year = substr($this->uri->segment(3),-2);
																					if($mloop<4){
																						$shw_year-=1;
																					}else{
																						$shw_year;
																					}
																				?>
																				<th class="text-center"><?=getGroupYear($mloop, $rsMember['member_dataset'])?> <?=$shw_year?></th>
																			<?php }?>
																			<th>ไฟล์หลักฐาน</th>
																			<th></th>
																		</tr>	
																	<?php } ?>
																	<form method="post" enctype="multipart/form-data">
																	<tr class="frmtable">
																		<td><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></td>
																		<td>
																			<input type="text" name="submit_name" autocomplete="off" required="" value="<?=$submitValue->submit_name?>" style="width:150px;" class="form-control">
																		</td>
																		<td class="text-center align-middle NonWarp"><?=$subItem["scope_unit"]?></td>
																		<td>
																			<?php $s_total=0;for($mloop=1; $mloop<=12; $mloop++){?>
																				<?php if(@$data_value["value_".$mloop]){?>
																					<?php $s_total+=@$data_value["value_".$mloop];?>
																				<?php }?>
																			<?php }?>
																			<input type="text" readonly style="width:80px;" class="form-control text-end" value="<?=number_format($s_total,4)?>">
																		</td>
																		<?php for($mloop=1; $mloop<=12; $mloop++){?>
																			<td>
																				<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_".$mloop]?>">
																			</td>
																			<?php if(@$data_value["value_".$mloop]){?>
																				<?php $s_total+=@$data_value["value_".$mloop];?>
																			<?php }?>
																		<?php }?>
																		<td>
																			<div style="width:120px;">
																			<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a>
																			<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																			</div>
																		</td>
																		<td>
																			<input type="hidden" name="submit_scope_id" value="<?=$submitValue->submit_scope_id?>">
																			<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																			<input type="hidden" name="submit_tab" value="3">
																			<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึก</button>
																		</td>
																	</tr>
																	</form>
																<?php } ?>			
															<?php }?>
														<?php }?>
														<?php if($subItem['scope_category']==4){ ?>
															<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
																<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){?>
																	<?php $data = json_decode(@$submitValue->submit_detail);$data_value = (array) @$data;?>
																	<tr class="frmtable">
																		<td colspan="19">
																			<form method="post" enctype="multipart/form-data">
																				<div class="table-responsive"> 
																					<table class="table">
																						<tbody>
																							<tr class="frmbox2">
																								<th width="50"><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></th>
																								<th width="150" class="text-left">วิธีการจัดการขยะ</th>
																								<th style="width: 300px;" colspan="3">
																									<select class="form-control" name="submit_value[val_type]" required style="width:300px;">
																										<option value="">เลือกวิธีการจัดการขยะ</option>
																										<?php $list = $this->uri->segment(3)<2565?getTrashType():getTrashType2565();?>
																										<?php foreach($list as $k=>$v){?>
																											<option value="<?=$k?>" <?=@$data_value["val_type"]==$k?'selected':''?>><?=$v?></option>
																										<?php }?>
																									</select>
																								</th>
																								<th colspan="14"></th>
																							</tr>
																							<tr>
																								<th colspan="2"></th>
																								<th class="text-center" colspan="2" style="width: 100px;">ปี พ.ศ.</th>
																								<th class="text-center">ปริมาณขยะ</th> 
																								<th class="text-center">
																									<input type="text" class="form-control" name="submit_value[trash_info]" value="<?=$data_value["trash_info"]?>">
																								</th>
																								<th class="text-center">(ตัน/ปี)</th>
																								<th colspan="12"></th>
																							</tr>
																							<tr>
																								<td colspan="2"></td>
																								<th class="text-left" colspan="5"><button type="button" class="btn btn-info btnAddtrash" style=""><i class="bx bx-plus"></i></button></th>
																								<th colspan="12"></th>
																							</tr>
																							
																							<?php if($data_value["trash_year"]!=null){asort($data_value["trash_year"]);?>
																								<?php foreach($data_value["trash_year"] as $k=>$item){?>
																								<tr class="">
																									<td colspan="2"></td>
																									<td class=" text-center"><a href="javascript:void(0)" class="btn btn-danger btn-del2" style=""><i class="bx bx-trash"></i></a></td>
																									<td >
																										<input type="number" class="form-control" step="0.0001" name="submit_value[trash_year][]" value="<?=$data_value["trash_year"][$k]?>">
																									</td>
																									<td colspan="3">
																										<input type="number" class="form-control" step="0.0001" name="submit_value[trash_value][]" value="<?=$data_value["trash_value"][$k]?>">
																									</td>
																									<td colspan="15"></td>
																								</tr>
																								<?php }?>
																							
																							<?php }?>

																							<tr>
																								<th width="50"></th>
																								<th width="150" class="text-left">องค์ประกอบขยะ</th>
																								<th style="width: 250px;text-align:left;" colspan="3">
																									<label class="radio-inline" style="margin:0;"><input type="radio" name="submit_value[trash_type]" value="1" <?=$data_value["trash_type"]==1?'checked':''?> <?=$data_value["trash_type"]==null?'checked':''?>> มี</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																									<label class="radio-inline" style="margin:0;"><input type="radio" name="submit_value[trash_type]" value="0" <?=$data_value["trash_type"]==0?'checked':''?>> ไม่มี</label>
																								</th>
																								<th colspan="14"></th>
																							</tr>
																							<tr class="frmbox2">
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
																								<?php $doc =0;?>
																								<?php for($mloop=1; $mloop<=10; $mloop++){?>
																									<td>
																										<input type="number" step="0.0001" name="submit_value[value_proportion_<?=$mloop?>]" style="width:100px;" class="form-control text-end" value="<?=@$data_value["value_proportion_".$mloop]?>">
																									</td>
																								<?php }?>
																								<th colspan="4"></th>
																							</tr>
																							<tr>
																								<th width="50"></th>
																								<th width="150" class="text-left" colspa="4">doc<sub>i</sub></th>
																								<th>% Wet</th>
																								<?php for($mloop=1; $mloop<=10; $mloop++){?>
																									<td>
																										<input type="number" step="0.0001" name="submit_value[value_doc_<?=$mloop?>]" style="width:100px;" class="form-control text-end" value="<?=@$data_value["value_doc_".$mloop]?>">
																									</td>
																								<?php $doc+=($data_value["value_proportion_".$mloop]*$data_value["value_doc_".$mloop])/100;}?>
																								<th colspan="4"></th>
																							</tr>
																							<?php 
																								$doc = $doc/100;
																								$mcf = getMCFTrash($data_value["val_type"]);
																								//calculateTrash($doc,$mcf,$data_value["trash_year"],$data_value["trash_value"]);	
																							?>
																							<tr>
																								<td></td>
																								<?php if(@$data_value["val_type"]<4){?>
																								<td colspan="2" class="text-end"><strong>CH<sub>4</sub> emission (kgCH<sub>4</sub>): </strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash($doc,$mcf,@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																								<?php }else if(@$data_value["val_type"]==4 || @$data_value["val_type"]==9){?>
																								<td colspan="2" class="text-end"><strong>C0<sub>2</sub> emission (kgCO<sub>2</sub>): </strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash4(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																								<?php }else if(@$data_value["val_type"]==5){?>
																								<td colspan="2" class="text-end"><strong>C0<sub>2</sub> emission (kgCO<sub>2</sub>): </strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash5(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																								<?php }else if(@$data_value["val_type"]==6){?>
																								<td colspan="2" class="text-end"><strong>CH<sub>4</sub> emission (kgCH<sub>4</sub>): </strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash6(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																								<?php }else if(@$data_value["val_type"]==7 || @$data_value["val_type"]==10){?>
																								<td colspan="2" class="text-end"><strong>CH<sub>4</sub> emission (kgCH<sub>4</sub>): </strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash7(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																								<?php }?>
																								<td colspan="14" class="text-left"></td>
																							</tr>
																							<?php if(@$data_value["val_type"]==6){?>
																							<tr>
																								<td></td>
																								<td colspan="2" class="text-end"><strong>N<sub>2</sub>O emission (kgN<sub>2</sub>O):</strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash8(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																								<td colspan="14" class="text-left"></td>
																							</tr>
																							<?php }else if($data_value["val_type"]==7){?>
																							<tr>
																								<td></td>
																								<td colspan="2" class="text-end"><strong>N<sub>2</sub>O emission (kgN<sub>2</sub>O):</strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrashAnaerobic(@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																								<td colspan="14" class="text-left"></td>
																							</tr>
																							<?php }?>
																							<?php if(@$data_value["val_type"]==8){?>
																							<tr>
																								<td></td>
																								<td colspan="2" class="text-end"><strong>CH<sub>4</sub> emission (kgCH<sub>4</sub>): </strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=calculateTrash($doc,$mcf,@$data_value["trash_year"],@$data_value["trash_value"])?>"></td>
																								<td colspan="14" class="text-left"></td>
																							</tr>
																							<tr>
																								<td></td>
																								<td colspan="2" class="text-end"><strong>CO<sub>2</sub> emission (kgCO<sub>2</sub>): </strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=number_format((rmComma(calculateTrash($doc,$mcf,@$data_value["trash_year"],@$data_value["trash_value"]))*44)/14,2)?>"></td>
																								<td colspan="14" class="text-left"></td>
																							</tr>
																							<?php }?>
																							<?php if(@$data_value["val_type"]==10){?>
																							<tr>
																								<td></td>
																								<td colspan="2" class="text-end"><strong>CO<sub>2</sub> emission (kgCO<sub>2</sub>): </strong></td>
																								<td colspan="2"><input type="text" readonly class="form-control" value="<?=number_format((rmComma(calculateTrash7(@$data_value["trash_year"],@$data_value["trash_value"]))*44)/14,2)?>"></td>
																								<td colspan="14" class="text-left"></td>
																							</tr>
																							<?php }?>
																							<tr>
																								<td></td>
																								<td colspan="2" class="text-end">ไฟล์หลักฐาน</td>
																								<td colspan="2">
																									<div style="width:120px;">
																									<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a>
																									<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																									</div>
																								</td>
																								<td colspan="14"></td>
																							</tr>
																							<tr>
																								<td colspan="3"></td>
																								<td colspan="16" class="text-left">
																									<input type="hidden" name="submit_scope_id" value="<?=$subItem["scope_id"]?>">
																									<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																									<input type="hidden" name="submit_tab" value="3">
																									<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</form>
																		</td>
																	</tr>
																<?php }?>
															<?php }?>
														<?php }?>
													<?php }else if( ($subItem['scope_category']>=5 && $subItem['scope_category']<=8) &&(explode(' - ',$subItem["scope_name"]))[0]=='เที่ยวไป'){?>
														<tr>
															<td style="<?=$subKey==0?'border-top: 0;':''?>width:50px;"><button class="btn btn-info <?=$addInput[$subItem['scope_category']]?>" scope-data="<?=$subItem["scope_id"]?>" scope-unit="<?=$subItem["scope_unit"]?>" scope-year="<?=substr($this->uri->segment(3),-2)?>" scope-tab=<?=$scope_tab?>><i class="bx bx-plus"></i></button></td>
															<td style="<?=$subKey==0?'border-top: 0;':''?>" colspan="18" class="align-middle">การจ้างเหมารับช่วงของการขนส่งขยะ/มูลฝอย (<?=(explode(' - ',$subItem["scope_name"]))[1]?>)</td>
														</tr>   
														<?php $frow=0;foreach($rsScopeValue as $submitValue){?>
															<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){?>
																<?php 
																	$data = json_decode(@$submitValue->submit_detail);
																	$data_submit_file = json_decode(@$submitValue->submit_file);
																	$data_value = (array) @$data;
																	$data_value_file = (array) @$data_submit_file;
																	
																	
																	$file1='';
																	$file2='';
																	$file3='';
														
																	foreach($data_value_file as $k=>$v){
																		$data_file = (array) @$v;
																		foreach($data_file as $k=>$v){
																			if($k=='file1'){$file1=$v;}
																			if($k=='file2'){$file2=$v;}
																			if($k=='file3'){$file3=$v;}
																		}
																	}

																?>
																<tr class="frmtable">
																	<td colspan="18">
																		<form method="post" id="frmSubmit" action="<?=base_url('dashboard/submit_save')?>/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>" enctype="multipart/form-data">
																			<div class="table-responsive">
																				<table class="table">
																					<tbody>
																						<tr class="frnbox2">
																							<th width="50"><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></th>
																							<th>แหล่งการปล่อย</th>
																							<th>หน่วย</th>
																							<th>รวม</th>
																							<?php for($mloop=1; $mloop<=12; $mloop++){?>
																								<?php 
																									$shw_year = substr($this->uri->segment(3),-2);
																									if($mloop<4){
																										$shw_year-=1;
																									}else{
																										$shw_year;
																									}
																								?>
																								<th class="text-center"><?=getGroupYear($mloop, $rsMember['member_dataset'])?> <?=$shw_year?></th>
																							<?php }?>
																							<th>ไฟล์หลักฐาน</th>
																						</tr>
																						<tr>
																							<td></td>
																							<td>
																								<div style="width:230px;">ปริมาณขยะที่องค์กรภายนอกนำไปกำจัด</div>
																							</td>
																							<td class="text-center">ton</td>
																							<td>
																								<?php $s_total=0;for($mloop=1; $mloop<=12; $mloop++){?>
																								<?php $s_total+=floatval($data_value["value_1_".$mloop]);?>
																								<?php }?>
																								<input type="text" readonly style="width:80px;" class="form-control text-end" value="<?=number_format($s_total,4)?>">
																							</td>
																							<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_1_".$mloop]?>">
																							</td>
																							<?php $s_total+=floatval($data_value["value_1_".$mloop]);?>
																							<?php }?>
																							<td>
																								<div style="width:120px;"> 
																									<input type="hidden" name="submit_file_temp" value="<?=$file1?>"/>
																									<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>_1&quot;).html($(this).val());" class="error"></a> 
																									<span id="submit_file_temp_<?=$submitValue->submit_id?>_1"><?=$file1!=null?'<a href="'.base_url().'download/'.$file1.'/'.$file1.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																								</div>
																							</td>
																						</tr>
																						<tr>
																							<td></td>
																							<td>
																								<div style="width:150px;">ระยะทางในการขนส่ง</div>
																							</td>
																							<td class="text-center">km</td>
																							<td>
																								<?php $s_total=0;for($mloop=1; $mloop<=12; $mloop++){?>
																								<?php $s_total+=floatval($data_value["value_2_".$mloop]);?>
																								<?php }?>
																								<input type="text" readonly style="width:80px;" class="form-control text-end" value="<?=number_format($s_total/12,4)?>">
																							</td>
																							<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_2_".$mloop]?>">
																							</td>
																							<?php $s_total+=floatval($data_value["value_2_".$mloop]);?>
																							<?php }?>
																							<td>
																								<div style="width:120px;"> 
																									<input type="hidden" name="submit_file2_temp" value="<?=$file2?>"/>
																									<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file2" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>_2&quot;).html($(this).val());" class="error"></a> 
																									<span id="submit_file_temp_<?=$submitValue->submit_id?>_2"><?=$file2!=null?'<a href="'.base_url().'download/'.$file2.'/'.$file2.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																								</div>
																							</td>
																						</tr>
																						<tr>
																							<td></td>
																							<td>
																								<div style="width:150px;">จำนวนเที่ยว</div>
																							</td>
																							<td class="text-center">เที่ยว</td>
																							<td>
																								<?php $s_total=0;for($mloop=1; $mloop<=12; $mloop++){?>
																								<?php $s_total+=floatval($data_value["value_3_".$mloop]);?>
																								<?php }?>
																								<input type="text" readonly style="width:80px;" class="form-control text-end" value="<?=number_format($s_total/12,4)?>">
																							</td>
																							<?php for($mloop=1; $mloop<=12; $mloop++){?>
																							<td>
																								<input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_<?=$mloop?>]" class="form-control text-end" value="<?=@$data_value["value_3_".$mloop]?>">
																							</td>
																							<?php $s_total+=floatval($data_value["value_3_".$mloop]);?>
																							<?php }?>
																							<td>
																								<div style="width:120px;"> 
																									<input type="hidden" name="submit_file3_temp" value="<?=$file3?>"/>
																									<a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file3" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>_3&quot;).html($(this).val());" class="error"></a> 
																									<span id="submit_file_temp_<?=$submitValue->submit_id?>_3"><?=$file3!=null?'<a href="'.base_url().'download/'.$file3.'/'.$file3.'" target="_blank" class="btn btn-sm btn-info"><i class="bx bx-download"></i> ดาวน์โหลด</a>':''?></span>
																								</div>
																							</td>
																						</tr>
																						<tr>
																							<td colspan="3"></td>
																							<td colspan="14">
																								<input type="hidden" name="submit_scope_id" value="<?=$submitValue->submit_scope_id?>">
																								<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																								<input type="hidden" name="submit_tab" value="3">
																								<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึก</button>
																							</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</form>
																	</td>
																</tr>
															<?php }?>
														<?php }?>
													<?php }?>
												<?php } ?>
											</table>
										</div>
                <?php }?>
			</div>
            <div class="tab-pane fade <?= $chtab == 4 ? 'show active' : '' ?>" id="scope4" role="tabpanel">
                <?php $scope_tab=4;?>
			    <?php foreach($rsScope4 as $item){ ?>
					<p class="scope-section"><?=$item["name"]?> </p>
                    <div class="table-responsive mb-5">
											<table class="table gov_table">
												<?php foreach($item['list'] as $subKey=>$subItem){?>
													<tr>
														<td style="<?=$subKey==0?'border-top: 0;':''?>width:50px;"><button class="btn btn-info <?=$addInput[$subItem['scope_category']]?>" scope-data="<?=$subItem["scope_id"]?>" scope-unit="<?=$subItem["scope_unit"]?>" scope-year="<?=substr($this->uri->segment(3),-2)?>" scope-tab=<?=$scope_tab?>><i class="bx bx-plus"></i></button></td>
														<td style="<?=$subKey==0?'border-top: 0;':''?>" colspan="18" class="align-middle"><?=$subItem["scope_name"]?></td>
													</tr>
													<?php if($subItem['scope_category']==9){ ?>
														<?php $frow=0;$tree_sum_total=0;$tree_amout=0;$tree_biomass=0;foreach($rsScopeValue as $submitValue){?>
															<?php if($submitValue->submit_scope_id==$subItem["scope_id"]){?>
																<?php 
																$data = json_decode(@$submitValue->submit_detail);
																$data_value = (array) @$data;
															
																?>
																<?php if($frow==0){$frow++;?>
																	<tr class="frmbox2">
																		<th width="50"></th>
																		<?php for($mloop=1; $mloop<=8; $mloop++){?>
																		<?php if($mloop>6){?>
																			<th class="text-center" width="150"><?=$ar_tree[$mloop]?></th>
																		<?php }else{?>
																			<th class="text-center"><?=$ar_tree[$mloop]?></th>
																		<?php }?>
																		<?php }?>
																	</tr>
																<?php }?>
																<form method="post" enctype="multipart/form-data">
																<tr class="frmtable">
																	<td><a href="<?=base_url()?>dashboard/submit/<?=$this->uri->segment(3)?>/del/<?=$submitValue->submit_dep_id?>/<?=$submitValue->submit_id?>/<?=$submitValue->submit_scope_id?>/<?=$this->uri->segment(5)?>" class="btn btn-danger" style="" onclick="return confirm('คุณต้องการลบใช่หรือไม่');"><i class="bx bx-trash"></i></a></td>
																	<?php for($mloop=1; $mloop<=6; $mloop++){?>
																		<td>
																			<input type="text" name="submit_value[tree_<?=$mloop?>]" autocomplete="off" class="form-control text-end" value="<?=@htmlspecialchars($data_value["tree_".$mloop])?>">
																		</td>
																	<?php }?>
																	<?php
																		$e = @$data_value["tree_4"];
																		$g = @$data_value["tree_5"]/3.14;
																		$amout = @$data_value["tree_6"];
																		$tree_sum_total += (0.0509*pow((pow($g,2)*$e),0.919))+(0.00893*pow((pow($g,2)*$e),0.977))+(0.014*pow((pow($g,2)*$e),0.669))*$amout;
																		$biomass = (0.0509*pow((pow($g,2)*$e),0.919))+(0.00893*pow((pow($g,2)*$e),0.977))+(0.014*pow((pow($g,2)*$e),0.669))*$amout;
																		$tree_amout +=$amout;
																		
																		$tree_biomass +=$biomass;
																	?>
																	<td class="text-end align-middle"><?=number_format($data_value["tree_5"]/3.14,4)?></td>
																	<td class="text-end align-middle"><?=number_format($biomass,4)?></td>
																</tr>
																<tr class="frmtable">
																	<td class="text-end" colspan="2">อัพโหลดไฟล์หลักฐาน</td>
																	<td colspan="8">
																		<a class="btn btn-secondary btn-sm" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp_<?=$submitValue->submit_id?>&quot;).html($(this).val());" class="error"></a> 
																		<span id="submit_file_temp_<?=$submitValue->submit_id?>"><?=$submitValue->submit_file!=null?'<a href="'.base_url().'download/'.$submitValue->submit_file.'/'.$submitValue->submit_file.'" target="_blank" class="btn btn-sm btn-info">'.$submitValue->submit_file.'</a>':''?></span>
																	</td>
																</tr>
																<tr class="frmtable">
																	<td colspan="2">
																		<input type="hidden" name="submit_scope_id" value="<?=$submitValue->submit_scope_id?>">
																		<input type="hidden" name="submit_id" value="<?=$submitValue->submit_id?>">
																	</td>
																	<td colspan="7">
																		<input type="hidden" name="submit_tab" value="4">
																		<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button>
																	</td>
																</tr>
																</form>
															<?php }?>
														<?php }?>
														<tr style="background-color: #feffb5;text-align:right">
															<td colspan="8" >
																<strong>จำนวน(ต้น) : </strong>
															</td>
                                                            <td style="width:100px"><?=number_format($tree_amout)?></td>
														</tr>
														<tr style="background-color: #feffb5;text-align:right">
															<td colspan="8">
																<strong>มวลชีวภาพของต้นไม้ (kg) : </strong>
															</td>
                                                            <td style="width:100px"><?=number_format($tree_biomass,4)?></td>
														</tr>
														<tr style="background-color: #feffb5;text-align:right">
															<td colspan="8">
																<strong>ปริมาณคาร์บอนที่กักเก็บได้ (tonCO<sub>2</sub>) : </strong>
															</td>
                                                            <td style="width:100px"><?=number_format(($tree_sum_total*0.5)/1000,4)?></td>
														</tr>
													<?php }?>
												<?php } ?>
											</table>
										</div>
                <?php }?>
			</div>
		</div>
    </div>
</div>
<input type="hidden" id="member_dataset" value="<?=$rsMember['member_dataset']?>">


<script type="text/javascript">

	function getGroupYear(key, type = null) {
		let MONTH;
		if (type === "Fiscal") {
			MONTH = ["", "ต.ค.", "พ.ย.", "ธ.ค.", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย."];
		} else if (type === "Year") {
			MONTH = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
		}
		
		return MONTH[key];
	}

    $(document).on("click", ".btn-del2", function(e) {
		$(this).parent().parent().eq(0).remove();
	});
			
	$(document).on("click", ".btn-del", function(e) {
		$( ".frmbox" ).remove();
	});

    $(document).on('click','.btnAddTree', function(e) {
				var sub = $(this).attr("scope-data");
				var data='<tr class="frmbox"> <td colspan="9"> <form method="post" id="frmSubmit" enctype="multipart/form-data"> <div class="table-responsive"> <table class="table"> <tbody> <tr class="table-light"> <th></th> <th class="text-center">ชนิดต้นไม้</th> <th class="text-center">สถานที่ปลูก</th> <th class="text-center">ปีที่ปลูก</th> <th class="text-center">ความสูง<br/>(เมตร)</th> <th class="text-center">เส้นรอบวง<br/>(เซนติเมตร)</th> <th class="text-center">จำนวน<br/>(ต้น)</th> <th class="text-center">เส้นผ่านศูนย์กลาง<br/>(เซนติเมตร)</th> <th class="text-center">มวลชีวภาพของต้นไม้<br/>(kg/tree)</th> </tr><tr> <td><a href="javascript:void(0)" class="btn btn-danger btn-del"><i class="bx bx-trash"></i></a></td><td> <input type="text" name="submit_value[tree_1]" autocomplete="off" class="form-control"> </td><td> <input type="text" name="submit_value[tree_2]" class="form-control"> </td><td> <input type="text" name="submit_value[tree_3]" class="form-control"> </td><td> <input type="text" name="submit_value[tree_4]" class="form-control"> </td><td> <input type="text" name="submit_value[tree_5]" class="form-control"> </td><td> <input type="text" name="submit_value[tree_6]" class="form-control"> </td><td></td><td></td></tr><tr> <td class="text-end" colspan="2">อัพโหลดไฟล์หลักฐาน</td><td><a class="btn btn-secondary btn-sm" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp&quot;).html($(this).val());" class="error"></a></td><td colspan="7"><span id="submit_file_temp"></span></td></tr><tr> <td colspan="2"> <input type="hidden" name="submit_scope_id" value="'+sub+'"> <input type="hidden" name="submit_id"> </td><td colspan="7"> <input type="hidden" name="submit_tab" value="4"><button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button> </td></tr></tbody> </table> </div></form> </td></tr>';
				$( ".frmbox" ).remove();
				$(this).closest('tr').after(data);
			});

    $(document).on('click','.btnAddInput', function(e) {
				var sub = $(this).attr("scope-data");
				var tab = $(this).attr("scope-tab");
				var unit = $(this).attr("scope-unit");
				var myear = $(this).attr("scope-year");
				//myear = myear-1;
				$( ".frmbox" ).remove();
				var data='<tr class="frmbox"> <td colspan="18"> <form method="post" id="frmSubmit" enctype="multipart/form-data"> <div class="table-responsive"> <table class="table"> <tbody> <tr class="table-light"> <th width="50"></th> <th>แหล่งการปล่อย</th> <th>หน่วย</th> <th>รวม</th> <th class="text-center" width="100">'+getGroupYear(1, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center" width="100">'+getGroupYear(2, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center" width="100">'+getGroupYear(3, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center" width="100">'+getGroupYear(4, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(5, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(6, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(7, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(8, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(9, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(10, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(11, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(12, $('#member_dataset').val())+' '+(myear)+'</th> <th>ไฟล์หลักฐาน</th> <th></th> </tr><tr> <td><a href="javascript:void(0)" class="btn btn-danger btn-del" style=""><i class="bx bx-trash"></i></a></td><td> <input type="text" name="submit_name" autocomplete="off" required style="width:150px;" class="form-control"> </td><td class="text-center NonWarp">'+unit+'</td><td><input type="text" readonly style="width:80px;" class="form-control text-end"></td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_4]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_5]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_6]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_7]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_8]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_9]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_10]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_11]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_12]" class="form-control"> </td><td> <div style="width:120px;"> <a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp&quot;).html($(this).val());" class="error"></a> <span id="submit_file_temp"></span> </div></td><td> <input type="hidden" name="submit_scope_id" value="'+sub+'"> <input type="hidden" name="submit_id"> <input type="hidden" name="submit_tab" value="'+tab+'"> <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึก</button> </td></tr></tbody> </table> </div></form> </td></tr>';
				$(this).closest('tr').after(data);0
			});
            $(document).on('click','.btnAddScope8', function(e) {
				var sub = $(this).attr("scope-data");
				var tab = $(this).attr("scope-tab");
				var myear = $(this).attr("scope-year");   
				//myear = myear-1;
				$( ".frmbox" ).remove();
				var data='<tr class="frmbox"> <td colspan="19"> <form method="post" enctype="multipart/form-data"> <div class="table-responsive"> <table class="table"> <tbody> <tr class="table-light"> <td width="50"> <a href="javascript:void(0)" class="btn btn-danger btn-del" style=""><i class="bx bx-trash"></i></a> </td><td><input type="text" name="submit_name" required="" class="form-control text-left" style="width: 150px;"/></td><th>หน่วย</th> <th class="text-center">'+getGroupYear(1, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center">'+getGroupYear(2, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center">'+getGroupYear(3, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center">'+getGroupYear(4, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(5, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(6, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(7, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(8, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(9, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(10, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(11, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(12, $('#member_dataset').val())+' '+(myear)+'</th> </tr><tr> <td></td><td>ปริมาณ</td><td>ลบ.ม./เดือน</td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_1]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_2]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_3]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_4]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_5]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_6]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_7]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_8]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_9]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_10]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_11]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_mass_12]" class="form-control text-end" value=""/></td></tr><tr> <td></td><td>ค่า BOD ขาเข้า</td><td>มก./ลิตร</td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_1]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_2]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_3]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_4]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_5]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_6]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_7]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_8]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_9]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_10]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_11]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[bod_12]" class="form-control text-end" value=""/></td></tr><tr> <td></td><td>ประเภทระบบบำบัดฯ</td><td colspan="6"> <select class="form-control" name="submit_value[val_type]" required=""> <option value="">เลือกประเภท</option> <option value="1">ปล่อยน้ำเสียลงสู่ทะเล แม่น้ำ บึง โดยตรง</option> <option value="2">บ่อปรับเสถียร (Stabilization Pond)</option> <option value="3">คลองวนเวียน (Oxidation Ditch)</option> <option value="4">บ่อเติมอากาศ (Aerated Lagoon)</option> <option value="5">ระบบตะกอนเร่ง (Activated Sludge)</option> <option value="6">ระบบตะกอนเร่งแบบปรับเสถียรสัมผัส (Contact Stabilization AS)</option> <option value="7">ระบบตะกอนเร่งแบบสองขั้นตอน (Two-Stage AS Process)</option> <option value="8">ระบบผสมระหว่างตัวกลางหมุนชีวภาพและตะกอนเร่ง (Combination of Fixed AS)</option> <option value="9">แผ่นจานหมุนชีวภาพ (Rotating Biological Contractor)</option> <option value="10">บึงประดิษฐ์ (Constructed Wetland)</option> <option value="11">บ่อกรองไร้อากาศ (Anaerobic filter)</option> <option value="12">บ่อเกรอะ (Septic Tank)</option> <option value="13">บ่อซึม (Latrine)</option> </select> </td><td class="text-end"><strong>Emissions : </strong></td><td colspan="6"><input type="number" step="0.0001" readonly="" class="form-control text-end" value=""/></td></tr><tr> <td colspan="2"></td><td class="text-end" colspan="1">ไฟล์หลักฐาน :</td><td colspan="16"> <div style="width:100%;"> <a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp&quot;).html($(this).val());" class="error"></a> <span id="submit_file_temp"></span> </div></td></tr><tr> <td colspan="3"></td><td colspan="15"> <input type="hidden" name="submit_scope_id" value="'+sub+'"/> <input type="hidden" name="submit_id"/> <input type="hidden" name="submit_tab" value="1"/> <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button> </td></tr></tbody> </table> </div></form> </td></tr>';
				$(this).closest('tr').after(data);
			});
            $(document).on('click','.btnAddScope9', function(e) {
				var sub = $(this).attr("scope-data");
				var tab = $(this).attr("scope-tab");
				var myear = $(this).attr("scope-year");
				//myear = myear-1;
				$( ".frmbox" ).remove();
				var data='<tr class="frmbox"> <td colspan="19"> <form method="post" enctype="multipart/form-data"> <div class="table-responsive"> <table class="table"> <tbody> <tr class="table-light"> <th width="50"> <a href="javascript:void(0)" class="btn btn-danger btn-del" style=""><i class="bx bx-trash"></i></a> </th> <th colspan="3"><input type="text" name="submit_name" required="" class="form-control text-left" value="" placeholder="ชื่อสำนักงาน/ศูนย์/โรงเรียน"/></th> <th>หน่วย</th> <th class="text-center">'+getGroupYear(1, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center">'+getGroupYear(2, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center">'+getGroupYear(3, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center">'+getGroupYear(4, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(5, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(6, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(7, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(8, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(9, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(10, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(11, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center">'+getGroupYear(12, $('#member_dataset').val())+' '+(myear)+'</th> <th>รวม</th> </tr><tr> <td></td><td colspan="3"> <select class="form-control" name="submit_value[val_type]" required=""> <option value="">เลือกประเภท</option> <option value="1">จำนวนบุคลากร</option> <option value="2">จำนวนนักศึกษา</option> </select> </td><td class="text-center">คน</td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_1]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_2]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_3]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_4]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_5]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_6]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_7]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_8]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_9]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_10]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_11]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_pop_12]" class="form-control text-end" value=""/></td><td><input type="text" readonly="" class="form-control text-left" style="width: 80px;" value=""/></td></tr><tr> <td></td><td colspan="3">วันทำงาน</td><td class="text-center">วัน</td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_1]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_2]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_3]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_4]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_5]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_6]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_7]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_8]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_9]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_10]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_11]" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" name="submit_value[value_day_12]" class="form-control text-end" value=""/></td><td><input type="text" readonly="" class="form-control text-left" style="width: 80px;" value=""/></td></tr><tr> <td></td><td colspan="3">Total organically degradable carbon in wastewater (TOW)</td><td class="text-center">kg BOD</td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="text" readonly="" class="form-control text-left" style="width: 80px;" value=""/></td></tr><tr> <td></td><td colspan="3">Emission Factor</td><td class="text-center">kg CH4 / kg BOD</td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="text" readonly="" class="form-control text-left" style="width: 80px;" value=""/></td></tr><tr> <td></td><td colspan="3">ปริมาณการปล่อย CH4</td><td class="text-center">กก. CH4</td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="number" step="0.0001" style="width: 80px;" readonly="" class="form-control text-end" value=""/></td><td><input type="text" readonly="" class="form-control text-left" style="width: 80px;" value=""/></td></tr><tr> <td colspan="4"></td><td class="text-end" colspan="1">ไฟล์หลักฐาน :</td><td colspan="14"> <div style="width:100%;"> <a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp&quot;).html($(this).val());" class="error"></a> <span id="submit_file_temp"></span> </div></td></tr><tr> <td colspan="5"></td><td colspan="14"> <input type="hidden" name="submit_scope_id" value="'+sub+'"/> <input type="hidden" name="submit_id"/> <input type="hidden" name="submit_tab" value="1"/> <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> คำนวนและบันทึก</button> </td></tr></tbody> </table> </div></form> </td></tr>';
				$(this).closest('tr').after(data);
			});

            async function getWaste(sub){
				let result;
				try{
					result = await $.get( "/dashboard/getWaste/?sub="+sub);
					return result;
				}catch (error){
					console.error(error)
				}
			}


            $(document).on('click','.btnAddScope10', function(e) {
				var sub = $(this).attr("scope-data");
				var tab = $(this).attr("scope-tab");
				var myear = $(this).attr("scope-year");
				myear = myear-1;
				$( ".frmbox" ).remove();
                getWaste(sub).then((data) => {
					$(this).closest('tr').after(data)
				})
            });

            $(document).on('click','.btnAddtrash', function(e) {
				var data ='<tr class=""> <td colspan="2"></td><th><a href="javascript:void(0)" class="btn btn-danger btn-del2" style=""><i class="bx bx-trash"></i></a></th> <th> <input type="number" class="form-control" step="0.0001" name="submit_value[trash_year][]"> </th> <th colspan="3"> <input type="number" class="form-control" step="0.0001" name="submit_value[trash_value][]"> </th> <th colspan="15"></th></tr>';
				$(this).closest('tr').after(data);
			});

            $(document).on('click','.btnAddInput49', function(e) {
				var sub = $(this).attr("scope-data");
				var tab = $(this).attr("scope-tab");
				var unit = $(this).attr("scope-unit");
				var myear = $(this).attr("scope-year");
				myear = myear-1;
				$( ".frmbox" ).remove();
				
				var data='<tr class="frmbox"> <td colspan="18"> <form method="post" id="frmSubmit" enctype="multipart/form-data"> <div class="table-responsive"> <table class="table"> <tbody> <tr class="table-light"> <th width="50"><a href="javascript:void(0)" class="btn btn-danger btn-del" style=""><i class="bx bx-trash"></i></a></th> <th>แหล่งการปล่อย</th> <th>หน่วย</th> <th>รวม</th> <th class="text-center" width="100">ต.ค. '+(myear-1)+'</th> <th class="text-center" width="100">พ.ย. '+(myear-1)+'</th> <th class="text-center" width="100">ธ.ค. '+(myear-1)+'</th> <th class="text-center" width="100">ม.ค. '+(myear)+'</th> <th class="text-center" width="100">ก.พ. '+(myear)+'</th> <th class="text-center" width="100">มี.ค. '+(myear)+'</th> <th class="text-center" width="100">เม.ย. '+(myear)+'</th> <th class="text-center" width="100">พ.ค. '+(myear)+'</th> <th class="text-center" width="100">มิ.ย. '+(myear)+'</th> <th class="text-center" width="100">ก.ค. '+(myear)+'</th> <th class="text-center" width="100">ส.ค. '+(myear)+'</th> <th class="text-center" width="100">ก.ย. '+(myear)+'</th> <th>ไฟล์หลักฐาน</th> <th></th> </tr><tr> <td><a href="javascript:void(0)" class="btn btn-danger btn-del" style=""><i class="bx bx-trash"></i></a></td><td> <input type="text" name="submit_name" autocomplete="off" required style="width:230px;" class="form-control"> </td><td class="text-center NonWarp">'+unit+'</td><td><input type="text" readonly style="width:80px;" class="form-control text-end"></td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_4]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_5]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_6]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_7]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_8]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_9]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_10]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_11]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_12]" class="form-control"> </td><td> <div style="width:120px;"> <a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp&quot;).html($(this).val());" class="error"></a> <span id="submit_file_temp"></span> </div></td><td> <input type="hidden" name="submit_scope_id" value="'+sub+'"> <input type="hidden" name="submit_id"> <input type="hidden" name="submit_tab" value="'+tab+'"> <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึก</button> </td></tr></tbody> </table> </div></form> </td></tr>';
				var data='<tr class="frmbox"> <td colspan="18"> <form method="post" id="frmSubmit" action="<?=base_url('dashboard/submit_save')?>/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>" enctype="multipart/form-data"> <div class="table-responsive"> <table class="table"> <tbody> <tr class="table-light"> <th width="50"><a href="javascript:void(0)" class="btn btn-danger btn-del" style=""><i class="bx bx-trash"></i></a></th> <th>แหล่งการปล่อย</th> <th>หน่วย</th> <th>รวม</th> <th class="text-center" width="100">'+getGroupYear(1, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center" width="100">'+getGroupYear(2, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center" width="100">'+getGroupYear(3, $('#member_dataset').val())+' '+(myear-1)+'</th> <th class="text-center" width="100">'+getGroupYear(4, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(5, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(6, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(7, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(8, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(9, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(10, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(11, $('#member_dataset').val())+' '+(myear)+'</th> <th class="text-center" width="100">'+getGroupYear(12, $('#member_dataset').val())+' '+(myear)+'</th> <th>ไฟล์หลักฐาน</th> </tr><tr> <td></td><td> <div style="width:230px;">ปริมาณขยะที่องค์กรภายนอกนำไปกำจัด</div></td><td class="text-center">ton</td><td> <input type="text" readonly="" style="width:80px;" class="form-control text-end"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_1]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_2]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_3]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_4]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_5]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_6]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_7]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_8]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_9]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_10]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_11]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_1_12]" class="form-control"> </td><td> <div style="width:120px;"> <a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp&quot;).html($(this).val());" class="error"></a> <span id="submit_file_temp"></span> </div></td></tr><tr> <td></td><td> <div style="width:150px;">ระยะทางในการขนส่ง</div></td><td class="text-center">km</td><td> <input type="text" readonly="" style="width:80px;" class="form-control text-end"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_1]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_2]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_3]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_4]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_5]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_6]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_7]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_8]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_9]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_10]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_11]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_2_12]" class="form-control"> </td><td> <div style="width:120px;"> <a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file2" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp2&quot;).html($(this).val());" class="error"></a> <span id="submit_file_temp2"></span> </div></td></tr><tr> <td></td><td> <div style="width:150px;">จำนวนเที่ยว</div></td><td class="text-center">เที่ยว</td><td> <input type="text" readonly="" style="width:80px;" class="form-control text-end"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_1]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_2]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_3]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_4]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_5]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_6]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_7]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_8]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_9]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_10]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_11]" class="form-control"> </td><td> <input type="number" step="0.0001" style="width:80px;" name="submit_value[value_3_12]" class="form-control"> </td><td> <div style="width:120px;"> <a class="btn btn-secondary" style="position:relative;" href="javascript:;"><i class="bx bx-upload"></i><input type="file" name="submit_file3" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);width:40px;-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange="$(&quot;#submit_file_temp3&quot;).html($(this).val());" class="error"></a> <span id="submit_file_temp3"></span> </div></td></tr><tr> <td colspan="3"></td><td colspan="14"> <input type="hidden" name="submit_scope_id" value="'+sub+'"> <input type="hidden" name="submit_id"> <input type="hidden" name="submit_tab" value="'+tab+'"> <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึก</button> </td></tr></tbody> </table> </div></form> </td></tr>';
				$(this).closest('tr').after(data);
			});
</script>