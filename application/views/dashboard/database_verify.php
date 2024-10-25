<?php $this->load->view('dashboard/database_nav'); ?>

<div class="card">
    <div class="card-body">
        <div class="col-12">
            <h5>การทวนสอบ</h5>
        </div>
        <div class="line"></div>

        <?php 
		$afile=array();
		$data_pop=array();
		$data_day=array();
		$txt = array('กำหนดการทวนสอบ','ข้อตกลงเบื้องต้นในการทวนสอบ', '(ร่าง)รายการข้อบกพร่องและข้อชี้แจงเพิ่มเติมขององค์กร',  'สรุปรายการข้อบกพร่องและข้อชี้แจงเพิ่มเติมขององค์กร (จากผู้ทวนสอบ)','คำชี้แจง (จากองค์กร)');
		if($rsFile!=null){
			$afile = array($rsFile[0]->verify_file_1, $rsFile[0]->verify_file_2, $rsFile[0]->verify_file_3, $rsFile[0]->verify_file_4, $rsFile[0]->verify_file_5);
		}
        ?>

<?php $p=0;for($i=1; $i<=5; $i++){?>
			
			
			<?php if($i==4){?>
			<div class="info-list">
				<form class="form-inline row" style="width:100%;margin:0;">
				<div class="col-md-6 mb-3"><i class='bx bx-chevron-right' ></i><?=$txt[$p]?></div>
				<div class="col-md-3 mb-3">
					<div id="status<?=$i?>"><?=@$afile[$p]!=null ? '<a class="btn btn-sm btn-primary" target="_blank" href="'.base_url().'uploads/files/'.$afile[$p].'">'.$afile[$p].'</a>' :'' ?></div>
				</div>
				<div class="col-md-3 mb-3 p_file text-end"></div>
				</form>
			</div>
			<?php }else{?>
			<div class="info-list">
				<form class="form-inline row" enctype="multipart/form-data" method="post" style="width:100%;margin:0;">
				<div class="col-md-6 mb-3"><i class='bx bx-chevron-right' ></i><?=$txt[$p]?></div>
				<div class="col-md-3 mb-3 p_file">
					<div id="status<?=$i?>"><?=@$afile[$p]!=null ? '<a class="btn btn-sm btn-theme" target="_blank" href="'.base_url().'uploads/files/'.$afile[$p].'">'.$afile[$p].'</a>' :'' ?></div>
					<progress id="progressBar<?=$i?>" value="0" max="100" style="width:150px;display:none;"></progress>
				</div>
				<div class="col-md-3 mb-3 p_file text-end">
					<a class="btn btn-secondary btn-sm mb-1" style="position:relative;" href="javascript:;">
						เลือกไฟล์...
						<input type="file" name="file<?=$i?>" id="file<?=$i?>" style="width:75px;position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange='$("#status<?=$i?>").html($(this).val());' class="error">
					</a>&nbsp;
					<input type="hidden" name="verify_year_value_<?=$i?>" id="verify_year_value_<?=$i?>" value="<?=$this->uri->segment(3)?>">
					<button type="button" class="btn btn-primary btn-sm mb-1" onclick="uploadFile<?=$i?>()">อัพโหลด</button>
				</div>
				</form>
			</div>
			<?php }?>
	<?php $p++;}?>	
	
       

        



       
    </div>
</div>


<script>
		function _(el){
			return document.getElementById(el);
		}
		function uploadFile1(){
			$('#progressBar1').show();
			var file = _("file1").files[0];
			// alert(file.name+" | "+file.size+" | "+file.type);
			var formdata = new FormData();
			formdata.append("file", file);
			formdata.append("p_file", 1);
			formdata.append("verify_year_value", $('#verify_year_value_1').val());
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler1, false);
			ajax.addEventListener("load", completeHandler1, false);
			ajax.addEventListener("error", errorHandler1, false);
			ajax.addEventListener("abort", abortHandler1, false);
			ajax.open("POST", "<?=base_url()?>dashboard/ajax_verify_upload/");
			ajax.send(formdata);
		}
		function progressHandler1(event){
			
			var percent = (event.loaded / event.total) * 100;
			_("progressBar1").value = Math.round(percent);
			_("status1").innerHTML = Math.round(percent)+"% uploaded... please wait";
		}
		function completeHandler1(event){
			_("status1").innerHTML = event.target.responseText;
			_("progressBar1").value = 0;
			$('#progressBar1').hide();
		}
		function errorHandler1(event){
			_("status1").innerHTML = "Upload Failed";
		}
		function abortHandler1(event){
			_("status1").innerHTML = "Upload Aborted";
		}
		
		function uploadFile2(){
			$('#progressBar2').show();
			var file = _("file2").files[0];
			// alert(file.name+" | "+file.size+" | "+file.type);
			var formdata = new FormData();
			formdata.append("file", file);
			formdata.append("p_file", 2);
			formdata.append("verify_year_value", $('#verify_year_value_2').val());
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler2, false);
			ajax.addEventListener("load", completeHandler2, false);
			ajax.addEventListener("error", errorHandler2, false);
			ajax.addEventListener("abort", abortHandler2, false);
			ajax.open("POST", "<?=base_url()?>dashboard/ajax_verify_upload/");
			ajax.send(formdata);
		}
		function progressHandler2(event){
			
			var percent = (event.loaded / event.total) * 100;
			_("progressBar2").value = Math.round(percent);
			_("status2").innerHTML = Math.round(percent)+"% uploaded... please wait";
		}
		function completeHandler2(event){
			_("status2").innerHTML = event.target.responseText;
			_("progressBar2").value = 0;
			$('#progressBar2').hide();
		}
		function errorHandler2(event){
			_("status2").innerHTML = "Upload Failed";
		}
		function abortHandler2(event){
			_("status2").innerHTML = "Upload Aborted";
		}

		function uploadFile3(){
			$('#progressBar3').show();
			var file = _("file3").files[0];
			// alert(file.name+" | "+file.size+" | "+file.type);
			var formdata = new FormData();
			formdata.append("file", file);
			formdata.append("p_file", 3);
			formdata.append("verify_year_value", $('#verify_year_value_3').val());
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler3, false);
			ajax.addEventListener("load", completeHandler3, false);
			ajax.addEventListener("error", errorHandler3, false);
			ajax.addEventListener("abort", abortHandler3, false);
			ajax.open("POST", "<?=base_url()?>dashboard/ajax_verify_upload/");
			ajax.send(formdata);
		}
		function progressHandler3(event){
			
			var percent = (event.loaded / event.total) * 100;
			_("progressBar3").value = Math.round(percent);
			_("status3").innerHTML = Math.round(percent)+"% uploaded... please wait";
		}
		function completeHandler3(event){
			_("status3").innerHTML = event.target.responseText;
			_("progressBar3").value = 0;
			$('#progressBar3').hide();
		}
		function errorHandler3(event){
			_("status3").innerHTML = "Upload Failed";
		}
		function abortHandler3(event){
			_("status3").innerHTML = "Upload Aborted";
		}

		function uploadFile5(){
			$('#progressBar5').show();
			var file = _("file5").files[0];
			// alert(file.name+" | "+file.size+" | "+file.type);
			var formdata = new FormData();
			formdata.append("file", file);
			formdata.append("p_file", 5);
			formdata.append("verify_year_value", $('#verify_year_value_5').val());
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler5, false);
			ajax.addEventListener("load", completeHandler5, false);
			ajax.addEventListener("error", errorHandler5, false);
			ajax.addEventListener("abort", abortHandler5, false);
			ajax.open("POST", "<?=base_url()?>dashboard/ajax_verify_upload/");
			ajax.send(formdata);
		}
		function progressHandler5(event){
			
			var percent = (event.loaded / event.total) * 100;
			_("progressBar5").value = Math.round(percent);
			_("status5").innerHTML = Math.round(percent)+"% uploaded... please wait";
		}
		function completeHandler5(event){
			_("status5").innerHTML = event.target.responseText;
			_("progressBar5").value = 0;
			$('#progressBar5').hide();
		}
		function errorHandler5(event){
			_("status5").innerHTML = "Upload Failed";
		}
		function abortHandler5(event){
			_("status5").innerHTML = "Upload Aborted";
		}
	</script>
	<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
        $(document).ready(function () {
            $('#sidebarCollapse02').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
        function menu_close() {
            document.getElementById("sidebarCollapse02").style.display = "block";
        }
        function menu_open() {
            document.getElementById("sidebarCollapse02").style.display = "none";
        }
    </script>