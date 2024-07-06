(function ($) {
  $(document).ready(function () {
    // Initialize the minitoggle
    $("#toggle1").minitoggle();

    // Check the initial value and set the active class accordingly
    let currentValue = $("#pqrc_qrcode_toggle").val();
    if (currentValue == "1") {
      $("#toggle1 .minitoggle").addClass("active");
      $("#toggle1 .toggle-handle").attr('style', 'transform: translate3d(36px, 0px, 0px');
    } else {
      $("#toggle1 .minitoggle").removeClass("active");
    }

    // Attach the toggle event listener
    $("#toggle1").on("toggle", function (e) {
      if (e.isActive) {
        $("#pqrc_qrcode_toggle").val("1");
      } else {
        $("#pqrc_qrcode_toggle").val("0");
      }
    });
  });
})(jQuery);
