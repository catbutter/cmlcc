<?php $admin = $this->session->userdata('admin_logged_in'); ?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">กำหนดขอบเขตข้อมูล</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">กำหนดขอบเขตข้อมูล</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
    <button data-bs-toggle="modal" data-bs-target="#sourceModal" class="btn btn-sm btn-info me-2"><i class='bx bx-plus' ></i> เพิ่มรายการ</button>
	</div>
</div>
<style>
    input[type="number"] {
        -moz-appearance: textfield;
    }
    input[type="number"]:hover,
    input[type="number"]:focus {
        -moz-appearance: number-input;
    }
    .btn i {margin:0;}
    html.dark-theme .table thead th{font-weight: normal;}
    html.dark-theme .form-control{font-size: 13px;}

    .bg-green {
        background-color: #10b981 !important;
    }

    .bg-green2 {
        background-color: #65a30d !important;
    }

    .bg-purple {
        background-color: #4c1d95 !important;
    }

    .bg-purple2 {
        background-color: #581c87 !important;
    }

    .bg-green2 {
        background-color: #65a30d !important;
    }

    .bg-red {
        background-color: #be123c !important;
    }

    .bg-red2 {
        background-color: #831843 !important;
    }

    .bg-blue {
        background-color: #1e3a8a !important;
    }

    .bg-gray{
        background-color: #eee !important;
    }
    .bg-gray2{
        background-color: #94a3b8 !important;
    }

    .tableFixHead .btn{padding: 0 7px !important;}
    .tableFixHead {
        overflow: auto;
        height: 70vh;
        width: 100%;
    }
    .tableFixHead thead {
        position: sticky;
        top: 0;
        z-index: 999;
    }
    .tableFixHead tbody td.tl {
        position: sticky;
        left: 0;
       
        z-index: 99;
        background-color: #94a3b8;
    }

</style>
<?php 
	$year_value="";
	$year_name ="";
	$active="";
	$isshow="";
	$createdate=date('Y-m-d H:i:s');
	//ef
	$configEf = $rsConfigEf;
	if($rs!=null){
		$year_value=$rs[0]->year_value;
		$year_name =$rs[0]->year_name;
		$active=$rs[0]->active;
		$isshow=$rs[0]->isshow;
		$createdate=$rs[0]->createdate;
	}
	
?>

<div class="card">
    <div class="card-body">

    <form class="form-horizontal" method="post" role="form" id="fr0" style="display:none"> 
        <div class="row mb-3">
            <label for="year_value" class="col-sm-3 col-form-label">ปี พ.ศ.</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="year_value" id="year_value" title="ปี พ.ศ." required value="<?=$year_value?>"  readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="year_name" class="col-sm-3 col-form-label">ปี พ.ศ.</label>
            <div class="col-sm-4">
            <input type="text" class="form-control" name="year_name" id="year_name" title="ปีงบประมาณ" required value="<?=$year_name?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="isshow" class="col-sm-3 col-form-label">สถานะการใช้งาน</label>
            <div class="col-sm-4">
                <div class="radio-list pl-12">
					<label class="radio-inline">
					<input type="radio" name="isshow" value="1" <?=$isshow==1?'checked':''?> <?=$isshow==''?'checked':''?>> เปิดใช้งาน </label>
					<label class="radio-inline">
					<input type="radio" name="isshow" value="0" <?=$isshow==0?'checked':''?> > ปิด </label>	
				</div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="isshow" class="col-sm-3 col-form-label">เลือกเป็นปีหลัก</label>
            <div class="col-sm-4">
                <div class="radio-list pl-12">
					<label class="radio-inline">
					<input type="radio" name="active" value="1" <?=$active==1?'checked':''?> <?=$active==''?'checked':''?>> active </label>
					<label class="radio-inline">
					<input type="radio" name="active" value="0" <?=$active==0?'checked':''?> > null </label>	
				</div>
            </div>
        </div>		
	</form>
    

        <div class="tableFixHead">
            <div class="table-responsivse">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center align-middle bg-green" rowspan="4">ขอบเขต</th>
                        <th class="text-center align-middle bg-purple" rowspan="4"><div style="width:350px;">รายการ</div></th>
                        <th class="text-center align-middle bg-purple2" rowspan="4"><div style="width:150px;">ประเภทการกรอกข้อมูล</div></th>
                        <th class="text-center align-middle bg-green2" rowspan="4"><div style="width:120px;">หน่วย</div></th>
                        <th class="text-center align-middle bg-red" rowspan="3" colspan="5">ค่า GWP</th>
                        <th class="text-center align-middle bg-red2" rowspan="2" colspan="9">GHG
                            ที่ต้องรายงานตามข้อกำหนด
                        </th>
                        <th class="text-center align-middle bg-red2" rowspan="2" colspan="2">GHG ที่อยู่นอกข้อกำหนด
                        </th>
                        <th class="text-center align-middle bg-red2" rowspan="4"><div style="width:150px;">Total (kgCO2e/หน่วย)</div></th>
                        <th class="text-center align-middle bg-blue" rowspan="1" colspan="7">ที่มา</th>
                        <th class="text-center align-middle bg-blue" rowspan="4"><div style="width:120px;">
                            <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">Subsitute</div></div>
                        </th>
                        <th class="text-center align-middle bg-blue min-w-20vw rounded-tr-md" rowspan="4"><div style="width:300px;">แหล่งอ้างอิง</div>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center align-middle bg-blue" colspan="2">1<sup>st</sup></th>
                        <th class="text-center align-middle bg-blue" colspan="4">2<sup>nd</sup></th>
                        <th class="text-center align-middle bg-blue min-w-fit" rowspan="3">
                            <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">Other</div>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center align-middle bg-red2" colspan="7">ค่า EF (kg GHG/หน่วย)</th>
                        <th class="text-center align-middle bg-red2" colspan="2">GWP<sub>100</sub></th>
                        <th class="text-center align-middle bg-red2" rowspan="2"><div style="width:120px;">ค่า EF (kg GHG/หน่วย</div></th>
                        <th class="text-center align-middle bg-red2" rowspan="2"><div style="width:120px;">GWP<sub>100</sub></div></th>
                        <th class="text-center align-middle bg-blue whitespace-nowrap min-w-fit" rowspan="2">
                            <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">Self collct</div>
                        </th>
                        <th class="text-center align-middle bg-blue whitespace-nowrap min-w-fit" rowspan="2">
                            <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">Supplier</div>
                        </th>
                        <th class="text-center align-middle bg-blue whitespace-nowrap min-w-fit" rowspan="2">
                            <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">TH LCI DB</div>
                        </th>
                        <th class="text-center align-middle bg-blue whitespace-nowrap min-w-fit" rowspan="2">
                            <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">TGO EF</div>
                        </th>
                        <th class="text-center align-middle bg-blue whitespace-nowrap min-w-fit" rowspan="2">
                            <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">Thai Res.</div>
                        </th>
                        <th class="text-center align-middle bg-blue whitespace-nowrap min-w-fit" rowspan="2">
                            <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">Int. DB</div>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center align-middle bg-red"><div style="width:120px;">CO<sub>2</sub></div></th>
                        <th class="text-center align-middle bg-red"><div style="width:120px;">CH<sub>4</sub></div></th>
                        <th class="text-center align-middle bg-red"><div style="width:120px;">N<sub>2</sub>O</div></th>
                        <th class="text-center align-middle bg-red"><div style="width:120px;">SF<sub>6</sub></div></th>
                        <th class="text-center align-middle bg-red"><div style="width:120px;">NF<sub>3</sub></div></th>

                        <th class="text-center align-middle bg-red2"><div style="width:120px;">CO<sub>2</sub></div></th>
                        <th class="text-center align-middle bg-red2"><div style="width:120px;">CH<sub>4</sub></div></th>
                        <th class="text-center align-middle bg-red2"><div style="width:120px;">N<sub>2</sub>O</div></th>
                        <th class="text-center align-middle bg-red2"><div style="width:120px;">SF<sub>6</sub></div></th>
                        <th class="text-center align-middle bg-red2"><div style="width:120px;">NF<sub>3</sub></div></th>
                        <th class="text-center align-middle bg-red2"><div style="width:120px;">HFC<sub>s</sub></div></th>
                        <th class="text-center align-middle bg-red2"><div style="width:120px;">PFC<sub>s</sub></div></th>
                        <th class="text-center align-middle bg-red2"><div style="width:120px;">HFC<sub>s</sub></div></th>
                        <th class="text-center align-middle bg-red2"><div style="width:120px;">PFC<sub>s</sub></div></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rsConfigEf as $k => $v) { ?>
                        <form class="form-horizontal" method="post" role="form" id="fr<?= $k ?>">

                            <tr>
                                <td class="bg-gray2 text-body text-center align-middle" rowspan="<?= $v['count'] + 1 ?>">
                                    <div class="-rotate-180" style="writing-mode: vertical-rl;margin: 0 auto;">
                                        <?= $v['name'] ?>
                                    </div>
                                </td>
                            </tr>
                            <?php foreach ($v['subgroup'] as $kk => $vv) { ?>
                                <tr>
                                    <td class="bg-gray text-body" colspan="29">
                                        <?= $vv['name'] ?>
                                    </td>
                                </tr>
                                <?php for ($r = 1; $r <= $vv['count']; $r++) { ?>
                                    <?php //for ($vv['list'] as $key => $r) {?>
                                    <tr>
                                        <!-- NAME -->
                                        <td class="tl text-center border-0 border-slate-400 p-3">
                                            <div class="d-flex justify-content-start">
                                                <button type="button" onclick="delSource(<?= $k ?>,<?= $kk ?>,<?= $vv['list'][($r - 1)]['scope_id'] ?>)" class="del btn btn-danger btn-sm me-2"><i class='bx bx-trash-alt'></i></button>
                                               
                                                <input type="text" name="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][1]"
                                                    id="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][1]"
                                                    value="<?= !empty($ef[$k][$kk][$r][1]) ? $ef[$k][$kk][$r][1] : '' ?>"
                                                    class="form-control">
                                            </div>
                                        </td>
                                        <!-- CATEGORY-FORM -->
                                        <td class="text-center border-0 border-slate-400 p-3">
                                            <select name="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][category_form]"
                                                id="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][category_form]" autocomplete="category"
                                                class="form-control">
                                                <?php foreach ($rsCategory as $key => $value) { ?>
                                                    <option value=<?= $value->scf_id ?>
                                                        <?= !empty($ef[$k][$kk][$r]['category_form']) && ($ef[$k][$kk][$r]['category_form'] == $value->scf_id) ? 'selected' : ''; ?>>
                                                        <?= $value->scf_name ?> </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <!-- UNIT -->
                                        <td class="text-center border-0 border-slate-400 p-3">
                                            <input type="text" name="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][2]" id="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][2]" value="<?= !empty($ef[$k][$kk][$r][2]) ? $ef[$k][$kk][$r][2] : '' ?>" class="form-control">
                                        </td>
                                        <!-- GWP -->
                                        <?php $default_gwp = ['1' => 1, '2' => 28, '3' => 265, '4' => 23500, '5' => 16100] ?>
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <td class="text-center border-0 border-slate-400 p-3">
                                                <input type="number" name="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][gwp<?= $i ?>]" id="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][gwp<?= $i ?>]" value="<?= !empty($ef[$k][$kk][$r]['gwp' . $i]) ? $ef[$k][$kk][$r]['gwp' . $i] : $default_gwp[$i] ?>" class="form-control ">
                                            </td>
                                        <?php } ?>
                                        <?php for ($i = 3; $i <= 14; $i++) { ?>
                                            <td class="text-center border-0 border-slate-400 p-3">
                                                <input type="number" name="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][<?= $i ?>]" id="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][<?= $i ?>]" value="<?= !empty($ef[$k][$kk][$r][$i]) ? $ef[$k][$kk][$r][$i] : '' ?>" class="form-control">
                                            </td>
                                        <?php } ?>
                                        <?php for ($i = 15; $i <= 21; $i++) { ?>
                                            <td class="text-center border-0 border-slate-400 min-w-fit p-3">
                                                <input type="radio" name="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][radio]" value="<?= $i ?>"
                                                    class="form-radio" <?php echo !empty($ef[$k][$kk][$r]['radio']) && ($ef[$k][$kk][$r]['radio'] == $i) ? 'checked' : '' ?>>
                                            </td>
                                        <?php } ?>
                                        <?php for ($i = 22; $i <= 23; $i++) { ?>
                                            <td class="text-center border-0 border-slate-400 p-3">
                                                <input type="text" name="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][<?= $i ?>]"
                                                    id="ef[<?= $k ?>][<?= $kk ?>][<?= $r ?>][<?= $i ?>]"
                                                    value="<?= !empty($ef[$k][$kk][$r][$i]) ? $ef[$k][$kk][$r][$i] : '' ?>"
                                                    class="form-control ">
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            <?php } ?>

                           
                        </form>

                    <?php } ?>
                </tbody>
            </table>
            
            </div>
            
        </div>
       
        <div class="mt-3">
            <div class="row">
                <div class="col-md-6 text-start">
                    
                </div>
                <div class="col-md-6 text-end">
                    <a href="/admin/ef" class="btn btn-sm btn-secondary me-2"><i class='bx bx-undo' ></i> ยกเลิก</a>
                    <button onclick="submitForms()" class="btn btn-sm btn-primary"><i class='bx bx-save'></i> บันทึก</button>
                </div>
            </div>
		</div>
    </div>
</div>

<div class="modal modal-lg fade" id="sourceModal" tabindex="-1"  aria-labelledby="sourceModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
                
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class='bx bx-data' ></i> เพิ่มรายการ</h1><br/>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                            
				
			</div>
			<div class="modal-body">
                
                <p class="text-danger">กรุณากรอกข้อมูลให้ครบถ้วนตามที่มีเครื่องหมาย *</p>
                
               
				<form class="form-horizontal" method="post" role="form" id="frAddSource">
					<div class="form-group mb-3">
						<label for="source_name">ชื่อรายการ</label>
						<input type="text" name="source_name" id="source_name" title="" required class="form-control">
					</div>
					<div class="form-group mb-3">
						<label for="">ขอบเขต</label>
						<div class="radio-list pl-12">
							<?php foreach($rsScope as $key => $value){ ?>
								<label class="radio-inline">
									<input type="radio" name="scope_group" value="<?=$value->s_id?>" <?=$key==0?'checked':''?> data-scope="<?=$value->s_id?>"> <?=$value->s_name?>
								</label>
							<?php } ?> 
						</div>
					</div>	
					<div class="radio-list-sub-scope mb-6 mb-3">
						<label for="">ขอบเขตย่อย</label>
						<?php foreach($rsScope1 as $key => $value){ ?>
							<div class="radio-custom pl-4">
								<label class="radio-inline">
									<input type="radio" name="scope_sub_group" value="<?=$key+1?>" <?=$key==0?"checked":""?> data-scope="<?=$rsScope[0]->s_id?>" data-sub-scope="<?=$key+1?>"> <?=$value->ss_name?>
								</label>
							</div> 
						<?php } ?>
					</div>											
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="me-2 btn btn-sm btn-secondary" data-bs-dismiss="modal"><i class='bx bx-undo' ></i> ยกเลิก</button>
				<button onclick="addSource()" class="btn btn-sm btn-primary"><i class='bx bx-save' ></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.js"></script>
<script>
    function submitForms() {
		var scope = ['0','1','GHG','2','3','4'];
		$.each(scope, function( index, value ){
            $.post("<?php echo base_url('admin/myear_ef/?sm=')?>"+value, 
                $('#fr'+value).serialize(),
                function (data) {
					if(data){
						// console.log(data);
						Swal.fire({
							icon: 'success',
							title: 'บันทึกข้อมูลเรียบร้อย.',
							showConfirmButton: false,
							timer: 1500
						}).then((result) => {
							location.reload();
						});
					}
                }
            );
        });
    }

    function addSource(){
		if($('#source_name').val() != ''){
			$.post(
				"<?php echo base_url('admin/myear_ef_set_scope/'.$this->uri->segment(4))?>", 
				$('#frAddSource').serialize(),
				function (data) {
					if(data){
						console.log(data);
						Swal.fire({
							icon: 'success',
							title: 'บันทึกรายการเรียบร้อย.',
							showConfirmButton: false,
							timer: 1500
						}).then((result) => {
							location.reload();
						});
					}
				}
			);
		}else{
			Swal.fire({
				icon: 'error',
				title: 'ท่านไม่ได้กรอกชื่อรายการ.',
				showConfirmButton: true,
				confirmButtonText: 'ปิด'
			});
		}
	}

    function delSource(scope,subScope,index){
		if(scope != '' && subScope != '' && index != ''){
			Swal.fire({
				title: 'คุณแน่ใจไหม?',
				text: "คุณยืนยันที่จะลบรายการนี้ใช่หรือไม่!",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#f43f5e',
				cancelButtonColor: '#475569',
				confirmButtonText: 'ใช่, ต้องการลบรายการ!',
				cancelButtonText: 'ยกเลิก',
			}).then((result) => {
				if (result.isConfirmed) {
					$.post(
						"<?php echo base_url('admin/myear_ef_del_scope/'.$this->uri->segment(4))?>", 
						{scope_group: scope, scope_sub_group: subScope, scope_id: index},
						function (data) {
							if(data){
								console.log(data);
								Swal.fire({
									title: 'ลบเรียบร้อย!',
									text: "รายการได้ถูกลบออกจากระบบเรียบร้อย.",
									icon: 'success',
									showConfirmButton: true,
									confirmButtonText: 'ปิด'
								}).then((result2) => {
									if (result2.isConfirmed) {
										location.reload();
									}
								});
							}
						}
					);
				}
			});
		}else{
			Swal.fire({
				icon: 'error',
				title: 'เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง',
				showConfirmButton: true,
			});
		}
	}

    function getSubScope(scope) {
		// console.log(scope);
		if(scope==1){
			$('.radio-list-sub-scope').html('<label for="">ขอบเขตย่อยที่ '+scope+' </label><?php foreach($rsScope1 as $key => $value){ ?><div class="radio-custom pl-4"><label class="radio-inline"><input type="radio" name="scope_sub_group" value="<?=$key+1?>" <?=$key==0?"checked":""?> data-scope="'+scope+'" data-sub-scope="<?=$key+1?>"> <?=$value->ss_name?> </label></div> <?php } ?>');
		}else if(scope=='GHG'){
			$('.radio-list-sub-scope').html('<label for="">ขอบเขตย่อยที่ '+scope+' </label><?php foreach($rsScopeGHG as $key => $value){ ?><div class="radio-custom pl-4"><label class="radio-inline"><input type="radio" name="scope_sub_group" value="<?=$key+1?>" <?=$key==0?"checked":""?> data-scope="'+scope+'" data-sub-scope="<?=$key+1?>"> <?=$value->ss_name?> </label></div> <?php } ?>');
		}else if(scope==2){
			$('.radio-list-sub-scope').html('<label for="">ขอบเขตย่อยที่ '+scope+' </label><?php foreach($rsScope2 as $key => $value){ ?><div class="radio-custom pl-4"><label class="radio-inline"><input type="radio" name="scope_sub_group" value="<?=$key+1?>" <?=$key==0?"checked":""?> data-scope="'+scope+'" data-sub-scope="<?=$key+1?>"> <?=$value->ss_name?> </label></div> <?php } ?>');
		}else if(scope==3){
			$('.radio-list-sub-scope').html('<label for="">ขอบเขตย่อยที่ '+scope+' </label><?php foreach($rsScope3 as $key => $value){ ?><div class="radio-custom pl-4"><label class="radio-inline"><input type="radio" name="scope_sub_group" value="<?=$key+1?>" <?=$key==0?"checked":""?> data-scope="'+scope+'" data-sub-scope="<?=$key+1?>"> <?=$value->ss_name?> </label></div> <?php } ?>');
		}else if(scope==4){
			$('.radio-list-sub-scope').html('<label for="">ขอบเขตย่อยที่ '+scope+' </label><?php foreach($rsScope4 as $key => $value){ ?><div class="radio-custom pl-4"><label class="radio-inline"><input type="radio" name="scope_sub_group" value="<?=$key+1?>" <?=$key==0?"checked":""?> data-scope="'+scope+'" data-sub-scope="<?=$key+1?>"> <?=$value->ss_name?> </label></div> <?php } ?>');
		}
	}

    $(function () {
		$('input[name="scope_group"]').click(function (e) { 
			var scope = $(this).attr('data-scope');
			// $(this).attr('checked', true);
			getSubScope(scope);
           
		});
	});
</script>