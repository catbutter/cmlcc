<?php $member_permission = (array) @json_decode(@$rsMember['member_permission']);?>
<?php 
	$is_data = array();
	foreach($rsGOVData as $val){
		array_push($is_data,$val->info_year_value);
	}	
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">การตั้งเป้าหมายการลดก๊าซเรือนกระจก</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard/database') ?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">เลือกปีงบประมาณ</li>
                
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body text-center">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div style="position: relative;">
                    <div style="position: absolute;top:80px;width:100%;text-align:center;">
                        <h1 class="text-white" style="text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3), -2px -2px 3px rgba(255, 255, 255, 0.4), 4px 4px 15px rgba(0, 0, 0, 0.5); ">เป้าหมายการลด</h1>
                    </div>
                    <img src="/template/assets/images/chiangmaiblue.jpg?v=1" class="img-fluid rounded" alt="">
                </div>
                <h4><?=$rsMember['member_name']?></h4>
                <p><i class="text-info">*กรุณาเลือกปีงบประมาณ</i></p>
                <?php foreach($rsYear as $item){?>
                    <?php 
						$uri = '';
						$color = '';
						$id = '';
						if(in_array($item->year_value, $member_permission)){
							$uri = 'dashboard/set_target';
							$id = '';
							$fa = 'bx-edit';
						}else{
							$uri = 'dashboard/database';
							$id = $rsMember['member_id'];
							$fa = 'bx-search';
						}
					?>
                    <?php if($fa == 'bx-edit' || in_array($item->year_value, $is_data) ){?>
                        <div class="d-grid mb-3"><a href="<?=base_url()?><?=$uri?>/<?=$item->year_value?>/<?=$id?>" class="btn btn-<?=in_array($item->year_value, $is_data)?'theme':'secondary'?>"><i class="bx <?=$fa?>"></i> กำหนดเป้าหมาย<?=$item->year_name?></a></div>
						
					<?php }?>
                <?php }?>

            </div>
        </div>
        
        
        

					
					

    </div>
</div>