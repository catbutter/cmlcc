<?php $this->load->view('dashboard/database_nav'); ?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-more.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
<style>
    .nav-tabs .nav-link{
        background-color: #008cff;
        color: #fff;
        filter: drop-shadow(0px 1px 2px rgba(0, 0, 0, 0.1)) drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.06));
    }
    .nav-tabs .active{filter: none;}
    .nav-primary.nav-tabs .nav-link.active {
        color: #333;
        border-color: #eee #eee #fff;
    }
    .frmbox2 {
  background-color: rgb(226, 232, 240) !important;
}
.frmtable {
  background-color: rgb(248, 250, 252) !important;
 
}
.fr-form td, .fr-form th {
    
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
}
.fr-form .form-control{
	border: 0px solid #ced4da !important;
    font-size: 14px;
}
.gov_img{position: relative;}
.gov_img_a{position: absolute;left:10px; bottom:10px;}
</style>
<?php 
$tab_ck  =$this->input->get('fr');

?>
<div class="card">
    <div class="card-body">
        <div class="col-12">
            <h5>บัญชีรายการก๊าซเรือนกระจก</h5>
        </div>
        <div class="line"></div>

        <ul class="nav nav-tabs nav-primary" role="tablist">
            <?php for($i=1; $i<=5; $i++){?>
			<li class="nav-item" role="presentation">
				<a class="nav-link <?=$tab_ck==$i?'active':''?><?= $tab_ck==null && $i==1?'active':''?>" data-bs-toggle="tab" href="#fr<?=$i?>" role="tab" aria-selected="true">
					<div class="d-flex align-items-center">
						<div class="tab-title">FR-0<?=$i?></div>
					</div>
				</a>
			</li>				
            <?php }?>		
		</ul>

        <div class="tab-content" id="pills-tabContent">
            <!--fr1-->
			<div class="tab-pane fade <?= $tab_ck == 1 ? 'show active' : '' ?><?=$tab_ck==null?'show active':''?>" id="fr1" role="tabpanel">
                <?php $this->load->view('dashboard/database_fr_01');?>
            </div>
            <!--fr2-->
			<div class="tab-pane fade <?= $tab_ck == 2 ? 'show active' : '' ?>" id="fr2" role="tabpanel">
                <?php $this->load->view('dashboard/database_fr_02');?>
            </div>
            <!--fr3-->
			<div class="tab-pane fade <?= $tab_ck == 3 ? 'show active' : '' ?>" id="fr3" role="tabpanel">
                <?php $this->load->view('dashboard/database_fr_03');?>
            </div>
            <!--fr4-->
			<div class="tab-pane fade <?= $tab_ck == 4 ? 'show active' : '' ?>" id="fr4" role="tabpanel">
                <?php $this->load->view('dashboard/database_fr_04');?>
            </div>
            <!--fr5-->
			<!-- <div class="tab-pane fade <?= $tab_ck == 5 ? 'show active' : '' ?>" id="fr5" role="tabpanel">
                <?php //$this->load->view('dashboard/database_fr_05');?>
            </div> -->
        </div>



       
    </div>
</div>
