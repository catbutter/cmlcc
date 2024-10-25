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
    var BASE_URI = "https://cfuniversity.3e.world/";

    $("#frm_changepwd").validate({
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

  })(jQuery)
);
