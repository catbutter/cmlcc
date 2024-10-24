<?php $this->load->view('dashboard/database_nav'); ?>
<?php 
$data_config=array();
if(@$rsGovermentFr!=null){
	$data = json_decode(@$rsGovermentFr[0]->fr_detail);
	$fr_detail = (array) @$data;	
}
?>	
<style>
.f_image{position: relative;width:300px;margin:0 auto;height:300px;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;}
.f_logo{position: absolute;right: 5px;top: 5px;}
.form-control{border-radius: 0;}
.p-section{padding-left: 50px;}

</style>
<div class="card">
    <div class="card-body">
        <div class="col-12">
            <h5>รายงานการปล่อยและดูดกลับก๊าซเรือนกระจกขององค์กร</h5>
        </div>
        <div class="line"></div>


        <div class="mt-5">
            <h4 class="text-center mb-5">รายงานการปล่อยและดูดกลับก๊าซเรือนกระจกขององค์กร</h4>

            <div class="f_image text-center mb-5">
                <div class="f_logo">
                    <?= @$fr_detail["org_logo"] != null ? '<img src="/uploads/files/' . $fr_detail["org_logo"] . '" width="60" height="60">' : '' ?>
                </div>
                <?= @$fr_detail["org_image"] != null ? '<img src="/uploads/files/' . $fr_detail["org_image"] . '" width="300" height="300">' : '' ?>
            </div>
            <div class="mb-5">
						<div class="row">
							<div class="col-md-8 offset-md-2">
								<div style="font-weight: bold;">
								<div class="text-center">
									<p>เพื่อทดลองการทวนสอบและรับรองผลคาร์บอนฟุตพริ้นท์ขององค์กร</p>
									<p>โดย องค์การบริหารจัดการก๊าซเรือนกระจก (องค์การมหาชน) </p>
								</div>
								</div>
							</div>
						</div>
						
						<style>
						.sector .box{border: 1px solid #eee;padding:15px;}
						</style>
						
						<div class="row">
							<div class="col-lg-4 mb-3 sector">
								<div class="box text-center">
									<strong>รายงานฉบับย่อ</strong><hr/>
									<a target="_blank" href="<?=base_url()?>dashboard/exportword/<?=$this->uri->segment(3)?>" class="btn btn-primary btn-sm mb-2"><i class='bx bxs-file-doc' ></i> รายงานฉบับย่อ .doc</a>
									<a target="_blank" href="<?=base_url()?>dashboard/export_report/<?=$this->uri->segment(3)?>" class="btn btn-danger btn-sm mb-2"><i class='bx bxs-file-pdf' ></i> รายงานฉบับย่อ .pdf</a>
								</div>
							</div>
							<div class="col-lg-4 mb-3 sector">
								<div class="box text-center">
									<strong>แบบฟอร์มรายงานการปล่อยฯ</strong><hr/>
									<p class="text-center">
                                        <a href="<?=base_url()?>uploads/docs/แบบฟอร์มรายงานการปล่อยฯ.docx" class="btn btn-primary btn-sm mb-2" target="_blank"><i class='bx bxs-file-doc' ></i> แบบฟอร์มรายงาน .docx</a>
										<a href="<?=base_url()?>uploads/docs/แบบฟอร์มรายงานการปล่อยฯ.pdf" class="btn btn-danger btn-sm mb-2" target="_blank"><i class='bx bxs-file-pdf' ></i> แบบฟอร์มรายงาน .pdf</a>
									</p>
								</div>
							</div>
							<div class="col-lg-4 mb-3 sector">
								<div class="box text-center">
									<strong class="text-center">อัพโหลดไฟล์รายงานฉบับสมบูรณ์</strong><hr/>
									<form action="/dashboard/upload_report" id="frmReport" class="text-center" method="post" enctype="multipart/form-data">
												<div style="position:relative;margin-bottom:10px;">
													<p >
													<a class="btn btn-secondary btn-sm" href="javascript:;">
                                                    <i class='bx bx-upload'></i> เลือกไฟล์และอัพโหลด
														<input type="file" name="content_file" style="width: -webkit-fill-available !important;position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40">
													</a>
													</p>
													
												</div>
												
												<div id="upload-file-info-1">
												<?php 
												if(@$rsGovermentInfo[0]->info_report!=null){
													$tmp	= explode(".",@$rsGovermentInfo[0]->info_report);
													$tmp	= end($tmp);
													$icon	= "<i class='bx bxs-file-doc' ></i>";
													$btnsty	= 'primary';
													if($tmp=="pdf"){
														$icon	= "<i class='bx bxs-file-pdf' ></i>";
														$btnsty	= 'danger';
													}
												}
												
												
												?>
												<?=@$rsGovermentInfo[0]->info_report!=""?'<a class="btn btn-sm btn-'.$btnsty.'" target="_blank" href="/download/'.$rsGovermentInfo[0]->info_report.'/'.$rsGovermentInfo[0]->info_report.'">'.$icon.' รายงานฉบับสมบูรณ์</a>':''?>
												</div>
												<input type="hidden" name="info_member_id" value="<?=$this->session->userdata('member_logged_in')['member_id']?>">
												<input type="hidden" name="info_year_value" value="<?=$this->uri->segment(3)?>">
											</form>
								</div>
							</div>
						</div>
						
						
					</div>
        </div>
        

    </div>
</div>

<script type="text/javascript">

			$("input:file").change(function(){
				var file = this.files[0];
				var extension = file.name.replace(/^.*\./, '').toLowerCase();
				switch (extension) {
					case 'pdf':
					case 'doc':
					case 'docx':
						
						$('#frmReport').submit();
						return false;
					default:
						// Cancel the form submission
						$('#upload-file-info-1').html('<span class="text-danger">อัพโหลดไฟล์ .pdf, .doc, docx เท่านั้น</span>');
						return false;
				}
			})	

	</script>
