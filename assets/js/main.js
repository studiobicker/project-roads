(function($) {
  /**
   * App functions file.
   */

  $(document).ready(function() {
    $(".entry-row").click(function() {
      const id = $(this).data("id");
      window.location.href = window.location.pathname + "details.php?id=" + id;
    });

    $("#cp1").colorpicker();

    $("#datepicker").datepicker({
      format: "yyyy-mm-dd",
      language: "nl",
      todayHighlight: true
    });
    $("#datepicker").on("changeDate", function() {
      window.location.href =
        window.location.pathname +
        "?datum=" +
        $("#datepicker").datepicker("getFormattedDate");
      // $("#picked-date").val($("#datepicker").datepicker("getFormattedDate"));
    });

    $(".input-group.date").datepicker({
      language: "nl",
      format: "dd-mm-yyyy"
    });
  });
})(jQuery);
