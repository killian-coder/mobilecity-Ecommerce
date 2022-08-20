 </div><br><br>
 <div class="col-md-12 text-center">&copyright 2014-2017 mobile city zambia</div>


 <!-- Bootstrap Core JavaScript -->
 <script src="../js/bootstrap.min.js"></script>
 <script>
     function updateSizes() {
         var sizeString = '';
         for (var i = 1; i <= 12; i++) {
             if (jQuery('#size' + i).val() != '') {
                 sizeString += jQuery('#size' + i).val() + ':' + jQuery('#qty' + i).val() + ',';
             }
         }
         jQuery('#sizes').val(sizeString);
     }


     function get_child_options(selected) {
         if (typeof selected === 'undefined') {
             var selected = ''
         }
         var parentID = jQuery('#parent').val();
         jQuery.ajax({
             url: '/mobilecity-Ecommerce/admin/parsers/child_categories.php',
             type: 'POST',
             data: {
                 parentID: parentID,
                 selected: selected
             },
             success: function(data) {
                 jQuery('#child').html(data);
             },
             error: function() {
                 alert("something went wrong with a child option.")
             },
         });
     }
     jQuery('select[name="parent"]').change(function() {
         get_child_options()
     });
 </script>

 <script>
     (function($) {
         $(document).ready(function() {
             $('#cssmenu').prepend('<div id="bg-one"></div><div id="bg-two"></div><div id="bg-three"></div><div id="bg-four"></div>');
             jQuery('#camera_wrap').camera({
                 loader: false,
                 thumbnails: false
             });
             jQuery('#camera_wrap_2').camera({
                 loader: false,
                 pagination: false,
                 thumbnails: false
             });
         });
     })(jQuery);
 </script>

 </body>

 </html>