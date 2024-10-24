
<?php
$data_value = array();
$data_config = array();
if ($rsGovermentFr != null) {
    $data = json_decode(@$rsGovermentFr[0]->fr_detail);
    $data2 = json_decode(@$rsGovermentFr[0]->fr_config);
    $data_config = (array) @$data2;
    $data_value = (array) @$data;
}
function searchForId($array, $key, $value)
{
    $sum = 0;
    foreach ($array as $k => $v) {
        foreach ($v['subScope'] as $kk => $vv) {
            if ($vv[$key] == $value) {
                if (!empty($vv['submit_total']))
                    $sum += $vv['submit_total'];
            }
        }
    }
    return $sum;
}

function CalkgCO2e($e, $f, $g, $h, $i, $j, $k, $l, $m, $gwp_CO2, $gwp_CH4, $gwp_N2O, $gwp_SF6, $gwp_NF3){
    $e	= $e!=null ?$e:0;
    $f	= $f!=null ?$f:0;
    $g	= $g!=null ?$g:0;
    $h	= $h!=null ?$h:0;
    $i	= $i!=null ?$i:0;
    $j	= $j!=null ?$j:0;
    $k	= $k!=null ?$k:0;
    $l	= $l!=null ?$l:0;
    $m	= $m!=null ?$m:0;
    $AP8	= $gwp_CO2;
    $AP9	= $gwp_CH4;
    $AP10	= $gwp_N2O;
    $AP11	= $gwp_SF6;
    $AP12	= $gwp_NF3;
    
    return @(rmComma($e)*$AP8)+(rmComma($f)*$AP9)+(rmComma($g)*$AP10)+(rmComma($h)*$AP11)+(rmComma($i)*$AP12)+(rmComma($j)*rmComma($l))+(rmComma($k)*rmComma($m));
    // return $e;
}
function getTrashSuffix($val_type, $type){
    $ar = array(
        4 => array(
            3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        5 => array(
            3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        2 => array(
            3 =>0, 4=>1, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        1 => array(
            3 =>0, 4=>1, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        3 => array(
            3 =>0, 4=>1, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        6 => array(
            3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        7 => array(
            3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        8 => array(
            3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        9 => array(
            3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
        10 => array(
            3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
        ),
    );
    return $ar[$val_type][$type];
}
?>
<style>
    #fr04 thead {
        font-size: 12px;
        color: #fff;
    }

    #fr04 tr{
        border: 0px !important;
    }
    .scope_total {
        /* background-color: #999; */
        background-color: rgb(71 85 105);
        color: #fff !important;
        font-weight: bold;
    }

    table .tddrop {
        /* background-color: #d0cdcd; */
        background-color: rgb(233 236 239);
        border: 0px !important;
    }

    .radioCheck {
        color: rgb(29 78 216);
    }

    .radioCheck-border {
        color: rgb(147 197 253);
    }

    .radioNonCheck {
        color: rgb(203 213 225);
    }

    .radioNonCheck-border {
        color: rgb(226 232 240);
    }

    .table-bordered thead td,
    .table-bordered thead th {
        border-bottom-width: 1px;
        font-weight: normal;
    }
 
    #fr04 .form-control {
  border: 0px solid #ced4da !important;
  font-size: 12px !important;
  text-align: right;
  border-radius: 0;
  padding: 1px;
  height: 20px;
}

    .table-bordered td,
    #fr04 td {
        border: 1px solid #dee2e6;
        padding: 3px;
    }

    .input-text {
        min-width: 15vw;
        border: 0;
    }

    .input-text:focus,
    .input-text:hover {
        border: 0;
        outline: 0;
    }

    .NonWarp {
        white-space: nowrap;
    }

    #fr04 .textref {
        text-align: left;
    }

    .fv {
        transform: rotate(-90deg);
        white-space: nowrap;
        display: inline-block;
        font-weight: 100;
        font-size: 10px;
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
                            <th class="align-middle">4</th>
                        </tr>
                        <tr>
                            <th class="align-middle">รหัสฟอร์ม</th>
                            <th class="align-middle">Fr-04</th>
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

	

    <div class="row mb-3">
        <div class="col-12">
            <div class="table-responsive mb-5">
                <table class="table table-bordered" id="fr04">
                    <thead>
                        <tr>
                            <th rowspan="4" class="text-center align-middle" style="background-color: #2b9398;">ขอบเขต
                            </th>
                            <th rowspan="4" class="text-center align-middle" style="background-color: #552b98;">
                                <div style="width:360px;">รายการ</div>
                            </th>
                            <th rowspan="3" colspan="2" class="text-center align-middle"
                                style="background-color: #aac14b;">ค่า LCI</th>
                            <th rowspan="2" colspan="9" class="text-center align-middle"
                                style="background-color: #921e43;">
                                <div style="">GHG ที่ต้องรายงานตามข้อกำหนด</div>
                            </th>
                            <th rowspan="2" colspan="2" class="text-center align-middle NonWarp"
                                style="background-color: #921e43;">GHG ที่อยู่นอกข้อกำหนด</th>
                            <th rowspan="4" class="text-center align-middle" style="background-color: #921e43;">Total
                                (kgCO<sub>2</sub>e/หน่วย)</th>
                            <th colspan="7" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:175px;">ที่มา</div>
                            </th>
                            <th rowspan="4" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:25px;"><span class="fv">Subsitute</span></div>
                            </th>
                            <th rowspan="4" class="text-center align-middle" style="background-color: #203686;">
                                แหล่งอ้างอิง</th>
                            <th rowspan="3" colspan="5" class="text-center align-middle"
                                style="background-color: #3a3939;">
                                <div style="width:250px;">ผลคูณ (Ton GHG)</div>
                            </th>
                            <th rowspan="3" colspan="7" class="text-center align-middle"
                                style="background-color: #3a3939;">
                                <div style="width:350px;">ผลคูณ (TonCO<sub>2</sub>e)</div>
                            </th>
                            <th rowspan="4" class="text-center align-middle" style="background-color: #3a3939;">Total
                                GHG<br /> (tonCO<sub>2</sub>e)</th>
                            <th rowspan="4" class="text-center align-middle title_sum_100"
                                style="background-color: #3a3939;">สัดส่วน (%)</th>
                            <th rowspan="4" class="text-center align-middle title_sum_112"
                                style="background-color: #3a3939;">สัดส่วน (%)<br />(SCOPE1+2)</th>
                            <th rowspan="4" class="text-center align-middle title_sum_123"
                                style="background-color: #3a3939;">สัดส่วน (%)<br />(SCOPE1+2+3)</th>
                            <th rowspan="4" class="text-center align-middle" style="background-color: #3a3939;">
                                คำอธิบายเพิ่มเติม</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:50px;">1<sub>st</sub></div>
                            </th>
                            <th colspan="4" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:100px;">2<sub>nd</sub></div>
                            </th>
                            <th rowspan="3" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:25px;"><span class="fv">other</span></div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="7" class="text-center align-middle" style="background-color: #921e43;">
                                <div style="width:560px;">ค่า EF (kg GHG/หน่วย)</div>
                            </th>
                            <th colspan="2" class="text-center align-middle" style="background-color: #921e43;">
                                <div style="width:160px;">GWP100</div>
                            </th>
                            <th colspan="" rowspan="2" class="text-center align-middle"
                                style="background-color: #921e43;">ค่า EF (kg GHG/หน่วย)</th>
                            <th colspan="" rowspan="2" class="text-center align-middle"
                                style="background-color: #921e43;">GWP<sub>100</sub></th>
                            <th rowspan="2" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:25px;"><span class="fv" style="margin: -10px;">Self collct</span>
                                </div>
                            </th>
                            <th rowspan="2" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:25px;"><span class="fv" style="margin: -10px;">Supplier</span></div>
                            </th>
                            <th rowspan="2" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:25px;"><span class="fv" style="margin: -10px;">TH LCI DB</span></div>
                            </th>
                            <th rowspan="2" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:25px;"><span class="fv" style="margin: -10px;">TGO EF</span></div>
                            </th>
                            <th rowspan="2" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:25px;"><span class="fv" style="margin: -10px;">Thai Res.</span></div>
                            </th>
                            <th rowspan="2" class="text-center align-middle" style="background-color: #203686;">
                                <div style="width:25px;"><span class="fv" style="margin: -10px;">Int. DB</span></div>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" style="background-color: #aac14b;">หน่วย</th>
                            <th class="text-center align-middle" style="background-color: #aac14b;">ปริมาณ</th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">CO<sub>2</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">CH<sub>4</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">N<sub>2</sub>O</div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">SF<sub>6</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">NF<sub>3</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">HFCs</div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">PFCs</div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">HFCs</div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #921e43;width:80px;">
                                <div style="width:80px;">PFCs</div>
                            </th>

                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px;">CO<sub>2</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px">CH<sub>4</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px">N<sub>2</sub>O</div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px">SF<sub>6</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px">NF<sub>3</sub></div>
                            </th>

                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px;">CH<sub>4</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px;">N<sub>2</sub>O</div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px;">SF<sub>6</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px;">NF<sub>3</sub></div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px;">HFCs</div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px;">PFCs</div>
                            </th>
                            <th class="text-center align-middle" style="background-color: #3a3939;">
                                <div style="width:50px;">Other</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sum1=0;$sum2=0;$sum3=0;$sum4=0;$sum5=0;$sum6=0;$sum7=0;$sum8=0;$sum9=0;$sum10=0;$sum11=0;$sum_other=0;$sum_total=0;?>
						<?php $sum11=0;$sum12=0;$sum13=0;$sum14=0;$sum15=0;$sum16=0;$sum17=0;$sum18=0;$sum19=0;$sum110=0;$sum111=0;$sum_other1=0;$sum_total1=0;?>
						<?php $sum21=0;$sum22=0;$sum23=0;$sum24=0;$sum25=0;$sum26=0;$sum27=0;$sum28=0;$sum29=0;$sum210=0;$sum211=0;$sum_other2=0;$sum_total2=0;?>
						<?php $sum31=0;$sum32=0;$sum33=0;$sum34=0;$sum35=0;$sum36=0;$sum37=0;$sum38=0;$sum39=0;$sum310=0;$sum311=0;$sum_other3=0;$sum_total3=0;?>
						<?php $topic=0;?>
						<?php 
							//จำนวนหัวข้อย่อย + ช่องรวม + ช่องเพิ่มเติม 
							$count_sub_group = array(
								'1' => $getSubScope[1]['counts']+1, 
								'GHG' => $getSubScope['GHG']['counts']+1+5, 
								'2' => $getSubScope[2]['counts']+1, 
								'3' => $getSubScope[3]['counts']+1 
							);
						?>
                        <?php foreach($getFr04 as $keyItem => $item){ ?>
							<?php if($item['name']!='ข้อมูลต้นไม้'){?>
								<tr style="background-color: rgb(241 245 249);">
									<?php 
									
										if (@is_array($rsScopeValue['count'][$keyItem])) {
											$sum = @array_sum($rsScopeValue['count'][$keyItem]);
										} else {
											// กำหนดค่าเริ่มต้นหรือตั้งค่าผลลัพธ์ให้เหมาะสมหากไม่ใช่อาร์เรย์
											$sum = 0; // หรือค่าเริ่มต้นที่เหมาะสมตามกรณีการใช้งาน
										}
									?>
									<td rowspan="<?=@$sum+$count_sub_group[$keyItem]+1?>" class="align-middle text-center"><span class="fv"><?=$item['name']?></span></td>
								</tr>
								<?php foreach($item['subgroup'] as $keySubItem => $subItem){ ?>
									<tr style="background-color: rgb(248 250 252);">
										<td colspan="41"><p style="color:red;margin:0;"><?=$subItem["name"]?></p></td> <!-- colspan="38" -->
									</tr>
									<?php foreach($subItem['list'] as $keyList => $list){ ?>
										<?php if( !empty($rsScopeValue[$list['scope_id']]['scope_id']) && ($list['scope_id'] == $rsScopeValue[$list['scope_id']]['scope_id']) ){ ?>
											<?php 
												$ef_scope = $ef[$keyItem][$keySubItem][$list['scope_qno']]; 

												$category_scope = $rsScopeValue[$list['scope_id']]['scope_category'];
											?>
											<!-- กรอกแบบข้อมูลผลรวม + กรอกการจ้างเหมารับช่วงของการขนส่งขยะ/มูลฝอย -->
											<?php if(!empty($rsScopeValue[$list['scope_id']]['submit_total'])){ ?>
												<tr>
													<td class="align-middle">- <?=$list['scope_name']?></td>
													<td class="text-center align-middle NonWarp"><?=$list["scope_unit"]?></td>
													<td class="align-middle text-end"><?=number_format(empty($rsScopeValue[$list['scope_id']]['submit_total2'])?$rsScopeValue[$list['scope_id']]['submit_total']:$rsScopeValue[$list['scope_id']]['submit_total2'],4)?></td>
													<!-- ef -->
													<?php for ($i=3;$i<=11;$i++) {?>
														<td class="align-middle text-end"><?=!empty($ef_scope[$i])?number_format($ef_scope[$i],4):0?></td>
														<!-- <?php if($keyItem != 'GHG'){ ?>
															<td class="align-middle text-end"><?=!empty($ef_scope[$i])?$ef_scope[$i]:0?></td>
														<?php }else{ ?>
															<td class="align-middle text-end <?=empty($ef_scope[$i])||$ef_scope[$i]==0?'tddrop':''?>"><?=!empty($ef_scope[$i])?$ef_scope[$i]:''?></td>
														<?php }?> -->
													<?php }?>
													<!-- ef (GHG ที่อยู่นอกข้อกำหนด) -->
													<td class="align-middle text-end <?=$ef_scope[12]==''?'tddrop':''?>"><?=!empty($ef_scope[12])?number_format($ef_scope[12]):''?></td>
													<td class="align-middle text-end <?=$ef_scope[13]==''?'tddrop':''?>"><?=!empty($ef_scope[13])?number_format($ef_scope[13]):''?></td>
													<!-- Total (kgCO2e/หน่วย) -->
													<?php if($category_scope==10){?>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=!empty($ef_scope[14])?efCal(CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5'])):efCal(0)?></td>
													<?php }else if(($category_scope>=5 && $category_scope<=8) || $category_scope==11||$category_scope==12){?>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=!empty($ef_scope[14])?efCal($ef_scope[14]):efCal(0)?></td>
													<?php }else{?>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=@efCal(CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))?></td>
													<?php }?>
													<!-- ที่มา (1st + 2nd + other) -->
													<?php for ($i=15;$i<=21;$i++) {?>
														<td class="align-middle text-center"><?=@$ef_scope['radio']==$i?'<span class="fa-stack"><i class="far fa-circle fa-stack-2x radioCheck-border"></i><i class="fas fa-dot-circle fa-stack-1x fa-lg radioCheck"></i></span>':'<span class="fa-stack"><i class="far fa-circle fa-stack-2x radioNonCheck-border"></i><i class="fas fa-dot-circle fa-stack-1x fa-lg radioNonCheck"></i></span>'?></td>
													<?php }?>
													<td class="align-middle text-end NonWarp"><?=!empty($ef_scope[22])?$ef_scope[22]:''?></td>
													<td class="align-middle text-left NonWarp"> <input class="input-text" type="text" value="<?=!empty($ef_scope[23])?$ef_scope[23]:''?>"></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[3]))/1000,2)?></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[4]))/1000,2)?></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[5]))/1000,2)?></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[6]))/1000,2)?></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[7]))/1000,2)?></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[4])*$ef_scope['gwp2'])/1000,2)?></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[5])*$ef_scope['gwp3'])/1000,2)?></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[6])*$ef_scope['gwp4'])/1000,2)?></td>
													<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[7])*$ef_scope['gwp5'])/1000,2)?></td>
													<?php if($category_scope==10){ //การรั่วไหลของสารทำความเย็น?>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[8])*floatval($ef_scope[10]))/1000,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;" id="total_<?=$list["scope_id"].$keyList?>"><?=@number_format(($rsScopeValue[$list['scope_id']]['submit_total']*CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000,2)?></td>
														<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_<?=$list["scope_id"].$keyList?>" data-total="total_1" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_<?=$list["scope_id"].$keyList?>">xxx_<?=$list["scope_id"].$keyList?></td> 
														<td class="align-middle text-end sum_112" style="background-color:#edffc7;" id="sum_total_12<?=$list["scope_id"].$keyList?>" data-total="total_112" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_12<?=$list["scope_id"].$keyList?>" data-group="1">xxx_<?=$list["scope_id"].$keyList?></td> 
														<td class="align-middle text-end sum_123" style="background-color:#edffc7;" id="sum_total_123<?=$list["scope_id"].$keyList?>" data-total="total_all" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_123<?=$list["scope_id"].$keyList?>" data-group="1">xxx_<?=$list["scope_id"].$keyList?></td>
													<?php }else if(($category_scope>=5&&$category_scope<=8)||$category_scope==11||$category_scope==12){ //การรั่วไหลจากการใช้ปุ๋ย + ผลรวม (ขอบเขต 2,3)?>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end tddrop"></td>
														
														<?php $sco14_total = number_format(empty($rsScopeValue[$list['scope_id']]['submit_total2'])?$rsScopeValue[$list['scope_id']]['submit_total']:$rsScopeValue[$list['scope_id']]['submit_total2'],4);?>
														<td class="align-middle text-end" style="background-color:#edffc7;" dvalue="<?=@number_format(($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000,2)?> " id="total_<?=$list["scope_id"].$keyList?>"><?=@number_format(($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000,2)?></td>
														<?php if($keyItem==1){?>
															<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_<?=$list["scope_id"].$keyList?>" data-total="total_1" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_<?=$list["scope_id"].$keyList?>">xxx_<?=$list["scope_id"].$keyList?></td> 
															<td class="align-middle text-end sum_112" style="background-color:#edffc7;" id="sum_total_12<?=$list["scope_id"].$keyList?>" data-total="total_112" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_12<?=$list["scope_id"].$keyList?>" data-group="1">xxx_<?=$list["scope_id"].$keyList?></td> 
															<td class="align-middle text-end sum_123" style="background-color:#edffc7;" id="sum_total_123<?=$list["scope_id"].$keyList?>" data-total="total_all" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_123<?=$list["scope_id"].$keyList?>" data-group="1">xxx_<?=$list["scope_id"].$keyList?></td>
														<?php }else if($keyItem==2){?>
															<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_<?=$list["scope_id"].$keyList?>" data-total="total_2" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_<?=$list["scope_id"].$keyList?>">xxx_<?=$list["scope_id"].$keyList?></td> 
															<td class="align-middle text-end sum_112" style="background-color:#edffc7;" id="sum_total_12<?=$list["scope_id"].$keyList?>" data-total="total_112" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_12<?=$list["scope_id"].$keyList?>" data-group="2">xxx_<?=$list["scope_id"].$keyList?></td> 
															<td class="align-middle text-end sum_123" style="background-color:#edffc7;" id="sum_total_123<?=$list["scope_id"].$keyList?>" data-total="total_all" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_123<?=$list["scope_id"].$keyList?>" data-group="2">xxx_<?=$list["scope_id"].$keyList?></td>
														<?php }else if($keyItem==3){?> 
															<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_<?=$list["scope_id"].$keyList?>" data-total="total_3" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_<?=$list["scope_id"].$keyList?>">xxx_<?=$list["scope_id"].$keyList?></td> 
															<td class="align-middle text-end sum_112" style="background-color:#edffc7;"><?=number_format(0,2)?></td> 
															<td class="align-middle text-end sum_123" style="background-color:#edffc7;" id="sum_total_123<?=$list["scope_id"].$keyList?>" data-total="total_all" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_123<?=$list["scope_id"].$keyList?>" data-group="3">xxx_<?=$list["scope_id"].$keyList?></td>
														<?php }?> 
													<?php }else if(($category_scope>=5&&$category_scope<=8)){ //การจ้างเหมารับช่วงของการขนส่งขยะ/มูลฝอย?> 
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end tddrop"></td>
														<td class="align-middle text-end" style="background-color:#edffc7;" id="total_<?=$list["scope_id"].$keyList?>"><?=@number_format(($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000,2)?></td>
														<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_<?=$list["scope_id"].$keyList?>" data-total="total_3" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_<?=$list["scope_id"].$keyList?>">xxx_<?=$list["scope_id"].$keyList?></td> 
														<td class="align-middle text-end sum_112" style="background-color:#edffc7;"><?=number_format(0,2)?></td> 
														<td class="align-middle text-end sum_123" style="background-color:#edffc7;" id="sum_total_123<?=$list["scope_id"].$keyList?>" data-total="total_all" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_123<?=$list["scope_id"].$keyList?>" data-group="3">xxx_<?=$list["scope_id"].$keyList?></td>
													<?php }else if($category_scope==13){ //ผลรวม GHG?> 
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;" id="total_1GHG"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[12])*floatval($ef_scope[13]))/1000,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;" id="total_<?=$list["scope_id"].$keyList?>"><?=@number_format(($rsScopeValue[$list['scope_id']]['submit_total']*((floatval($ef_scope[3])*floatval($ef_scope['gwp1']))+(floatval($ef_scope[12])*floatval($ef_scope[13]))))/1000,2)?></td>
														<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_1GHG" data-total="total_1GHG" data-sum="total_1GHG" data-target="sum_total_1GHG">xxx_<?=$list["scope_id"].$keyList?></td> 
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(0,2)?></td>
													<?php }else{ ?>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[8])*floatval($ef_scope[10]))/1000,2)?></td>
														<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[9])*floatval($ef_scope[11]))/1000,2)?></td>
														<td class="align-middle text-end tddrop"></td>
														<td class="align-middle text-end" style="background-color:#edffc7;" id="total_<?=$list["scope_id"].$keyList?>"><?=@number_format(($rsScopeValue[$list['scope_id']]['submit_total']*CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000,2)?></td>
														<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_<?=$list["scope_id"].$keyList?>" data-total="total_1" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_<?=$list["scope_id"].$keyList?>">xxx_<?=$list["scope_id"].$keyList?></td> 
														<td class="align-middle text-end sum_112" style="background-color:#edffc7;" id="sum_total_12<?=$list["scope_id"].$keyList?>" data-total="total_112" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_12<?=$list["scope_id"].$keyList?>" data-group="1">xxx_<?=$list["scope_id"].$keyList?></td> 
														<td class="align-middle text-end sum_123" style="background-color:#edffc7;" id="sum_total_123<?=$list["scope_id"].$keyList?>" data-total="total_all" data-sum="total_<?=$list["scope_id"].$keyList?>" data-target="sum_total_123<?=$list["scope_id"].$keyList?>" data-group="1">xxx_<?=$list["scope_id"].$keyList?></td>
													<?php } ?>
													
													
													<td class="align-middle text-left" ><input class="form-control textref" type="text" name="ref[note_<?=$keyList."_".$list["scope_id"]?>]" value="<?=@$_REF["note_".$keyList."_".$list["scope_id"]]?>" style="width:120px;"></td>
												</tr>
												<?php 
													if($keyItem==1||$keyItem=='GHG'){
														$sum1 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[3]))/1000;
														$sum2 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[4]))/1000;
														$sum3 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[5]))/1000;
														$sum4 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[6]))/1000;
														$sum5 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[7]))/1000;
														$sum6 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[4])*$ef_scope['gwp2'])/1000;
														$sum7 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[5])*$ef_scope['gwp3'])/1000;
														$sum8 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[6])*$ef_scope['gwp4'])/1000;
														$sum9 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[7])*$ef_scope['gwp5'])/1000;
														if($category_scope==10){ //การรั่วไหลของสารทำความเย็น
															$sum_other += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[8])*floatval($ef_scope[10]))/1000;
															$sum_total += ($rsScopeValue[$list['scope_id']]['submit_total']*CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000;
														}else if(($category_scope>=5&&$category_scope<=8)||$category_scope==11){
															$sum_total += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[14]))/1000;
														}else if($category_scope==13){ //ผลรวม GHG
															$sum_other1 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[12])*floatval($ef_scope[13]))/1000;
															$sum_total1 += ($rsScopeValue[$list['scope_id']]['submit_total']*((floatval($ef_scope[3])*floatval($ef_scope['gwp1']))+(floatval($ef_scope[12])*floatval($ef_scope[13]))))/1000;
														}else{
															$sum10	+= ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[8])*floatval($ef_scope[10]))/1000;
															$sum11	+= ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[9])*floatval($ef_scope[11]))/1000;
															$sum_total += ($rsScopeValue[$list['scope_id']]['submit_total']*CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000;
														}
													}else if($keyItem==2){
														$sum21 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[3]))/1000;
														$sum22 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[4]))/1000;
														$sum23 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[5]))/1000;
														$sum24 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[6]))/1000;
														$sum25 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[7]))/1000;
														$sum26 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[4])*$ef_scope['gwp2'])/1000;
														$sum27 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[5])*$ef_scope['gwp3'])/1000;
														$sum28 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[6])*$ef_scope['gwp4'])/1000;
														$sum29 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[7])*$ef_scope['gwp5'])/1000;
														$sum_total2 += ($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000;
													}else if($keyItem==3){
														$sum31 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[3]))/1000;
														$sum32 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[4]))/1000;
														$sum33 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[5]))/1000;
														$sum34 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[6]))/1000;
														$sum35 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[7]))/1000;
														$sum36 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[4])*$ef_scope['gwp2'])/1000;
														$sum37 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[5])*$ef_scope['gwp3'])/1000;
														$sum38 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[6])*$ef_scope['gwp4'])/1000;
														$sum39 += ($rsScopeValue[$list['scope_id']]['submit_total']*floatval($ef_scope[7])*$ef_scope['gwp5'])/1000;
														$sum_total3 += ($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000;
													}
													
												?>
											<!-- กรอกแบบกระบวนการบำบัดน้ำเสีย, Septic tanks, การกำจัดของเสีย/ขยะมูลฝอย -->
											<?php }else if(!empty($rsScopeValue[$list['scope_id']]['scope_detail'])){ ?>	
												<?php foreach($rsScopeValue[$list['scope_id']]['scope_detail'] as $keyDetail => $detail){ ?>
													<tr>
														<td class="align-middle">- <?=$detail['scope_name']?></td>
														<td class="text-center align-middle"><?=empty($detail['submit_unit'])?$list["scope_unit"]:$detail['submit_unit']?></td>
														<td class="align-middle text-end"><?=number_format($detail['submit_total'],4)?></td>
														<!-- ef -->
														<?php if($category_scope==2){ //กรอกแบบกระบวนการบำบัดน้ำเสีย?>
															<?php for ($i=3;$i<=11;$i++) {?>
																<td class="align-middle text-end"><?=!empty($ef_scope[$i])?number_format($ef_scope[$i],4):0?></td>
															<?php }?>
															<!-- ef (GHG ที่อยู่นอกข้อกำหนด) -->
															<td class="align-middle text-end <?=$ef_scope[12]==''?'tddrop':''?>"><?=!empty($ef_scope[12])?number_format($ef_scope[12]):''?></td>
															<td class="align-middle text-end <?=$ef_scope[13]==''?'tddrop':''?>"><?=!empty($ef_scope[13])?number_format($ef_scope[13]):''?></td>
															<!-- Total (kgCO2e/หน่วย) -->
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=!empty($ef_scope[14])?efCal(CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5'])):efCal(0)?></td>
															<!-- ที่มา (1st + 2nd + other) -->
															<?php for ($i=15;$i<=21;$i++) {?>
																<td class="align-middle text-center"><?=@$ef_scope['radio']==$i?'<span class="fa-stack"><i class="far fa-circle fa-stack-2x radioCheck-border"></i><i class="fas fa-dot-circle fa-stack-1x fa-lg radioCheck"></i></span>':'<span class="fa-stack"><i class="far fa-circle fa-stack-2x radioNonCheck-border"></i><i class="fas fa-dot-circle fa-stack-1x fa-lg radioNonCheck"></i></span>'?></td>
															<?php }?>
															<td class="align-middle text-end NonWarp"><?=!empty($ef_scope[22])?$ef_scope[22]:''?></td>
															<td class="align-middle text-left NonWarp"> <input class="input-text" type="text" value="<?=!empty($ef_scope[23])?$ef_scope[23]:''?>"></td>
															
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[3]))/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[4]))/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[5]))/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[6]))/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[7]))/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[4])*$ef_scope['gwp2'])/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[5])*$ef_scope['gwp3'])/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[6])*$ef_scope['gwp4'])/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*floatval($ef_scope[7])*$ef_scope['gwp5'])/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=!empty($ef_scope[8])?number_format(($detail['submit_total']*floatval($ef_scope[8])*floatval($ef_scope[10]))/1000,2):number_format(0,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=!empty($ef_scope[9])?number_format(($detail['submit_total']*floatval($ef_scope[9])*floatval($ef_scope[11]))/1000,2):number_format(0,2)?></td>
															<td class="align-middle text-end tddrop"></td>
															<td class="align-middle text-end" style="background-color:#edffc7;" id="total_<?=$list["scope_id"].$detail['submit_type']?>"><?=@number_format($detail['submit_total']*CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5'])/1000,2)?></td>
															<?php 
																$sum1 	+= ($detail['submit_total']*floatval($ef_scope[3]))/1000;
																$sum2 	+= ($detail['submit_total']*floatval($ef_scope[4]))/1000;
																$sum3 	+= ($detail['submit_total']*floatval($ef_scope[5]))/1000;
																$sum4 	+= ($detail['submit_total']*floatval($ef_scope[6]))/1000;
																$sum5 	+= ($detail['submit_total']*floatval($ef_scope[7]))/1000;
																$sum6 	+= ($detail['submit_total']*floatval($ef_scope[4])*$ef_scope['gwp2'])/1000;
																$sum7 	+= ($detail['submit_total']*floatval($ef_scope[5])*$ef_scope['gwp3'])/1000;
																$sum8 	+= ($detail['submit_total']*floatval($ef_scope[6])*$ef_scope['gwp4'])/1000;
																$sum9 	+= ($detail['submit_total']*floatval($ef_scope[7])*$ef_scope['gwp5'])/1000;
																$sum10	+= ($detail['submit_total']*floatval($ef_scope[8])*floatval($ef_scope[10]))/1000;
																$sum11	+= ($detail['submit_total']*floatval($ef_scope[9])*floatval($ef_scope[11]))/1000;
																$sum_total += $detail['submit_total']*CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5'])/1000;
															?>
														<?php }else if($category_scope==4){ //การกำจัดของเสีย/ขยะมูลฝอย?>
															<?php for ($i=3;$i<=11;$i++) {?>
																<td class="align-middle text-end"><?=getTrashSuffix($detail['submit_type'],$i)!=0?number_format(getTrashSuffix($detail['submit_type'],$i),4):'0'?></td>
															<?php }?>
															<!-- ef (GHG ที่อยู่นอกข้อกำหนด) -->
															<td class="align-middle text-end tddrop"></td>
															<td class="align-middle text-end tddrop"></td>
															<!-- Total (kgCO2e/หน่วย) -->
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=efCal(CalkgCO2e(@getTrashSuffix($detail['submit_type'],3), @getTrashSuffix($detail['submit_type'],4), @getTrashSuffix($detail['submit_type'],5), @getTrashSuffix($detail['submit_type'],6), @getTrashSuffix($detail['submit_type'],7), @getTrashSuffix($detail['submit_type'],8),@getTrashSuffix($detail['submit_type'],9),@getTrashSuffix($detail['submit_type'],10), @getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5']))?></td>
															<!-- ที่มา (1st + 2nd + other) -->
															<?php for ($i=15;$i<=21;$i++) {?>
																<td class="align-middle text-center"><?=@$ef_scope['radio']==$i?'<span class="fa-stack"><i class="far fa-circle fa-stack-2x radioCheck-border"></i><i class="fas fa-dot-circle fa-stack-1x fa-lg radioCheck"></i></span>':'<span class="fa-stack"><i class="far fa-circle fa-stack-2x radioNonCheck-border"></i><i class="fas fa-dot-circle fa-stack-1x fa-lg radioNonCheck"></i></span>'?></td>
															<?php }?>
															<td class="align-middle text-end NonWarp"><?=!empty($ef_scope[22])?$ef_scope[22]:''?></td>
															<td class="align-middle text-left NonWarp"> <input class="input-text" type="text" value="<?=!empty($ef_scope[23])?$ef_scope[23]:''?>"></td>
															
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format($detail['submit_total']*getTrashSuffix($detail['submit_type'],3)/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format($detail['submit_total']*getTrashSuffix($detail['submit_type'],4)/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format($detail['submit_total']*getTrashSuffix($detail['submit_type'],5)/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format($detail['submit_total']*getTrashSuffix($detail['submit_type'],6)/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format($detail['submit_total']*getTrashSuffix($detail['submit_type'],7)/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*getTrashSuffix($detail['submit_type'],4)*$ef_scope['gwp2'])/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*getTrashSuffix($detail['submit_type'],5)*$ef_scope['gwp3'])/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*getTrashSuffix($detail['submit_type'],6)*$ef_scope['gwp4'])/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*getTrashSuffix($detail['submit_type'],7)*$ef_scope['gwp5'])/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*getTrashSuffix($detail['submit_type'],8)*getTrashSuffix($detail['submit_type'],10))/1000,2)?></td>
															<td class="align-middle text-end" style="background-color:#edffc7;"><?=number_format(($detail['submit_total']*getTrashSuffix($detail['submit_type'],9)*getTrashSuffix($detail['submit_type'],11))/1000,2)?></td>
															<td class="align-middle text-end tddrop"></td>
															<?php if($detail['submit_type']==6||$detail['submit_type']==7){?>
																<td class="align-middle text-end" style="background-color:#edffc7;" id="total_<?=$list["scope_id"].$detail['submit_type']?>"><?=@number_format($detail['submit_total']*CalkgCO2e(@getTrashSuffix($detail['submit_type'],3), @getTrashSuffix($detail['submit_type'],4), @getTrashSuffix($detail['submit_type'],5), @getTrashSuffix($detail['submit_type'],6), @getTrashSuffix($detail['submit_type'],7), @getTrashSuffix($detail['submit_type'],8),@getTrashSuffix($detail['submit_type'],9),@getTrashSuffix($detail['submit_type'],10), @getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5']),2)?></td>
															<?php }else{?>
																<td class="align-middle text-end" style="background-color:#edffc7;" id="total_<?=$list["scope_id"].$detail['submit_type']?>"><?=@number_format($detail['submit_total']*CalkgCO2e(@getTrashSuffix($detail['submit_type'],3), @getTrashSuffix($detail['submit_type'],4), @getTrashSuffix($detail['submit_type'],5), @getTrashSuffix($detail['submit_type'],6), @getTrashSuffix($detail['submit_type'],7), @getTrashSuffix($detail['submit_type'],8),@getTrashSuffix($detail['submit_type'],9),@getTrashSuffix($detail['submit_type'],10), @getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5'])/1000,2)?></td>
															<?php }?>
															<?php 
																if($keyItem==1){
																	$sum1 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],3))/1000;
																	$sum2 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],4))/1000;
																	$sum3 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],5))/1000;
																	$sum4 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],6))/1000;
																	$sum5 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],7))/1000;
																	$sum6 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],4)*$ef_scope['gwp2'])/1000;
																	$sum7 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],5)*$ef_scope['gwp3'])/1000;
																	$sum8 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],6)*$ef_scope['gwp4'])/1000;
																	$sum9 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],7)*$ef_scope['gwp5'])/1000;
																	$sum10	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],8)*getTrashSuffix($detail['submit_type'],10))/1000;
																	$sum11	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],9)*getTrashSuffix($detail['submit_type'],11))/1000;
																	if($detail['submit_type']==6||$detail['submit_type']==7){
																		$sum_total += $detail['submit_total']*CalkgCO2e(@getTrashSuffix($detail['submit_type'],3), @getTrashSuffix($detail['submit_type'],4), @getTrashSuffix($detail['submit_type'],5), @getTrashSuffix($detail['submit_type'],6), @getTrashSuffix($detail['submit_type'],7), @getTrashSuffix($detail['submit_type'],8),@getTrashSuffix($detail['submit_type'],9),@getTrashSuffix($detail['submit_type'],10), @getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5']);
																	}else{
																		$sum_total += $detail['submit_total']*CalkgCO2e(@getTrashSuffix($detail['submit_type'],3), @getTrashSuffix($detail['submit_type'],4), @getTrashSuffix($detail['submit_type'],5), @getTrashSuffix($detail['submit_type'],6), @getTrashSuffix($detail['submit_type'],7), @getTrashSuffix($detail['submit_type'],8),@getTrashSuffix($detail['submit_type'],9),@getTrashSuffix($detail['submit_type'],10), @getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5'])/1000;
																	}
																}else if($keyItem==3){
																	$sum31 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],3))/1000;
																	$sum32 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],4))/1000;
																	$sum33 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],5))/1000;
																	$sum34 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],6))/1000;
																	$sum35 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],7))/1000;
																	$sum36 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],4)*$ef_scope['gwp2'])/1000;
																	$sum37 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],5)*$ef_scope['gwp3'])/1000;
																	$sum38 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],6)*$ef_scope['gwp4'])/1000;
																	$sum39 	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],7)*$ef_scope['gwp5'])/1000;
																	$sum310	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],8)*getTrashSuffix($detail['submit_type'],10))/1000;
																	$sum311	+= ($detail['submit_total']*getTrashSuffix($detail['submit_type'],9)*getTrashSuffix($detail['submit_type'],11))/1000;
																	if($detail['submit_type']==6||$detail['submit_type']==7){
																		$sum_total3 += $detail['submit_total']*CalkgCO2e(@getTrashSuffix($detail['submit_type'],3), @getTrashSuffix($detail['submit_type'],4), @getTrashSuffix($detail['submit_type'],5), @getTrashSuffix($detail['submit_type'],6), @getTrashSuffix($detail['submit_type'],7), @getTrashSuffix($detail['submit_type'],8),@getTrashSuffix($detail['submit_type'],9),@getTrashSuffix($detail['submit_type'],10), @getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5']);
																	}else{
																		$sum_total3 += $detail['submit_total']*CalkgCO2e(@getTrashSuffix($detail['submit_type'],3), @getTrashSuffix($detail['submit_type'],4), @getTrashSuffix($detail['submit_type'],5), @getTrashSuffix($detail['submit_type'],6), @getTrashSuffix($detail['submit_type'],7), @getTrashSuffix($detail['submit_type'],8),@getTrashSuffix($detail['submit_type'],9),@getTrashSuffix($detail['submit_type'],10), @getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5'])/1000;
																	}
																}
																
															?>
														<?php }?>
														<?php if($keyItem==1){ ?>
															<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_<?=$list["scope_id"].$detail['submit_type']?>" data-total="total_1" data-sum="total_<?=$list["scope_id"].$detail['submit_type']?>" data-target="sum_total_<?=$list["scope_id"].$detail['submit_type']?>">xxx_<?=$list["scope_id"].$detail['submit_type']?></td> 
															<td class="align-middle text-end sum_112" style="background-color:#edffc7;" id="sum_total_12<?=$list["scope_id"].$detail['submit_type']?>" data-total="total_112" data-sum="total_<?=$list["scope_id"].$detail['submit_type']?>" data-target="sum_total_12<?=$list["scope_id"].$detail['submit_type']?>" data-group="1">xxx_<?=$list["scope_id"].$detail['submit_type']?></td> 
															<td class="align-middle text-end sum_123" style="background-color:#edffc7;" id="sum_total_123<?=$list["scope_id"].$detail['submit_type']?>" data-total="total_all" data-sum="total_<?=$list["scope_id"].$detail['submit_type']?>" data-target="sum_total_123<?=$list["scope_id"].$detail['submit_type']?>" data-group="1">xxx_<?=$list["scope_id"].$detail['submit_type']?></td> 
														<?php }else if($keyItem==3){?>
															<td class="align-middle text-end sum_100" style="background-color:#edffc7;" id="sum_total_<?=$list["scope_id"].$detail['submit_type']?>" data-total="total_3" data-sum="total_<?=$list["scope_id"].$detail['submit_type']?>" data-target="sum_total_<?=$list["scope_id"].$detail['submit_type']?>">xxx_<?=$list["scope_id"].$detail['submit_type']?></td> 
															<td class="align-middle text-end sum_112" style="background-color:#edffc7;"><?=number_format(0,2)?></td> 
															<td class="align-middle text-end sum_123" style="background-color:#edffc7;" id="sum_total_123<?=$list["scope_id"].$detail['submit_type']?>" data-total="total_all" data-sum="total_<?=$list["scope_id"].$detail['submit_type']?>" data-target="sum_total_123<?=$list["scope_id"].$detail['submit_type']?>" data-group="3">xxx_<?=$list["scope_id"].$detail['submit_type']?></td> 
														<?php }?>
														
														<td class="align-middle text-left" ><input class="form-control textref" type="text" name="ref[note_<?=$detail['submit_type']."_".$list["scope_id"]?>]" value="<?=@$_REF["note_".$detail['submit_type']."_".$list["scope_id"]]?>" style="width:120px;"></td>
													</tr>
													
												<?php } ?>	
											<?php } ?>	
										<?php } ?>
									<?php } ?>
									<!-- ช่องเพิ่ม 4 แถวของขอบเขต GHG -->
									<?php if($keyItem == 'GHG'){ ?>
										<?php for ($i=1; $i<=5; $i++) { ?>
											<tr>
												<td class="align-middle tddrop"></td>
												<td class="text-center align-middle tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>

												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-center tddrop"></td>
												<td class="align-middle text-center tddrop"></td>
												<td class="align-middle text-center tddrop"></td>
												<td class="align-middle text-center tddrop"></td>
												<td class="align-middle text-center tddrop"></td>
												<td class="align-middle text-center tddrop"></td>
												<td class="align-middle text-center tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-left tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop"></td>
												<td class="align-middle text-end tddrop" id="total_<?=$list["scope_id"].$keyList?>"></td>
												<td class="align-middle text-end tddrop"></td> 
												<td class="align-middle text-end tddrop"></td> 
												<td class="align-middle text-end tddrop"></td> 
												
												<td class="align-middle text-left tddrop"><input class="form-control tddrop" type="text" name="ref[note_<?=$keyList."_".$list["scope_id"]?>]" value="<?=@$_REF["note_".$keyList."_".$list["scope_id"]]?>" style="width:120px;" readonly></td>
											</tr>
										<?php } ?>
									<?php } ?>	
								<?php } ?>
								<?php if($keyItem==1){?>
									<tr class="scope_total">
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>

										<td class="text-end align-middle"><?=number_format($sum1,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum2,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum3,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum4,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum5,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum6,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum7,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum8,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum9,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum10,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum11,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum_other,2)?></td>
										<td class="text-end align-middle" id="total_1"><?=number_format($sum_total,2)?></td> <!-- jaydai -->
										<td class="text-end align-middle sum_100" id="sum_total_1" data-total="total_1" data-sum="total_1" data-target="sum_total_1">sum_100</td> <!-- jaydai -->
										<td class="text-end align-middle sum_112" id="sum_total_1121" data-total="total_112" data-sum="total_1" data-target="sum_total_1121">sum_1121</td> <!-- jaydai -->
										<td class="text-end align-middle sum_123" id="sum_total_1231" data-total="total_all" data-sum="total_1" data-target="sum_total_1231">sum_1231</td> <!-- jaydai -->
										<td class="text-end align-middle"></td>
									</tr>
								<?php }else if($keyItem=='GHG'){?>
									<tr class="scope_total">
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>

										<td class="text-end align-middle"><?=number_format($sum11,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum12,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum13,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum14,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum15,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum16,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum17,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum18,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum19,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum110,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum111,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum_other1,2)?></td>
										<td class="text-end align-middle" id="total_1"><?=number_format($sum_total1,2)?></td> <!-- jaydai -->
										<td class="align-middle text-end sum_100" id="sum_total_1GHG" data-total="total_1GHG" data-sum="total_1GHG" data-target="sum_total_1GHG">xxx_<?=$subItem["scope_id"].$keyList?></td> 
										<td class="text-end align-middle"><?=number_format(0,2)?></td>
										<td class="text-end align-middle"><?=number_format(0,2)?></td>
										<td class="text-end align-middle"></td>
									</tr>
								<?php }else if($keyItem=='2'){?>
									<tr class="scope_total">
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>

										<td class="text-end align-middle"><?=number_format($sum21,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum22,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum23,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum24,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum25,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum26,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum27,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum28,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum29,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum210,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum211,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum_other2,2)?></td>
										<td class="text-end align-middle" id="total_2"><?=number_format($sum_total2,2)?></td> <!-- jaydai -->
										<td class="text-end align-middle sum_100" id="sum_total_2" data-total="total_2" data-sum="total_2" data-target="sum_total_2">xxx_<?=$subItem["scope_id"].$keyList?>XXX</td> <!-- jaydai -->
										<td class="text-end align-middle sum_112" id="sum_total_1122" data-total="total_112" data-sum="total_2" data-target="sum_total_1122">sum_1122</td> <!-- jaydai -->
										<td class="text-end align-middle sum_123" id="sum_total_1232" data-total="total_all" data-sum="total_2" data-target="sum_total_1232">sum_1232</td> <!-- jaydai -->
										<td class="text-end align-middle"></td>
									</tr>
								<?php }else if($keyItem=='3'){?>
									<tr class="scope_total">
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>
										<td class="text-center align-middle"></td>

										<td class="text-end align-middle"><?=number_format($sum31,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum32,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum33,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum34,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum35,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum36,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum37,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum38,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum39,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum310,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum311,2)?></td>
										<td class="text-end align-middle"><?=number_format($sum_other3,2)?></td>
										<td class="text-end align-middle" id="total_3"><?=number_format($sum_total3,2)?></td>
										<td class="text-end align-middle sum_100" id="sum_total_1" data-total="total_3" data-sum="total_3" data-target="sum_total_3">sum_100</td> 
										<td class="text-end align-middle"><?=number_format(0,2)?></td>
										<td class="text-end align-middle sum_123" id="sum_total_1233" data-total="total_all" data-sum="total_3" data-target="sum_total_1233">sum_1233</td> 
										<td class="text-end align-middle"></td>
									</tr>
								<?php } ?>
							<?php } ?>
						<?php } ?>

                        <tr class="">
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum1,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum2,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum3,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum4,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum5,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum6,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum7,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum8,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum9,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum10,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum11,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum_other,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;" id="total_112"><?=number_format($sum_total+$sum_total2,2)?></span></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
						</tr>
						<tr class="">
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum1+$sum31,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum2+$sum32,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum3+$sum33,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum4+$sum34,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum5+$sum35,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum6+$sum36,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum7+$sum37,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum8+$sum38,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum9+$sum39,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum10+$sum310,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum11+$sum311,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;"><?=number_format($sum_other,2)?></span></td>
							<td class="text-end align-middle" style="background-color: #ffe600;color: #333;"><span style="font-weight: bold;text-decoration: underline;" id="total_all"><?=number_format($sum_total+$sum_total2+$sum_total3,2)?></span></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
							<td class="text-center align-middle tddrop"></td>
						</tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
			function parseFloatIgnoreCommas(number) {
				var numberNoCommas = number.replace(/,/g, '');
				return parseFloat(numberNoCommas);
			}
			function submit_confirm() {
				var r = confirm("คำเตือน!!!\nกรุณากรอกข้อมูลทั้งหมดในส่วนบันทึกข้อมูลก๊าซเรือนกระจกองค์กรให้เสร็จเรียบร้อยก่อนกด\"บันทึก\"ไม่เช่นนั้นท่านจะต้องกำหนดค่า GHG ของท่านเอง!");
				if (r == true) {
					$('#form_fr04').submit();
				} else {
					return;
				}
			}
			$(document).ready(function(){
				if($('.sum_100').length)
				{
					$(".sum_100").each(function( index ) {
						var id_total_scope = $(this).attr('data-total');
						var id_sum = $(this).attr('data-sum');
						let total = parseFloatIgnoreCommas($('#'+id_total_scope).text());
						let sum = parseFloatIgnoreCommas($('#'+id_sum).text());
						let sum_100 = sum/total*100;
						$(this).html(sum_100.toFixed(2));
						
					});
				}
				if($('.sum_112').length)
				{
					let sum_112_1=0,sum_112_2=0;
					$(".sum_112").each(function( index ) {
						var id_total_scope = $(this).attr('data-total');
						var id_sum = $(this).attr('data-sum');
						let total = parseFloatIgnoreCommas($('#'+id_total_scope).text());
						let sum = parseFloatIgnoreCommas($('#'+id_sum).text());
						let sum_112 = sum/total*100;
						$(this).html(sum_112.toFixed(2));
					});
				}
				if($('.sum_123').length)
				{
					let sum_123_1=0,sum_123_2=0,sum_123_3=0;
					$(".sum_123").each(function( index ) {
						var id_total_scope = $(this).attr('data-total');
						var id_sum = $(this).attr('data-sum');
						let total = parseFloatIgnoreCommas($('#'+id_total_scope).text());
						let sum = parseFloatIgnoreCommas($('#'+id_sum).text());
						let sum_123 = sum/total*100;
						$(this).html(sum_123.toFixed(2));
					});
				}
				function walkText(node) {
					if (node.nodeType == 3) {
						node.data = node.data.replace(/nan/g, "0.00");
						node.data = node.data.replace(/NaN/g, "0.00");
					}
					if (node.nodeType == 1 && node.nodeName != "SCRIPT") {
						for (var i = 0; i < node.childNodes.length; i++) {
						walkText(node.childNodes[i]);
						}
					}
				}
				walkText(document.body);
			});
		</script>

</div>
<?php 
$tab_ck  =$this->input->get('fr');
?>
<div class="tab-pane fade <?= $tab_ck == 5 ? 'show active' : '' ?>" id="fr5" role="tabpanel">
    

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
							<?php 
							$summmm_1 = 0;
							$summmm_2 = 0;
							if ($s1_2 != 0) {
								$summmm_1 = $s1 * 100 / $s1_2;
							}else{
								$summmm_1 = 0;
							}

							if ($s1_3 != 0) {
								$summmm_2 = $s1 * 100 / $s1_3;
							}else{
								$summmm_2 = 0;
							}
							?>
                            <?= @number_format($summmm_1, 2) ?>
                        </td>
                        <td class="number">
                            <?= @number_format($summmm_2, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #b1dbef;">ประเภท 2</td>
                        <td class="number">
                            <?= @number_format($s2) ?>
                        </td>
                        <td class="number">
							<?php 
							$summmm_1 = 0;
							$summmm_2 = 0;
							$summmm_3 = 0;
							if ($s1_2 != 0) {
								$summmm_1 = $s2 * 100 / $s1_2;
							}else{
								$summmm_1 = 0;
							}
							if ($s1_3 != 0) {
								$summmm_2 = $s2 * 100 / $s1_3;
							}else{
								$summmm_2 = 0;
							}
							if ($s1_3 != 0) {
								$summmm_3 = $s3 * 100 / $s1_3;
							}else{
								$summmm_3 = 0;
							}
							?>
                            <?= @number_format($summmm_1, 2) ?>
                        </td>
                        <td class="number">
                            <?= @number_format($summmm_2, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #b1dbef;">ประเภท 3</td>
                        <td class="number">
                            <?= @number_format($s3) ?>
                        </td>
                        <td rowspan="2"></td>
                        <td class="number">
                            <?= @number_format($summmm_3, 2) ?>
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
        <div class="col-md-7">
			<div id="sp_container" style="width:100%"></div>
		</div>
    </div>
</div>

<script>
			Highcharts.setOptions({
					lang: {
						thousandsSep: ','
					}
				});

			var chart = Highcharts.chart('sp_container', {

				title: {text: '' },
				subtitle: {text: ''},
				xAxis: {categories: ['ประเภท 1', 'ประเภท 2', 'ประเภท 3', 'อื่นๆ'],
				labels: {
							style: {
								//color: 'red',
								fontSize:'16px'
							}
						}},
				credits: {enabled: false},
				plotOptions: {
						series: {
							borderWidth: 0,
							dataLabels: {
								enabled: true                       
							},
							
						}
					},        
					
				yAxis: [{
					labels: {
							format: '{value:,.0f}'
						},
						
							title: {
								useHTML: true,
								text: 'tonCO'+'<sub>2</sub>'+'eq'
							},
							lineWidth: 1,
							opposite:false,
							
						}],
				tooltip: { enabled: false },
				series: [{
					type: 'column',
					color: '#666',
				// colorByPoint: true,
					data: [<?=$s1?>, <?=$s2?>, <?=$s3?>, <?=$sGHG?>],
					showInLegend: false
				}]

			});
			var chart = Highcharts.chart('sp2_container', {

				title: {text: '' },
				subtitle: {text: ''},
				xAxis: {categories: ['ประเภท 1', 'ประเภท 2', 'ประเภท 3', 'อื่นๆ'],
				labels: {
							style: {
								//color: 'red',
								fontSize:'16px'
							}
						}},
				credits: {enabled: false},
				plotOptions: {
						series: {
							borderWidth: 0,
							dataLabels: {
								enabled: true                       
							},
							
						}
					},        
					
				yAxis: [{
					labels: {
							format: '{value:,.0f}'
						},
						
							title: {
								useHTML: true,
								text: 'tonCO'+'<sub>2</sub>'+'eq'
							},
							lineWidth: 1,
							opposite:false,
							
						}],
				tooltip: { enabled: false },
				series: [{
					type: 'column',
					color: '#666',
				// colorByPoint: true,
					data: [<?=$s1?>, <?=$s2?>, <?=$s3?>, <?=$sGHG?>],
					showInLegend: false
				}]

			});
		</script>