</div><br><br>
<footer class="footer-distributed">

            <div class="footer-left">

                <h3><img src="image/header123.png" alt="mobilecity"></h3>

                <p class="footer-links">
                    <a href="#">Home</a>
                    ·
                    <a href="#">Blog</a>
                    ·
                    <a href="#">Pricing</a>
                    ·
                    <a href="#">About</a>
                    ·
                    <a href="#">Faq</a>
                    ·
                    <a href="#">Contact</a>
                </p>

                <p class="footer-company-name">Mobile City &copy; 2015</p>
            </div>

            <div class="footer-center">

                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><span> Cairo Road Town Center</span> Lusaka, Zambia</p>
                </div>

                <div>
                    <i class="fa fa-phone"></i>
                    <p>+260976127357</p>
                </div>

                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:support@company.com">support@mobilecity.com</a></p>
                </div>

            </div>

            <div class="footer-right">

                <p class="footer-company-about">
                    <span>About the company</span>
                    mobile city is one of the phone leading brands in zambia , here we guarantee you with a genuine mobile phone our product ares the best  on the zambia market. 

                <div class="footer-icons">

                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>

                </div>

            </div>

        </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });
     
    function detailsmodel(id){
       var data = {"id" : id};
       jQuery.ajax({
         url : '/mobilecity-Ecommerce/includes/detailsmodal.php',
         method : 'post',
         data : data, 
         success: function(data){
            jQuery('body').append(data);
            jQuery('#details-modal').modal('toggle');
         },
         error: function(){
            alert("somthing went extremely wrong!");
         }
       });
   }

    function update_cart(mode,edit_id,edit_size){
        var data = {"mode": mode, "edit_id": edit_id, "edit_size" : edit_size};
        jQuery.ajax({
            url: '/mobilecity-Ecommerce/admin/parsers/update_cart.php',
            method : 'post',
            data : data,
            success : function(){location.reload();},
            error : function(){alert("somthing went wrong.");},
        }); 
    }


    function add_to_cart(){
        jQuery('#modal_errors').html("");
        var size = jQuery('#size').val();
        var quantity = Number(jQuery('#quantity').val());
        var available = jQuery('#available').val();
        var error = '';
        var data = jQuery('#add_product_form').serialize();
        if(size == '' || quantity == '' || quantity ==0){
            error += '<p class="text-danger text-center">You must choice a size and quantity.</p>';
            jQuery('#modal_errors').html(error);
            return;
        }else if(quantity > available){
             error += '<p class="text-danger text-center">There are only '+available+' available.</p>';
             jQuery('#modal_errors').html(error);
             return;
        }else{
            jQuery.ajax({
                url : '/mobilecity-Ecommerce/admin/parsers/add_cart.php',
                method :'post',
                data : data,
                success : function(){
                    location.reload();
                },
                error : function(){alert("somthing went wrong");} 
            });
        }
    } 
   
    </script>
</body>
</html>