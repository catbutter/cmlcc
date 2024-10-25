$(function() {
	"use strict";

	var base_url = 'https://cfuniversity.3e.world/';
	
	var container= $("div.containerz");

	if($('#form_register').length){
		$(document).on('change', '#member_province_id', function() {
			$('#member_amphur_id').val(""); 
			$('#member_district_id').val(""); 
			$.ajax({
				url: base_url+'auth/getAm?id='+$(this).val(),
				success: function(data) {
					$('#member_amphur_id').html(data);
					$('#member_amphur_id').attr("disabled", false); 
				}
			});	
		});	
		$(document).on('change', '#member_amphur_id', function() {
			$('#member_district_id').val(""); 
			$.ajax({
				url: base_url+'auth/getDis?id='+$(this).val(),
				success: function(data) {
					$('#member_district_id').html(data);
					$('#member_district_id').attr("disabled", false); 
				}
			});	
		});	
		
		
		$("#form_register").validate({
				errorContainer: container,
				errorLabelContainer: $("ol", container),
				wrapper: "li",
				meta: "validate",
				rules: {
					member_email: {
						remote: {
							type: "GET",
							url: base_url+"auth/checkEmail",
							data: {
								member_email: function() {
									return $("#member_email").val();
								}
							}
						}
					},
					member_password : {
						minlength : 6
					},
					member_password_c : {
						minlength : 6,
						equalTo : "#member_password"
					}
					
				},
				messages: {
					member_email : {
						remote:'อีเมล์นี้ถูกใช้ลงทะเบียนไปแล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง'
					},
					member_password : {
						minlength : 'กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว'
					},
					member_password_c : {
						minlength : 'กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว',
						equalTo : "ยืนยันรหัสผ่านไม่ถูกต้อง"
					}
					
				},
				submitHandler: function( form ) { form.submit(); }
		});
	}
});