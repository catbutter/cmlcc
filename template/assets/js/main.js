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

$(function () {
  $('[data-bs-toggle="popover"]').popover();
  $('[data-bs-toggle="tooltip"]').tooltip();
});

jQuery(
  (function ($) {
      "use strict";

      var container = $("div.containerz");
      var BASE_URI = "https://lcs.3e.world/";

      $("#form_facprofile").validate({
          errorContainer: container,
          errorLabelContainer: $("ol", container),
          wrapper: "li",
          meta: "validate",
          submitHandler: function (form) {
              form.submit();
          },
      });

      $("#form_changepwd").validate({
          errorContainer: container,
          errorLabelContainer: $("ol", container),
          wrapper: "li",
          meta: "validate",
          rules: {
              n_password: {
                  minlength: 6,
              },
              c_password: {
                  minlength: 6,
                  equalTo: "#n_password",
              },
          },
          messages: {
              n_password: {
                  minlength: "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว",
              },
              c_password: {
                  minlength: "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว",
                  equalTo: "ยืนยันรหัสผ่านไม่ถูกต้อง",
              },
          },
          submitHandler: function (form) {
              form.submit();
          },
      });

      var markers = L.layerGroup();
      var currentMember = null;
      var loader = '<img src="/template/assets/images/loader.gif">';

      var marker_data = [];
      function loadMarker() {
        //init
        marker_data = [];
        markers.clearLayers();
        $('.cfdisplay_body').html(loader);
        $('.stat_number').html(loader);
        var uri = BASE_URI+'main/get_marker';
        var uni_total =0;
        var ghg_total =0;
        var html = '';

        var param = '?filter_year='+$('#filter_year').val()+'&filter_province='+$('#filter_province').val();
        $.getJSON(uri+param, function (res) {
          console.log(res)
          if (res.result) {
            var data = res.result;
            
            uni_total = res.result.length;
            for (let index = 0; index < data.length; index++) {
            
              html +='<div class="d-flex align-items-center my-1 '+(index%2==0?'bg1':'bg2')+'">';
              html +='  <div class="col-1 text-center ps-1 pe-1">'+(index+1)+'.</div>';
              html +='  <div class="col-7 ps-1 pe-1"><span class="openPopup" mid="'+index+'">'+data[index].member_name+'</span></div>';
              html +='  <div class="col-4 ps-1 pe-4 text-end">'+data[index].scope_total+'</div>';
              html +='</div>';
              
              ghg_total += data[index].scope_total;
              marker_data.push(data[index]); 

              //have location
              if (data[index].member_lat != null && data[index].member_lon != null) {
                const marker = L.marker([data[index].member_lat, data[index].member_lon], {
                    icon: L.divIcon({
                        className: "my-custom-pin",
                        iconSize: [20, 20],
                        iconAnchor: [0, 0],
                        labelAnchor: [0, 0],
                        popupAnchor: [17, 0],
                        html: '<div class="pin pin9"></div>'
                    })
                });

                marker.on("click", () => {
                    currentMember = data[index];
                    showDisplayPopup();
                });
                markers.addLayer(marker);
                markers.addTo(map);
              }
            }
            
            
          }

          $('#uni_total').html(uni_total);
            $('#ghg_total').html(ghg_total);
            $('#reduct_total').html('0');

            $('.stat_number').each(function () {
                var $this = $(this);
                jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
                  duration: 1000,
                  easing: 'swing',
                  step: function () {
                    $this.text(Math.ceil(this.Counter));
                  }
                });
              });

            
            $('.cfdisplay_body').html(html);
        });
      }

       

      function showDisplayPopup(){
        console.log(currentMember);
      }

      if ($("#mapz").length) {
          var map = L.map("mapz", {
              center: [18.7896195, 98.972752],
              zoom: 7,
              attributionControl: !1,
              minZoom: 6,
              maxZoom: 13,
              scrollWheelZoom: false,
          });

          map.createPane("labels"), (map.getPane("labels").style.zIndex = 650), (map.getPane("labels").style.pointerEvents = "none");
          L.tileLayer("https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png").addTo(map), L.tileLayer("https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png").addTo(map);
      
          loadMarker();

          $(document).on("click","#btnFilter",function() {
            loadMarker();
          });

          $(document).on("click",".openPopup",function() {
            currentMember = marker_data[$(this).attr("mid")];
            showDisplayPopup();
          });
      
      }//end map

      if ($("#form_register").length) {
          $(document).on("change", "#member_province_id", function () {
              $("#member_amphur_id").val("");
              $("#member_district_id").val("");
              $.ajax({
                  url: BASE_URI + "auth/getAm?id=" + $(this).val(),
                  success: function (data) {
                      $("#member_amphur_id").html(data);
                      $("#member_amphur_id").attr("disabled", false);
                  },
              });
          });
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

          $("#form_register").validate({
              errorContainer: container,
              errorLabelContainer: $("ol", container),
              wrapper: "li",
              meta: "validate",
              rules: {
                  member_email: {
                      remote: {
                          type: "GET",
                          url: BASE_URI + "auth/checkEmail",
                          data: {
                              member_email: function () {
                                  return $("#member_email").val();
                              },
                          },
                      },
                  },
                  member_password: {
                      minlength: 6,
                  },
                  member_password_c: {
                      minlength: 6,
                      equalTo: "#member_password",
                  },
              },
              messages: {
                  member_email: {
                      remote: "อีเมล์นี้ถูกใช้ลงทะเบียนไปแล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง",
                  },
                  member_password: {
                      minlength: "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว",
                  },
                  member_password_c: {
                      minlength: "กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว",
                      equalTo: "ยืนยันรหัสผ่านไม่ถูกต้อง",
                  },
              },
              submitHandler: function (form) {
                  form.submit();
              },
          });
      }
  })(jQuery)
);
