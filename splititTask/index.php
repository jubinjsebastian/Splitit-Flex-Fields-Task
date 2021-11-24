<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="jumbotron text-center">
            <h1>Product Listing</h1>
            <p>Splitit Payment</p> 

            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                </div>
                <div class="col-xs-12 col-md-4">
                    <div id="checkout">
                        <form method="post" action="checkout.php"> 
                            <input type="hidden" name="price" id="price" value="">
                            <p>Your Monthly Instalment as low as <span id="monthly-price"></span></p>
                            <p>Your first Installment <span id="span-price"></span></p>
                            <input type="hidden" id="splitprice" name="splitprice" value="">
                            <input  class="btn btn-primary" style="background-color: #642F6C" type="submit" name="submit" value="Proceed To Checkout">
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                </div>
            </div>
            <div class="col-xs-12 col-md-4">

                <!-- First product box start here-->
                <div class="prod-info-main prod-wrap clearfix">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="product-image"> 
                                <img src="images/product2.jpg" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <!-- <form method="post" action="checkout.php">  --> 
                                <div class="product-deatil">
                                    <h5 class="name">Product One </h5>
                                    <input type="hidden" name="price" value="100">
                                    <p class="price-container"><span>$100</span> </p>
                                    <span class="tag1"></span> 
                                </div>
                                <!-- <div class="description">
                                    <input type="hidden" name="splitprice" value="17">
                                    <p>$17/month </p>
                                </div> -->
                                <div class="product-info smart-form">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <input id="100" class="cart-btn btn btn-danger" style="background-color: #642F6C" type="submit" name="submit" value="Select">  
                                        </div>
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-4">
                <!-- First product box start here-->
                <div class="prod-info-main prod-wrap clearfix">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="product-image"> 
                                <img src="images/laptop1.jpg" class="img-responsive"> 
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                                <div class="product-deatil">
                                    <h5 class="name">Product Two </h5>
                                    <input type="hidden" name="price" value="250">
                                    <p class="price-container"><span>$250</span> </p>
                                    <span class="tag1"></span> 
                                </div>
                                
                                <div class="product-info smart-form">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <input id="250" class="cart-btn btn btn-danger" style="background-color: #642F6C" type="submit" name="submit" value="Select">
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-4">
                <!-- First product box start here-->
                <div class="prod-info-main prod-wrap clearfix">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="product-image"> 
                                <img src="images/product1.png" class="img-responsive"> 
                                 
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            
                                <div class="product-deatil">
                                    <h5 class="name">Product Three </h5>
                                    <input type="hidden" name="price" value="500">
                                    <p class="price-container"><b><span>$500</span></b> </p>
                                    <span class="tag1"></span> 
                                </div>
                                
                                <div class="product-info smart-form">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <input id="500" class="cart-btn btn btn-danger" style="background-color: #642F6C" type="submit" name="submit" value="Select">
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#checkout").hide()
                $('.cart-btn').click(function() {
                    var price = this.id;                    
                    $('#price').val(price);
                    var sprice = price/6;
                    var splitprice = price-(Math.round(sprice) *5);
                    $('#splitprice').val(splitprice);
                    $('#span-price').html('$'+splitprice); 
                    $('#monthly-price').html('$'+Math.round(sprice)); 
                                      
                    $("#checkout").show()
                   //alert(splitprice);
                });
            });
        </script>
    </body>

</html>

