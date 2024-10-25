var loadFile = function (event) {
  var output = document.getElementById("output");
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function () {
    URL.revokeObjectURL(output.src); // free memory
  };
};

var loadFile2 = function (event) {
  var output = document.getElementById("output2");
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function () {
    URL.revokeObjectURL(output.src); // free memory
  };
};

var loadFile3 = function (event) {
  var output = document.getElementById("output3");
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function () {
    URL.revokeObjectURL(output.src); // free memory
  };
};

var loadFile4 = function (event) {
  var output = document.getElementById("output4");
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function () {
    URL.revokeObjectURL(output.src); // free memory
  };
};

jQuery(
  (function ($) {
    "use strict";

    var container = $("div.containerz");
    var BASE_URI = "https://cm.lcc.3e.world/";

    $("#form_changepwd").validate({
			errorContainer: container,
			errorLabelContainer: $("ol", container),
			wrapper: "li",
			meta: "validate",
			rules: {
				n_password: {
					minlength: 6
				},
				c_password: {
					minlength: 6,
					equalTo: "#n_password"
				}
			},
			messages: {
				n_password: {
					minlength: 'กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว'
				},
				c_password: {
					minlength: 'กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว',
					equalTo: "ยืนยันรหัสผ่านไม่ถูกต้อง"
				}
			},
			submitHandler: function (form) { form.submit(); }
		});


    $("#form_faculty").validate({
			errorContainer: container,
			errorLabelContainer: $("ol", container),
			wrapper: "li",
			meta: "validate",
			rules: {
				faculty_username: {
					minlength: 6,
          remote: {
            type: "GET",
            url: BASE_URI+"auth/checkFacultyUsername",
            data: {
              faculty_username: function() {
                return $("#faculty_username").val();
              }
            }
          }
				}
			},
			messages: {
				faculty_username: {
					minlength: 'กรุณากรอกชื่อผู้ใช้อย่างน้อย 6 ตัว',
          remote:'ชื่อผู้ใช้ ถูกใช้ลงทะเบียนไปแล้ว กรุณาลองใหม่อีกครั้ง'
				}
			},
			submitHandler: function (form) { form.submit(); }
		});


    $("#frm_profile").validate({
      errorContainer: container,
      errorLabelContainer: $("ol", container),
      wrapper: "li",
      meta: "validate",
      rules: {
          member_lat: {
              ckLatitude : true
          },
          member_lon: {
              ckLongitude : true
          }
      },
      messages: {
          member_lat: {
              ckLatitude: 'กรุณาระบุพิกัด ละติจูด ให้ถูกต้อง (จุดทศนิยม 10 ตำแหน่ง)'
          },
          member_lon: {
              ckLongitude: 'กรุณาระบุพิกัด ลองจิจูด ให้ถูกต้อง (จุดทศนิยม 10 ตำแหน่ง)'
          }
      },
      submitHandler: function (form) { form.submit(); }
  });

    $(".summernote").summernote({
      height: 300,
      focus: true,
      callbacks: {
        onImageUpload: function (files, editor, welEditable) {
          for (var i = files.length - 1; i >= 0; i--) {
            sendFile(files[i], this);
          }
        },
      },
    });

    function sendFile(file, el) {
      var form_data = new FormData();
      form_data.append("file", file);
      $.ajax({
        data: form_data,
        type: "POST",
        url: BASE_URI + "admin/summernote_upload",
        cache: false,
        contentType: false,
        processData: false,
        success: function (url) {
          $(el).summernote("editor.insertImage", url);
        },
      });
    }

    if($('#mapz').length){

    var map = L.map("mapz", {
      attributionControl: !1,
      minZoom: 10,
      maxZoom: 18,
    });

    map.createPane("labels"),
      (map.getPane("labels").style.zIndex = 650),
      (map.getPane("labels").style.pointerEvents = "none");
    var positron = L.tileLayer(
        "https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png"
      ).addTo(map),
      positronLabels = L.tileLayer(
        "https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png"
      ).addTo(map);

    
    if ($("#member_lat").val() != "" && $("#member_lon").val() != "") {
      getStation($("#member_lat").val(), $("#member_lon").val());
    } else {
      getLocation();
    }

    function getLocation() {
      navigator.geolocation &&
        navigator.geolocation.getCurrentPosition(showPosition);
    }

    function showPosition(position) {
      getStation(
        position.coords.latitude.toFixed(10),
        position.coords.longitude.toFixed(10)
      );
    }

    jQuery.validator.addMethod(
      "ckLatitude",
      function (value, element) {
        var regexLat = new RegExp(
          "^(\\+|-)?(?:90(?:(?:\\.0{1,10})?)|(?:[0-9]|[1-8][0-9])(?:(?:\\.[0-9]{1,10})?))$"
        );
        if (regexLat.test(value)) {
          return true;
        }
      },
      "* กรุณาระบุพิกัด ละติจูด ให้ถูกต้อง (จุดทศนิยม 10 ตำแหน่ง)"
    );

    //longitude
    jQuery.validator.addMethod(
      "ckLongitude",
      function (value, element) {
        var regexLong = new RegExp(
          "^(\\+|-)?(?:180(?:(?:\\.0{1,10})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\\.[0-9]{1,10})?))$"
        );
        if (regexLong.test(value)) {
          return true;
        }
      },
      "* กรุณาระบุพิกัด ลองจิจูด ให้ถูกต้อง (จุดทศนิยม 10 ตำแหน่ง)"
    );

    function getStation(t, e) {
      $("#member_lat").val(t);
      $("#member_lon").val(e);
      map.setView(
        {
          lat: t,
          lng: e,
        },
        10
      );

      var marker = new L.Marker([t, e], {
        draggable: !0,
      });

      var all = L.layerGroup([marker]);
      map.addLayer(all);

      marker.on("dragend", function (l) {
        $("#member_lat").val(l.target.getLatLng().lat.toFixed(10));
        $("#member_lon").val(l.target.getLatLng().lng.toFixed(10));
      });
    }
  }

    // // $(document).on("change", "#member_province_id", function () {
    // //   $("#member_amphur_id").val("");
    // //   $("#member_district_id").val("");
    //   $.ajax({
    //     url: BASE_URI +"auth/getAm?id=38",
    //     success: function (data) {
    //       $("#member_amphur_id").html(data);
    //       $("#member_amphur_id").attr("disabled", false);
    //     },
    //   });
    // // });
    $(document).on("change", "#member_amphur_id", function () {
      $("#member_district_id").val("");
      $.ajax({
        url: BASE_URI + "auth/getDis?id=" + $(this).val(),
        success: function (data) {
          $("#member_district_id").html(data);
          $("#member_district_id").attr("disabled", false);
        },
      });
    });

    $(document).on("change", "#member_type_id", function () {
      if($(this).val()==7){
        $('#member_type_id_div').show();
      }else{
        $('#member_type_id_div').hide();
      }
     
    });

    $('.number-input').on('input', function() {
      let value = $(this).val();

      // ลบอักขระที่ไม่ใช่ตัวเลข
      value = value.replace(/[^0-9]/g, '');

      // จำกัดค่าไม่ให้เกิน 100
      if (value > 100) {
          value = '100';
      }

      $(this).val(value);
  });

  // ตรวจสอบค่าที่กรอกเมื่อ focus ออก
  $('.number-input').on('blur', function() {
      let value = $(this).val();

      // หากค่าว่างหรือเกินช่วง 0 - 100 ให้แสดงการแจ้งเตือน
      if (value === '' || value < 0 || value > 100) {
          alert('กรุณากรอกตัวเลขระหว่าง 0 - 100');
          $(this).val('');
      }
  });

    
  })(jQuery)
);
