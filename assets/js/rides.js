(function($) {
  /**
   * Rides administration functions file.
   */

  $(document).ready(function() {
    /* show/hide client input fields based on factuurcode */
    $("#opdracht_factuurcode").on("change", function() {
      const selected = $("#opdracht_factuurcode option:selected");

      if (selected.val() == "F99" || selected.val() == "") {
        $("#opdracht_opdracht").focus();
        $("#opdrachtgever").hide();
      } else {
        $("#opdrachtgever").show();
        $("#opdracht_prijs").focus();
      }
    });

    /* ajax live search in contacts db used for client, departure and destinations address */

    $(".contact_search").on("input", function() {
      const result = $(this).data("result");
      const q = $(this).val();

      if (q.length < 2) {
        $("#" + result).hide();
        return;
      }

      $.ajax({
        type: "POST",
        url: "livesearch.php",
        data: "keyword=" + q,
        success: function(data) {
          $("#" + result).show();
          $("#" + result).html(data);
        }
      });
    });

    /* set client address obtained through Ajax Live Search */
    $("#client_box").on("click", "a", function(e) {
      e.preventDefault();
      const id = $(this).data("id");

      $.ajax({
        url: "contact.php",
        type: "POST",
        dataType: "json",
        data: "id=" + id,
        success: function(data) {
          let telefoon =
            data.rl_mobiel.length > 0 ? data.rl_mobiel : data.rl_telefoon;
          $("#opdracht_opdrachtgeverid").val(data.rl_id);
          $("#opdracht_kostenplaats").val(data.rl_kostenplaats);
          $("#opdracht_factuurbedrijf").val(data.rl_bedrijf);
          $("#opdracht_factuurnaam").val(data.rl_naam);
          $("#opdracht_telefoon").val(telefoon);
          $("#opdracht_factuuradres").val(data.rl_adres);
          $("#opdracht_factuurpostcode").val(data.rl_postcode);
          $("#opdracht_factuurplaats").val(data.rl_woonplaats);
          $(".contact_search").val("");
          $("#client_box").html("");
          $("#opdracht_factuurbedrijf").focus();
        }
      });
    });

    /* set departure address obtained through Ajax Live Search */
    $("#departure_box").on("click", "a", function(e) {
      e.preventDefault();
      const id = $(this).data("id");

      $.ajax({
        url: "contact.php",
        type: "POST",
        dataType: "json",
        data: "id=" + id,
        success: function(data) {
          let telefoon =
            data.rl_mobiel.length > 0 ? data.rl_mobiel : data.rl_telefoon;
          $("#rit_vertrekid").val(data.rl_id);
          $("#rit_vertrekbedrijf").val(data.rl_bedrijf);
          $("#rit_vertreknaam").val(data.rl_naam);
          $("#rit_vertrektelefoon").val(telefoon);
          $("#rit_vertrekadres").val(data.rl_adres);
          $("#rit_vertrekpostcode").val(data.rl_postcode);
          $("#rit_vertrekplaats").val(data.rl_woonplaats);
          $(".contact_search").val("");
          $("#departure_box").html("");
          $("#rit_vertrekbedrijf").focus();
        }
      });
    });

    /* set destination address obtained through Ajax Live Search */
    $("#destination_box").on("click", "a", function(e) {
      e.preventDefault();
      const id = $(this).data("id");

      $.ajax({
        url: "contact.php",
        type: "POST",
        dataType: "json",
        data: "id=" + id,
        success: function(data) {
          let telefoon =
            data.rl_mobiel.length > 0 ? data.rl_mobiel : data.rl_telefoon;
          $("#rit_bestemmingsid").val(data.rl_id);
          $("#rit_bestemmingsbedrijf").val(data.rl_bedrijf);
          $("#rit_bestemmingsnaam").val(data.rl_naam);
          $("#rit_bestemmingstelefoon").val(telefoon);
          $("#rit_bestemmingsadres").val(data.rl_adres);
          $("#rit_bestemmingspostcode").val(data.rl_postcode);
          $("#rit_bestemmingsplaats").val(data.rl_woonplaats);
          $(".contact_search").val("");
          $("#destination_box").html("");
          $("#rit_bestemmingsbedrijf").focus();
        }
      });
    });

    $("#save_client").on("click", function(e) {
      e.preventDefault();
      rl_id = $("#opdracht_opdrachtgeverid").val();
      rl_bedrijf = $("#opdracht_factuurbedrijf").val();
      rl_naam = $("#opdracht_factuurnaam").val();
      rl_mobiel = $("#opdracht_telefoon").val();
      rl_adres = $("#opdracht_factuuradres").val();
      rl_postcode = $("#opdracht_factuurpostcode").val();
      rl_woonplaats = $("#opdracht_factuurplaats").val();
      rl_kostenplaats = $("#opdracht_kostenplaats").val();

      debugger;

      $.ajax({
        url: "saveadres.php",
        type: "POST",
        dataType: "json",
        data: {
          rl_id,
          rl_bedrijf,
          rl_naam,
          rl_mobiel,
          rl_adres,
          rl_postcode,
          rl_woonplaats,
          rl_kostenplaats
        },
        success: function(data) {
          debugger;
          //$("#opdracht_opdrachtgeverid").val(data.id);
          alert(data.message);
        }
      });
    });
  });
})(jQuery);
