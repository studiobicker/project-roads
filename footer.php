   <!--Footer area start-->
   <footer>
     <div class="container-fluid py-3">
       <p class="small">&copy; Copyright 2012 - <?php echo date('Y'); ?></p>
     </div>
   </footer>
   <!--Footer area end-->
   </div>
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"
     integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
     integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
   </script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
     integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
     integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
   <script
     src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.nl.min.js"
     integrity="sha256-XerzQ5saqHDPwOSj67vG2eHzBqqMvFlm/nnCH8I2ZGE=" crossorigin="anonymous"></script>

   <script type="text/javascript" src="<?php echo url_for('/assets/js/main.js'); ?>"></script>
   <script type="text/javascript" src="<?php echo url_for('/assets/js/rides.js'); ?>"></script>
   <script type="text/javascript" src="<?php echo url_for('/assets/js/bootstrap-colorpicker.js'); ?>"></script>

   </body>

   </html>
   <?php
  db_disconnect($database);
?>