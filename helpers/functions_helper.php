<?php

function translate($label){
	$ci=& get_instance();
	$rs=$ci->lang->line($label);
	if($rs){
		return $rs;
	}else{
		return $label;
	}
}

	function genKey($length = 5){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$preString = '';
		$sufString = '';
		for ($i = 0; $i < $length; $i++) {
			$preString .= $characters[rand(0, $charactersLength - 1)];
			$sufString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $preString.sha1(date('ymdhis')).$sufString;
	}
	
	function Hash256($password){
		return hash('sha256', $password);
	}
	
	function ConvertToThaiDate ($date,$short) {
		
		if($date=="0000-00-00 00:00:00"){
			return 'ไม่ระบุ';
		}else{
			if($date){
				
				if($short){
					$MONTH = array("", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				}else{
					$MONTH = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
				}
				$strYear = date("Y",strtotime($date))+543;
				$strMonth= date("n",strtotime($date));
				$strDay= date("j",strtotime($date));
				$strHour= date("H",strtotime($date));
				$strMinute= date("i",strtotime($date));
				$strSeconds= date("s",strtotime($date));
				
				$strMonthThai=$MONTH[$strMonth];
				return "$strDay $strMonthThai $strYear";
				$dt = explode("-", $date);
				$tyear = $dt[0];
				$dt[0] = $dt[2] +0;
				$dt[1] = $MONTH[$dt[1]+0];
				$dt[2] = $tyear+543;
				///return join(" ", $dt);
			}else{
				return "<font color=\"#FF0000\">ไม่ระบุ</font>";
			}	
		}
	}
	
	function ConvertToThaiDate_pdf ($date,$short) {
		
		if($date=="0000-00-00 00:00:00"){
			return 'ไม่ระบุ';
		}else{
			if($date){
				if($short){
					$MONTH = array("", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
				}else{
					$MONTH = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
				}
				$dt = explode("-", $date);
				$tyear = $dt[0];
				$dt[0] = 'วันที่ '.($dt[2] +0);
				$dt[1] = 'เดือน '.($MONTH[$dt[1]+0]);
				$dt[2] = 'พ.ศ. '.($tyear+543);
				return join(" ", $dt);
			}else{
				return "<font color=\"#FF0000\">ไม่ระบุ</font>";
			}	
		}
	}
	
	function getMonth($i){
		$MONTH = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		return $MONTH[$i];
	}
	
	function ConvertToThaiDateInt($date){
		$dt = explode("-", $date);
		return substr($date,8,2).'/'.substr($date,5,2).'/'.(substr($date,0,4) +543);
	}
	
	function txtDescription($txt,$shot){
		return strip_tags(mb_substr($txt,0,$shot,'utf-8'));
		
	}
	
	function addhttp($url) {
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			$url = "http://" . $url;
		}
		return $url;
	}
	
	function rmComma($number){
		return  str_replace(',', '', $number);
	}
	
	function watherTypeList(){
		return array(
			'type_1'=> array('name'=> "ปล่อยน้ำเสียลงสู่ทะเล แม่น้ำ บึง โดยตรง", 'value'=>0.1),
			'type_2'=> array('name'=> "บ่อปรับเสถียร (Stabilization Pond)", 'value'=>0.8),
			'type_3'=> array('name'=> "คลองวนเวียน (Oxidation Ditch)", 'value'=>0),
			'type_4'=> array('name'=> "บ่อเติมอากาศ (Aerated Lagoon)", 'value'=>0),
			'type_5'=> array('name'=> "ระบบตะกอนเร่ง (Activated Sludge)", 'value'=>0),
			'type_6'=> array('name'=> "ระบบตะกอนเร่งแบบปรับเสถียรสัมผัส (Contact Stabilization AS)", 'value'=>0),
			'type_7'=> array('name'=> "ระบบตะกอนเร่งแบบสองขั้นตอน (Two-Stage AS Process)", 'value'=>0),
			'type_8'=> array('name'=> "ระบบผสมระหว่างตัวกลางหมุนชีวภาพและตะกอนเร่ง (Combination of Fixed AS)", 'value'=>0),
			'type_9'=> array('name'=> "แผ่นจานหมุนชีวภาพ (Rotating Biological Contractor)", 'value'=>0),
			'type_10'=> array('name'=> "บึงประดิษฐ์ (Constructed Wetland)", 'value'=>0.2),
			'type_11'=> array('name'=> "บ่อกรองไร้อากาศ (Anaerobic filter)",'value'=>0.8),
			'type_12'=> array('name'=> "บ่อเกรอะ (Septic Tank)",'value'=>0.5),
			'type_13'=> array('name'=> "บ่อซึม (Latrine)", 'value'=>0.1),
		);
	}
	
	function getWatherTypeList($type,$point){
		$ar = array(
			'type_1'=> array('name'=> "ปล่อยน้ำเสียลงสู่ทะเล แม่น้ำ บึง โดยตรง", 'value'=>0.1),
			'type_2'=> array('name'=> "บ่อปรับเสถียร (Stabilization Pond)", 'value'=>0.8),
			'type_3'=> array('name'=> "คลองวนเวียน (Oxidation Ditch)", 'value'=>0),
			'type_4'=> array('name'=> "บ่อเติมอากาศ (Aerated Lagoon)", 'value'=>0),
			'type_5'=> array('name'=> "ระบบตะกอนเร่ง (Activated Sludge)", 'value'=>0),
			'type_6'=> array('name'=> "ระบบตะกอนเร่งแบบปรับเสถียรสัมผัส (Contact Stabilization AS)", 'value'=>0),
			'type_7'=> array('name'=> "ระบบตะกอนเร่งแบบสองขั้นตอน (Two-Stage AS Process)", 'value'=>0),
			'type_8'=> array('name'=> "ระบบผสมระหว่างตัวกลางหมุนชีวภาพและตะกอนเร่ง (Combination of Fixed AS)", 'value'=>0),
			'type_9'=> array('name'=> "แผ่นจานหมุนชีวภาพ (Rotating Biological Contractor)", 'value'=>0),
			'type_10'=> array('name'=> "บึงประดิษฐ์ (Constructed Wetland)", 'value'=>0.2),
			'type_11'=> array('name'=> "บ่อกรองไร้อากาศ (Anaerobic filter)",'value'=>0.8),
			'type_12'=> array('name'=> "บ่อเกรอะ (Septic Tank)",'value'=>0.5),
			'type_13'=> array('name'=> "บ่อซึม (Latrine)", 'value'=>0.1),
		);
		return $ar[$type][$point];
	}
	
	function refrigerantTypeList(){
		return array(
			'type_1'=> array('name'=> "R-32", 'value'=>677),
			'type_2'=> array('name'=> "R-134", 'value'=>1120),
			'type_3'=> array('name'=> "R-134a", 'value'=>1300),
			'type_6'=> array('name'=> "R-410a", 'value'=>1924),
			'type_5'=> array('name'=> "R-22", 'value'=>1760),
			'type_4'=> array('name'=> "อื่นๆ", 'value'=>''),
			
		);
	}
	
	function getRefrigerantTypeList($type,$point){
		$ar = array(
			'type_1'=> array('name'=> "R-32", 'value'=>677),
			'type_2'=> array('name'=> "R-134", 'value'=>1120),
			'type_3'=> array('name'=> "R-134a", 'value'=>1300),
			'type_6'=> array('name'=> "R-410a", 'value'=>1924),
			'type_5'=> array('name'=> "R-22", 'value'=>1760),
			'type_4'=> array('name'=> "อื่นๆ", 'value'=>''),
			
		);
		return @$ar[$type][$point];
	}
	
	function getR7Type($type=null,$point=null){
		$ar = array(
			'type_1'=> array('name'=> "สุกร", 'value'=>0.8659),
			'type_2'=> array('name'=> "ไก่เนื้อ", 'value'=>0.9183),
			'type_3'=> array('name'=> "ไก่ไข่", 'value'=>0.7083),
			'type_4'=> array('name'=> "ไส้เดือน", 'value'=>0),
			'type_5'=> array('name'=> "หนอนแมลงวันลาย", 'value'=>0),
			'type_6'=> array('name'=> "อื่นๆ", 'value'=>0),
		);
		if($type!=null){
			return $ar[$type][$point];
		}else{
			return $ar;
		}
		
	}
	
	function getR8Type($type=null,$point=null){
		$ar = array(
			'type_1'=> array('name'=> "พรรณไม้ทั่วไป"),
			'type_2'=> array('name'=> "พรรณไม้ป่าชายเลน"),
			'type_3'=> array('name'=> "กลุ่มปาล์ม"),
			'type_4'=> array('name'=> "เถาวัลย์"),
		);
		if($type!=null){
			return $ar[$type][$point];
		}else{
			return $ar;
		}
		
	}
	
	function calculateR8($g, $v1, $v2){
		
		if($g=='type_1'){ //4
		
			$DBH = $v2/(22/7);
			$Ws = 0.0396* pow(((pow($DBH,2))*$v1),0.933);
			$Wb = 0.00349 * pow(((pow($DBH,2))*$v1),1.03);
			$Wl = pow(((28/($Ws+$Wb)+0.025)),-1);
			$Wt = $Ws+$Wb+$Wl;
			$biomass = $Wt*0.27;
			$biomass_total = $Wt+($Wt*0.27);
			$carbon = $biomass_total*0.47;
			$r_total = $carbon*(44/12);
			$r_total_f = $r_total/1000;
			
		}else if($g=='type_2'){ //5
		
			$DBH = $v2/(22/7);
			$Ws = 0.05466 * pow(((pow($DBH,2))*$v1),0.945);
			$Wb = 0.01579 * pow(((pow($DBH,2))*$v1),0.9124);
			$Wl = 0.0678 * pow(((pow($DBH,2))*$v1),0.5806);
			$Wt = $Ws+$Wb+$Wl;
			$biomass = $Wt*0.48;
			$biomass_total = $Wt+($Wt*0.48);
			$carbon = $biomass_total*0.4715;
			$r_total = $carbon*(44/12);
			$r_total_f = $r_total/1000;
			
		}else if($g=='type_3'){ //6
		
			$DBH = $v2/(22/7);
			$Ws = 0;
			$Wb = 0;
			$Wl = 0;
			$Wt = 6.666+12.826*(pow($v1,0.5))*(log($v1));
			$biomass = $Wt*0.41;
			$biomass_total = $Wt+($Wt*0.41);
			$carbon = $biomass_total*0.413;
			$r_total = $carbon*(44/12);
			$r_total_f = $r_total/1000;
				
		}else if($g=='type_4'){ //7
			$DBH = $v2/(22/7);
			$Ws = 0;
			$Wb = 0;
			$Wl = 0;
			$Wt = 0.8622*(pow($DBH,2.021));
			$biomass = $Wt*0.27;
			$biomass_total = $Wt+($Wt*0.27);
			$carbon = $biomass_total*0.47;
			$r_total = $carbon*(44/12);
			$r_total_f = $r_total/1000;
			
		}
		return $r_total_f;
	}
	
	function chFileStatus($rsFile, $filename){
		$count = 0;
		foreach($rsFile as $item){
			if ($filename==$item->f_point){
				$count++;
			}
		}
		return $count;
	}

	function bugStatus($k=null){
		$ar_list = array(
			'waiting' => 'รอดำเนินการ',
			'doing' => 'กำลังดำเนินการ',
			'success' => 'แก้ไขเรียบร้อย',
		);

		return $ar_list[$k];
	}

	function getDataSet($type, $year){
		if($type=="Fiscal"){
			$x = '(1 ตุลาคม '.($year-1).' - 30 กันยายน '.$year.')';
		}else{
			$x = '(1 มกราคม '.($year).' - 30 ธันวาคม '.$year.')';
		}
		return $x;
	}
	
	function getGroupYear($key, $type=null)
	{
		if($type=="Fiscal"){
			$MONTH = array("","ต.ค.","พ.ย.","ธ.ค." , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.");
		}else if($type=="Year"){
			$MONTH = array("", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.", "ต.ค.","พ.ย.","ธ.ค.");
		}
		
		return $MONTH[$key];
	}

	function getTTtype($p){
		$ar = array(
			'1'	=>'ปล่อยน้ำเสียลงสู่ทะเล แม่น้ำ บึง โดยตรง',
			'2'	=>'บ่อปรับเสถียร (Stabilization Pond)',
			'3'	=>'คลองวนเวียน (Oxidation Ditch)',
			'4'	=>'บ่อเติมอากาศ (Aerated Lagoon)',
			'5'	=>'ระบบตะกอนเร่ง (Activated Sludge)',
			'6'	=>'ระบบตะกอนเร่งแบบปรับเสถียรสัมผัส (Contact Stabilization AS)',
			'7'	=>'ระบบตะกอนเร่งแบบสองขั้นตอน (Two-Stage AS Process)',
			'8'	=>'ระบบผสมระหว่างตัวกลางหมุนชีวภาพและตะกอนเร่ง (Combination of Fixed AS)',
			'9'	=>'แผ่นจานหมุนชีวภาพ (Rotating Biological Contractor)',
			'10'	=>'บึงประดิษฐ์ (Constructed Wetland)',
			'11'	=>'บ่อกรองไร้อากาศ (Anaerobic filter)',
			'12'	=>'บ่อเกรอะ (Septic Tank)',
			'13'	=>'บ่อซึม (Latrine)'
		);
		return $ar[$p];
	}

	function getTrashType2565($p=null){
		$ar = array(
			'1'	=>'การจัดการของเสียด้วยวิธีการเทกองลึก > 5m.',
			'2'	=>'การจัดการของเสียด้วยวิธีการเทกองลึก < 5 m.',
			'3'	=>'การจัดการของเสียด้วยวิธีการฝังกลบ',
			'4'	=>'การจัดการของเสียด้วยวิธีการไหม้ (เตาเผา)',
			'5'	=>'การจัดการของเสียด้วยวิธีการไหม้ (เผาเทกอง)',
			'6'	=>'การจัดการของเสียด้วยวิธีการทางชีวภาพ (Composting)',
			'7'	=>'การจัดการของเสียด้วยวิธีการทางชีวภาพ (Anaerobic digestion)',
			'8'	=>'การจัดการของเสียด้วยวิธีการฝังกลบโดยนำก๊าซมีเทนที่ได้ไปผลิตไฟฟ้า',
			'9'	=>'การจัดการขยะด้วยวิธีการ RDF และเผาในเตาเผา',
			'10'=>'การจัดการขยะด้วยวิธีการทำ Biogas โดยนำก๊าซมีเทนที่ได้ไปผลิตไฟฟ้า',
		);
		if($p){
			return $ar[$p];
		}else{
			return $ar;
		}
	}

	function getMCF_65($p)
	{
		$mcf_value = array('',0.10, 0.80, 0.05, 0, 0.05, 0, 0, 0.10, 0.12, 0.80, 0.80, 0.80, 0.10);
		return $mcf_value[$p];
	}

	function calculateEF($mcf, $tow)
	{
		$b0 = 0.6;
		$ef = $mcf*$b0;
		return number_format((($tow-0)*$ef)-0,4);
	}

	function getMCFTrash($p=null)
	{
		if(!$p){
			$p = 0;
		}
		$mcf_value = array('',0.80, 0.40, 1, 1, 1, 1, 1, 1, 1, 1);
		return $mcf_value[$p];
	}

	function getTrashType($p=null){
		$ar = array(
			'1'	=>'การจัดการของเสียด้วยวิธีการเทกองลึก > 5m.',
			'2'	=>'การจัดการของเสียด้วยวิธีการเทกองลึก < 5 m.',
			'3'	=>'การจัดการของเสียด้วยวิธีการฝังกลบ',
			'4'	=>'การจัดการของเสียด้วยวิธีการไหม้ (เตาเผา)',
			'5'	=>'การจัดการของเสียด้วยวิธีการไหม้ (เผาเทกอง)',
			'6'	=>'การจัดการของเสียด้วยวิธีการทางชีวภาพ (Composting)',
			'7'	=>'การจัดการของเสียด้วยวิธีการทางชีวภาพ (Anaerobic digestion)',
			'8'	=>'การจัดการของเสียด้วยวิธีการฝังกลบโดยนำก๊าซมีเทนที่ได้ไปผลิตไฟฟ้า',
			'9'	=>'การจัดการขยะด้วยวิธีการ RDF และเผาในเตาเผา',
			'10'=>'การจัดการขยะด้วยวิธีการทำ Biogas โดยนำก๊าซมีเทนที่ได้ไปผลิตไฟฟ้า',
		);
		if($p){
			return $ar[$p];
		}else{
			return $ar;
		}
	}
	
	function calculateTrash($doc, $mcf, $ar_year, $ar_val)
	{
		$docf 			= 0.77;
		$f				= 0.53;
		$ratio			= 16/12;
		$ox				= 0.17;
		$lo 			= $mcf*$doc*$docf*$f*$ratio;
		$total 			= 0;
		if($ar_year!=null){
			asort($ar_year);
			$sub=0;
			$i=1;
			$point = sizeof($ar_year);
			foreach($ar_year as $k=>$item){
				
				
					$total+=(((($ar_val[$k]*$lo*(1-EXP(-0.07))*EXP(-0.07*($point-$i)))-0)*(1-$ox)) * 1000);
				
					//if( ($sub+$i) == (sizeof($ar_year)-1) && ($sub<(sizeof($ar_year)-1)) ){
						//$total=(((($ar_val[$k]*$lo*(1-EXP(-0.07))*EXP(-0.07*($point-$i)))-0)*(1-$ox)) * 1000);
				
						
					//}
				$i++;
			}
		}
		return number_format(($total),4);
		//return $total;
	}


	function efCal($num){
		return number_format($num,4);
	}