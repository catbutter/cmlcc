
<section class="hero p-3 mb-3">
    <div class="row d-flex align-items-center">
        <div class="col-3 wow fadeInLeft" data-wow-delay="0.2s">
            
        </div>
        <div class="col-6">
            <h1 class="text-center wow bounce" data-wow-delay="0.5s">Chiang Mai Low Carbon City</h1>
        </div>
        <div class="col-3 text-end wow fadeInRight" data-wow-delay="0.2s">
            
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-4 ">
                <div id="tool_query" class="h-100 p-3">
                    <div class="row mb-3">
                        <div class="col-4">
                            <div class="bnav d-flex justify-content-center align-items-center p-2 rounded">
                                <img src="template/img/btn_1.png" width="50">
                                <span>Carbon<br/>Footprint<br/>Organization</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bnav d-flex justify-content-center align-items-center p-2 rounded" style="background-color: #dcdcdc;">
                                <img src="template/img/btn_2.png" width="50">
                                <span>Carbon<br/>Neutral<br/>Event</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bnav d-flex justify-content-center align-items-center p-2 rounded" style="background-color: #dcdcdc;">
                                <img src="template/img/btn_3.png" width="50">
                                <span>Low<br/>Carbon<br/>Challenge</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <select class="form-control" size="8" name="query_type" id="query_type">
                                <option value="" selected>ทั้งหมด</option>
                                <option value="1">องค์กรปกครองส่วนท้องถิ่น (เทศบาล, อบต., อบจ.)</option>
                                <option value="2">ส่วนราชการ</option>
                                <option value="3">โรงเรียน</option>
                                <option value="4">มหาวิทยาลัย</option>
                                <option value="5">โรงแรม</option>
                                <option value="6">SMEs/ผู้ประกอบการ</option>
                                <option value="7">อื่นๆ</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="div_query_display rounded pe-3 pt-1 ps-3">
                                <div class="row header d-flex align-items-center text-center rounded p-2">
                                    <div class="col-6">หน่วยงาน</div>
                                    <div class="col-3">การปล่อย <br/>(tCO<sub>2</sub>eq)</div>
                                    <div class="col-3">การลด <br/>(tCO<sub>2</sub>eq)</div>
                                </div>
                              
                                <div id="tbl_body"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <style>
                    #popupDetail{
                        z-index: 999;
                        border: none;
                        position: relative;
                    }
                    #popupDetail #popup_title{font-size: 20px;}
                    #popupDetail .btnclose{
                        position: absolute;
  right: 5px;
  top: 5px;
  border: 1px solid #333;
  border-radius: 50%;
  padding: 1px 4px;
  cursor: pointer;
                    }
                </style>
                <div id="map_container" class="mb-3">
                    <div id="map">
                        <div class="row">
                            <div id="popupDetail" class="card col-12 col-sm-6 offset-sm-1 mt-3 p-3" style="display:none;">
                                <div class="btnclose">
                                 <i class='bx bx-x' ></i>
                                </div>
                                <h3 id="popup_title">หน่วยวิจัยเพื่อการจัดการพลังงานและเศรษฐนิเวศ สถาบันวิจัยพหุศาสตร์</h3>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        ระดับ 
                                        <span class="star">
                                            <i class='bx bxs-star' ></i>
                                        </span>
                                    </div>
                                </div>
                                
                                <!--GHG-->
                                <div class="mb-3 ghg" >
                                    <h6>การปล่อยก๊าซเรือนกระจก <span id="vscope"></span> (tCO2eq)</h6>
                                    <div class="row mb-1">
                                        <div class="col-6">ขอบเขตที่ 1</div>
                                        <div class="col-3 text-end"><span id="vscope1"></span></div>
                                        <div class="col-3">(tCO<sub>2</sub>eq)</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-6">ขอบเขตที่ 2</div>
                                        <div class="col-3 text-end"><span id="vscope2"></span></div>
                                        <div class="col-3">(tCO<sub>2</sub>eq)</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-6">ขอบเขตที่ 3</div>
                                        <div class="col-3 text-end"><span id="vscope3"></span></div>
                                        <div class="col-3">(tCO<sub>2</sub>eq)</div>
                                    </div>
                                </div>

                                 <!--Target-->
                                 <div class="mb-3 target" >
                                    <h6>มีการตั้งเป้าหมายการลดก๊าซเรือนกระจก </h6>
                                    <div class="row mb-1">
                                        <div class="col-6">ณ ปี 2030</div>
                                        <div class="col-3 text-end"><span id="vtarget1"></span></div>
                                        <div class="col-3">%</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-6">ณ ปี 2050</div>
                                        <div class="col-3 text-end"><span id="vtarget2"></span></div>
                                        <div class="col-3">%</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-6">ณ ปี 2065</div>
                                        <div class="col-3 text-end"><span id="vtarget3"></span></div>
                                        <div class="col-3">%</div>
                                    </div>
                                </div>
                        </div>
                       </div>
                        
                    </div>
                    <div class="legend p-2 rounded">
                        <div class="m-0">
                            <span class="query_star"><i class='bx bxs-star' ></i></span>
                            <span class="query_stat" id="v_star_1">123</span>
                            แห่ง
                        </div>
                        <div class="m-0">
                            <span class="query_star"><i class='bx bxs-star' ></i><i class='bx bxs-star' ></i></span>
                            <span class="query_stat" id="v_star_2">123</span>
                            แห่ง
                        </div>
                        <div class="m-0">
                            <span class="query_star"><i class='bx bxs-star' ></i><i class='bx bxs-star' ></i><i class='bx bxs-star' ></i></span>
                            <span class="query_stat" id="v_star_3">123</span>
                            แห่ง
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="alert alert-success">
                    <h5>เกณฑ์ Chiang Mai Low Carbon City</h5>
                    <div class="m-0">
                        <span class="star"><i class='bx bxs-star' ></i></span>
                        มีการจัดทำฐานข้อมูลก๊าซเรือนกระจก/มีการตั้งเป้าหมายการลดก๊าซเรือนกระจก/มีการดำเนินกิจกรรมการลดก๊าซเรือนกระจก</div>
                    <div class="m-0">
                    <span class="star"><i class='bx bxs-star' ></i><i class='bx bxs-star' ></i></span>
                        มีการจัดทำฐานข้อมูลก๊าซเรือนกระจก/มีการตั้งเป้าหมายการลดก๊าซเรือนกระจก/มีการดำเนินกิจกรรมการลดก๊าซเรือนกระจก (2 ใน 3)</div>
                    <div class="m-0">
                    <span class="star"><i class='bx bxs-star' ></i><i class='bx bxs-star' ></i><i class='bx bxs-star' ></i></span>
                        มีการจัดทำฐานข้อมูลก๊าซเรือนกระจก/มีการตั้งเป้าหมายการลดก๊าซเรือนกระจก/มีการดำเนินกิจกรรมการลดก๊าซเรือนกระจก (ครบทั้ง 3)</div>
                </div>
            </div>   
        </div>

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-4">
                <div class="stat p-3 text-center">
                    <div class="number" id="v_stat_1">123</div>
                    <div class="line"></div>
                    <div class="text">จำนวนสมาชิก (แห่ง)</div>
                </div>
            </div>
            <div class="col-4">
                <div class="stat p-3 text-center">
                    <div class="number" id="v_stat_2">123</div>
                    <div class="line"></div>
                    <div class="text">การปล่อยก๊าซเรือนกระจก (tCO<sub>2</sub>eq)</div>
                </div>
            </div>
            <div class="col-4">
                <div class="stat p-3 text-center">
                    <div class="number" id="v_stat_3">123</div>
                    <div class="line"></div>
                    <div class="text">การลดก๊าซเรือนกระจก (tCO<sub>2</sub>eq)</div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" crossorigin=""></script>
<style>
    .pin{
        color: #fff;
  border-radius: 50%;
  text-align: center;
  padding: 1px 4px;
    }
</style>
<script>
        var map = new L.map("map", {
            center: [18.8093571,99.0406918],
            zoom: 11,
            attributionControl: false,
            maxZoom: 16,
            minZoom: 11,
            fullscreenControl: true,
        });
        
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png').addTo(map);

        var markers = L.layerGroup();
        var currentMember = null;
        
        loadMarker(null);
        function loadMarker(selectedValue){
            markers.clearLayers();
            var star_1=0, star_2= 0,star_3= 0;
            var stat_1=0, stat_2= 0,stat_3= 0;
            var stats = [0, 0, 0, 0, 0, 0, 0];
            var html ='';
            var html_summary ='';
            $.ajax({
                url: 'https://cm.lcc.3e.world/main/getMarker',
                type: 'GET',
                data: { type: selectedValue },
                dataType: 'json',
                success: function(data) {
                    for (let index = 0; index < data.length; index++) {
                        var stars = [0, star_1, star_2, star_3]; 
                        stars[data[index].member_star]++;
                        star_1 = stars[1];
                        star_2 = stars[2];
                        star_3 = stars[3];

                        var type = data[index].member_group_id;
                        if (type >= 1 && type <= 7) {
                            stats[type - 1] += data[index].GHGtotal;
                        }

                        stat_1 ++;
                        stat_2 += data[index].GHGtotal;
                        if (data[index].member_lat != null && data[index].member_lon != null) {
                            const marker = L.marker([data[index].member_lat, data[index].member_lon], {
                                icon: L.divIcon({
                                    className: "my-custom-pin",
                                    iconSize: [20, 20],
                                    iconAnchor: [0, 0],
                                    labelAnchor: [0, 0],
                                    popupAnchor: [17, 0],
                                    html: '<div class="pin" style="background-color: '+data[index].color+';"><i class="bx bx-buildings" ></i></div>'
                                })
                            });

                            marker.on("click", () => {
                                currentMember = data[index];
                                showDisplayPopup();
                            });
                            markers.addLayer(marker);
                            markers.addTo(map);
                        }

                        html +='<div class="row body">';
                        html +='    <div class="col-6">'+data[index].member_name+'</div>';
                        html +='    <div class="col-3 text-center">'+data[index].GHGtotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</div>';
                        html +='    <div class="col-3 text-center">0</div>';
                        html +='</div>';
                    }

                    var type_name = ['องค์กรปกครองส่วนท้องถิ่น (เทศบาล, อบต., อบจ.)', 'ส่วนราชการ', 'โรงเรียน', 'มหาวิทยาลัย', 'โรงแรม', 'SMEs/ผู้ประกอบการ', 'อื่นๆ'];
                    for (let index = 0; index < type_name.length; index++) {
                        html_summary +='<div class="row body">';
                        html_summary +='    <div class="col-6">'+type_name[index]+'</div>';
                        html_summary +='    <div class="col-3 text-center">'+stats[index].toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</div>';
                        html_summary +='    <div class="col-3 text-center">0</div>';
                        html_summary +='</div>';
                    }
                    
                   
                    $('#tbl_body').html(selectedValue ? html : html_summary);
                   
                    $('#v_star_1').html(star_1);
                    $('#v_star_2').html(star_2);
                    $('#v_star_3').html(star_3);

                    $('#v_stat_1').html(stat_1.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#v_stat_2').html(stat_2.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('#v_stat_3').html(stat_3.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ","));

                }
            });
        }

        $('.btnclose').click(function() {
            $('#popupDetail').fadeOut();
        });

        function showDisplayPopup(){
          
            var html_star = '';
            var html_data = "<i class='bx bxs-star' ></i>";
            var stars = 3; // สมมติค่าตัวเลขที่รับมาเป็น 3

            for (var i = 0; i < currentMember.member_star; i++) {
                html_star += html_data;
            }

            $('#popupDetail #popup_title').html(currentMember.member_name);
            $('#popupDetail .star').html(html_star);

            if(currentMember.GHGtotal){
                $('#popupDetail .ghg').show();
            }else{
                $('#popupDetail .ghg').hide();
            }

    
            $('#popupDetail #vscope').html(currentMember.GHGtotal.toFixed(0));
            $('#popupDetail #vscope1').html(currentMember.GHG_scope1.toFixed(0));
            $('#popupDetail #vscope2').html(currentMember.GHG_scope2.toFixed(0));
            $('#popupDetail #vscope3').html(currentMember.GHG_scope3.toFixed(0));

            
            if(Object.keys(currentMember.target).length){
                $('#popupDetail .target').show();
                
                $('#popupDetail #vtarget1').html(currentMember.target.target_1);
                $('#popupDetail #vtarget2').html(currentMember.target.target_2);
                $('#popupDetail #vtarget3').html(currentMember.target.target_3);

            }else{
                $('#popupDetail .target').hide();
            }

            $('#popupDetail').fadeIn();
        }

        $('#query_type').change(function() {
            var selectedValue = $(this).val(); // ดึงค่าที่เลือกใน select
            loadMarker(selectedValue)
        });
</script>