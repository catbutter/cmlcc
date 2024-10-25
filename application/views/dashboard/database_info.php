<?php $this->load->view('dashboard/database_nav'); ?>

<?php 
$txt = array('คำสั่งแต่งตั้งคณะทำงาน','แผนผังแสดงพื้นที่ขององค์กร', 'โครงสร้างการบริหารงาน', 'สภาพทั่วไปและข้อมูลพื้นฐาน', 'รูปหน่วยงาน', 'ตราสัญลักษณ์');
$afile=array();
if($rsFile!=null){
    $afile = array($rsFile[0]->info_file_1, $rsFile[0]->info_file_2, $rsFile[0]->info_file_3, $rsFile[0]->info_file_4, $rsFile[0]->info_file_5, $rsFile[0]->info_file_6);
} 
?>
<div class="card">
    <div class="card-body">

        <div class="row">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <h5>ข้อมูลทั่วไปขององค์กร</h5>
                    </div>
                </div>

                <div class="line"></div>
                <?php $p=0;for($i=1; $i<=6; $i++){?>
                <div class="info-list">
                    <form class="form-inline row align-items-center" enctype="multipart/form-data" method="post" style="width:100%;margin:0;">
                        
                        <div class="col-md-5 mb-3"><i class='bx bx-chevron-right' ></i><?=$txt[$p]?></div>
                        <div class="col-md-3 mb-3 p_file text-end">
                            <div id="status<?=$i?>"><?=@$afile[$p]!=null ? '<a class="btn btn-sm btn-theme" target="_blank" href="'.base_url().'download/'.$afile[$p].'/'.$afile[$p].'"><i class=\'bx bx-file bx-tada\' ></i>ไฟล์เอกสาร</a>' :'' ?></div>
                            <progress id="progressBar<?=$i?>" value="0" max="100" style="width:150px;display:none;"></progress>
                        </div>
                        <div class="col-md-4 mb-3 p_file text-end">
                            <a class="btn btn-secondary btn-sm mb-1" style="position:relative;overflow: hidden" href="javascript:;">
                                <i class='bx bx-file'></i>เลือกไฟล์
                                <input type="file" name="file<?=$i?>" id="file<?=$i?>" style="width:75px;position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color:transparent;color:transparent;" size="40" onchange='$("#status<?=$i?>").html($(this).val());' class="error">
                            </a>&nbsp;
                            <input type="hidden" name="info_year_value_<?=$i?>" id="info_year_value_<?=$i?>" value="<?=$this->uri->segment(3)?>">
                            <button type="button" class="btn btn-primary btn-sm mb-1" onclick="uploadFile<?=$i?>()"><i class='bx bx-upload' ></i>อัพโหลด</button>
                        </div>
                    </form>
                </div>
                <?php $p++;}?>
                
                <div class="line"></div>

                <!-- <div class="row mb-3">
                    <div class="col-9">
                        <h5>กำหนดส่วนงาน</h5>
                    </div>
                    <div class="col-3 text-end">
                        <a class="btn btn-info btn-sm" style="width: 140px;float: right;" href="<?=base_url()?>dashboard/info/<?=$this->uri->segment(3)?>/add"><i class="bx bx-plus"></i> เพิ่มสำนัก/กอง</a>
                    </div>
                </div> -->

                <!-- <?php if($rsDepartment!=null){?>
                <?php foreach($rsDepartment as $item){?>
                    <table class="table mb-2" id="gov_table">
						<thead class="table-info">
							<tr>
								<th scope="col">ลำดับ</th>
								<th scope="col">ชื่อสำนัก/กอง</th>
								<th scope="col" class="text-right"></th>
							</tr>
                        </thead>
                        <tbody>
                        <?php $i=0;foreach($rsDepartment as $item){$i++;?>
							<tr>
								<td class="align-middle"><?=$i?>.</td>
								<td class="align-middle"><?=$item->dep_name?></td>
								<td class="align-middle text-end">
									<a href="<?=base_url('dashboard/submit/'.$this->uri->segment(3).'/'.$item->dep_id.'/'.$item->dep_key)?>" class="btn btn-primary btn-sm mb-1"><i class="bx bx-data"></i>บันทึกข้อมูล</a>
									<a href="<?=base_url('dashboard/info/'.$this->uri->segment(3).'/edit/'.$item->dep_id)?>" class="btn btn-secondary btn-sm mb-1"><i class="bx bx-edit"></i>แก้ไขชื่อ</a>
									<a href="<?=base_url('dashboard/info/'.$this->uri->segment(3).'/del/'.$item->dep_id)?>" onclick="return confirm('คุณต้องการลบใช่หรือไม่');" class="btn btn-danger btn-sm mb-1"><i class="bx bx-trash"></i>ลบ</a>
								</td>
							</tr>
						<?php }?>
                        </tbody>
                    </table>
                <?php }?>
                <?php }?>
                
                <?php if($this->uri->segment(4)=="add" || $this->uri->segment(4)=="edit"){?>
                    <form class="form-inline" method="post" style="padding: 10px;margin: 0;background-color: #99d0d2;border-radius: 20px;">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="dep_name" class="col-form-label">ชื่อสำนัก/กอง</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="dep_name" name="dep_name" class="form-control" name="dep_name" placeholder="ชื่อสำนัก/กอง" value="<?=@$rs[0]->dep_name?>" required>
                            </div>
                            <div class="col-auto">
                                <input type="hidden" name="dep_id" value="<?=@$rs[0]->dep_id?>">
                                <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i>บันทีก</button>
                                <button type="button" class="btn btn-secondary" onclick="location.href='<?=base_url('dashboard/info/'.$this->uri->segment(3))?>'"><i class="bx bx-undo"></i>ยกเลิก</button>
                                
                            </div>
                        </div>
					</form>
				<?php }?> -->
            </div>
        </div>
        
    </div>
</div>

<script>
    function _(e) {
    return document.getElementById(e);
}
function uploadFile1() {
    $("#progressBar1").show();
    var e = _("file1").files[0],
        r = new FormData();
    r.append("file", e), r.append("p_file", 1), r.append("info_year_value", $("#info_year_value_1").val());
    var a = new XMLHttpRequest();
    a.upload.addEventListener("progress", progressHandler1, !1),
        a.addEventListener("load", completeHandler1, !1),
        a.addEventListener("error", errorHandler1, !1),
        a.addEventListener("abort", abortHandler1, !1),
        a.open("POST", "<?=base_url()?>dashboard/ajax_upload/"),
        a.send(r);
}
function progressHandler1(e) {
    var r = (e.loaded / e.total) * 100;
    (_("progressBar1").value = Math.round(r)), (_("status1").innerHTML = Math.round(r) + "% uploaded... please wait");
}
function completeHandler1(e) {
    (_("status1").innerHTML = e.target.responseText), (_("progressBar1").value = 0), $("#progressBar1").hide();
}
function errorHandler1(e) {
    _("status1").innerHTML = "Upload Failed";
}
function abortHandler1(e) {
    _("status1").innerHTML = "Upload Aborted";
}
function uploadFile2() {
    $("#progressBar2").show();
    var e = _("file2").files[0],
        r = new FormData();
    r.append("file", e), r.append("p_file", 2), r.append("info_year_value", $("#info_year_value_2").val());
    var a = new XMLHttpRequest();
    a.upload.addEventListener("progress", progressHandler2, !1),
        a.addEventListener("load", completeHandler2, !1),
        a.addEventListener("error", errorHandler2, !1),
        a.addEventListener("abort", abortHandler2, !1),
        a.open("POST", "<?=base_url()?>dashboard/ajax_upload/"),
        a.send(r);
}
function progressHandler2(e) {
    var r = (e.loaded / e.total) * 100;
    (_("progressBar2").value = Math.round(r)), (_("status2").innerHTML = Math.round(r) + "% uploaded... please wait");
}
function completeHandler2(e) {
    (_("status2").innerHTML = e.target.responseText), (_("progressBar2").value = 0), $("#progressBar2").hide();
}
function errorHandler2(e) {
    _("status2").innerHTML = "Upload Failed";
}
function abortHandler2(e) {
    _("status2").innerHTML = "Upload Aborted";
}
function uploadFile3() {
    $("#progressBar3").show();
    var e = _("file3").files[0],
        r = new FormData();
    r.append("file", e), r.append("p_file", 3), r.append("info_year_value", $("#info_year_value_3").val());
    var a = new XMLHttpRequest();
    a.upload.addEventListener("progress", progressHandler3, !1),
        a.addEventListener("load", completeHandler3, !1),
        a.addEventListener("error", errorHandler3, !1),
        a.addEventListener("abort", abortHandler3, !1),
        a.open("POST", "<?=base_url()?>dashboard/ajax_upload/"),
        a.send(r);
}
function progressHandler3(e) {
    var r = (e.loaded / e.total) * 100;
    (_("progressBar3").value = Math.round(r)), (_("status3").innerHTML = Math.round(r) + "% uploaded... please wait");
}
function completeHandler3(e) {
    (_("status3").innerHTML = e.target.responseText), (_("progressBar3").value = 0), $("#progressBar3").hide();
}
function errorHandler3(e) {
    _("status3").innerHTML = "Upload Failed";
}
function abortHandler3(e) {
    _("status3").innerHTML = "Upload Aborted";
}
function uploadFile4() {
    $("#progressBar4").show();
    var e = _("file4").files[0],
        r = new FormData();
    r.append("file", e), r.append("p_file", 4), r.append("info_year_value", $("#info_year_value_4").val());
    var a = new XMLHttpRequest();
    a.upload.addEventListener("progress", progressHandler4, !1),
        a.addEventListener("load", completeHandler4, !1),
        a.addEventListener("error", errorHandler4, !1),
        a.addEventListener("abort", abortHandler4, !1),
        a.open("POST", "<?=base_url()?>dashboard/ajax_upload/"),
        a.send(r);
}
function progressHandler4(e) {
    var r = (e.loaded / e.total) * 100;
    (_("progressBar4").value = Math.round(r)), (_("status4").innerHTML = Math.round(r) + "% uploaded... please wait");
}
function completeHandler4(e) {
    (_("status4").innerHTML = e.target.responseText), (_("progressBar4").value = 0), $("#progressBar4").hide();
}
function errorHandler4(e) {
    _("status4").innerHTML = "Upload Failed";
}
function abortHandler4(e) {
    _("status4").innerHTML = "Upload Aborted";
}
function uploadFile5() {
    $("#progressBar5").show();
    var e = _("file5").files[0],
        r = new FormData();
    r.append("file", e), r.append("p_file", 5), r.append("info_year_value", $("#info_year_value_5").val());
    var a = new XMLHttpRequest();
    a.upload.addEventListener("progress", progressHandler5, !1),
        a.addEventListener("load", completeHandler5, !1),
        a.addEventListener("error", errorHandler5, !1),
        a.addEventListener("abort", abortHandler5, !1),
        a.open("POST", "<?=base_url()?>dashboard/ajax_upload/"),
        a.send(r);
}
function progressHandler5(e) {
    var r = (e.loaded / e.total) * 100;
    (_("progressBar5").value = Math.round(r)), (_("status5").innerHTML = Math.round(r) + "% uploaded... please wait");
}
function completeHandler5(e) {
    (_("status5").innerHTML = e.target.responseText), (_("progressBar5").value = 0), $("#progressBar5").hide();
}
function errorHandler5(e) {
    _("status5").innerHTML = "Upload Failed";
}
function abortHandler5(e) {
    _("status5").innerHTML = "Upload Aborted";
}
function uploadFile6() {
    $("#progressBar5").show();
    var e = _("file6").files[0],
        r = new FormData();
    r.append("file", e), r.append("p_file", 6), r.append("info_year_value", $("#info_year_value_6").val());
    var a = new XMLHttpRequest();
    a.upload.addEventListener("progress", progressHandler6, !1),
        a.addEventListener("load", completeHandler6, !1),
        a.addEventListener("error", errorHandler6, !1),
        a.addEventListener("abort", abortHandler6, !1),
        a.open("POST", "<?=base_url()?>dashboard/ajax_upload/"),
        a.send(r);
}
function progressHandler6(e) {
    var r = (e.loaded / e.total) * 100;
    (_("progressBar5").value = Math.round(r)), (_("status6").innerHTML = Math.round(r) + "% uploaded... please wait");
}
function completeHandler6(e) {
    (_("status6").innerHTML = e.target.responseText), (_("progressBar6").value = 0), $("#progressBar6").hide();
}
function errorHandler6(e) {
    _("status6").innerHTML = "Upload Failed";
}
function abortHandler6(e) {
    _("status6").innerHTML = "Upload Aborted";
}


</script>