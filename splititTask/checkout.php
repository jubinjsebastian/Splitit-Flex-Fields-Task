<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js" ></script>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/checkout-css.css">

    </head>

    <body>
        <div class="jumbotron text-center">
            <h1>Checkout Page</h1>
            <p>Splitit Payment</p> 
        </div>
        <div class="row">
            <div class="col-75">
                <div class="container">

                    <div class="row">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="john@example.com">
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="New York">

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="NY">
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="10001">
                                </div>
                            </div>
                        </div>

                        <div class="col-50">
                            <h3>Payment</h3>
                            <label for="fname">Accepted Cards</label>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>

                            <div style="padding-bottom: 10px; margin-bottom: 10px;">
                                <p>Grant Total: $<?php echo $_POST['price'] ?></p>
                                <?php $monthy =  ($_POST['price'] - $_POST['splitprice'])/5 ?>
                                <p>Your Monthly Instalment as low as $<?php echo $monthy;  ?></p>
                                <p>Your first Installment $<?php echo $_POST['splitprice']  ?></p>
                                <button type="button" style="background-color: #642F6C" class="btn btn-success" onclick="flexFields.show()">Pay with Splitit </button>
                            </div>
                            <div class="splitit-design-classic" id="splitit-card-data">
                                <div class="splitit-cc-group">
                                    <div id="splitit-card-number"></div>
                                    <div id="splitit-expiration-date"></div>
                                    <div id="splitit-cvv"></div>
                                    <div class="splitit-cc-group-separator"></div>
                                </div>
                                <div id="splitit-installment-picker"></div>
                                <div id="splitit-error-box"></div>
                                <div id="splitit-terms-conditions"></div>
                                <button id="splitit-btn-pay"></button>
                            </div>
                            <link rel="stylesheet" type="text/css" href="https://flex-fields.sandbox.splitit.com/css/splitit.flex-fields.min.css">
                            <script src="https://flex-fields.sandbox.splitit.com/js/dist/splitit.flex-fields.sdk.js"></script>

                            <?php
                            $base_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?');

                            $url = 'https://webapi.sandbox.splitit.com/api/Login?format=json';
                            $header = array("Content-Type: application/json");
                            $post = '{"UserName":"APIUser000034416", "Password":"nS1sdm19bV46XbYugrUuC4xeKkNaBktcvkjDvY4snMS9DxRzs1"}';
                            $a = curlRequest("POST", $url, $header, $post);
                            $result = json_decode($a, true);

                            $sessionId = $result['SessionId'];


                            $url = 'https://webapi.sandbox.splitit.com/api/InstallmentPlan/Initiate?format=json';
                            $header = array("Content-Type: application/json");

                            $post = '{
                              "RequestHeader": {
                                "SessionId": "",
                                "ApiKey": "b7cb2abe-18b7-4ad5-a458-2ef119fd0e76"
                              },
                              "PlanData": {
                                "Amount": {"Value": 1200,"CurrencyCode": "USD"},
                                "FirstInstallmentAmount": {"Value": 83},
                                "RefOrderNumber": "abc123",
                                "AutoCapture": false,
                                "ExtendedParams": {
                                  "AnyParameterKey1": "AnyParameterVal1",
                                  "AnyParameterKey2": "AnyParameterVal2"
                                }
                              },
                              "BillingAddress": {
                                "AddressLine": "1 street",
                                "AddressLine2": "Appartment 1",
                                "City": "New York",
                                "State": "VA",
                                "Country": "USA",
                                "Zip": "10016"
                              },
                              "ConsumerData": {
                                "FullName": "John Smith",
                                "Email": "JohnS@splitit.com",
                                "PhoneNumber": "1-844-775-4848",
                                "CultureName": "en-us"
                              },
                              "PaymentWizardData": {
                                "RequestedNumberOfInstallments": "6"
                              },
                              "RedirectUrls": {
                                "Succeeded": "",
                                "Failed": "",
                                "Canceled": ""
                              },
                              "EventsEndpoints": {
                                "CreateSucceeded": "https://www.async-success.com/"
                              }
                            }';

                            $jdc_post = json_decode($post, true);
                            $jdc_post['RequestHeader']['SessionId'] = $sessionId;
                            $jdc_post['PlanData']['Amount']['Value'] = $_POST['price'];
                            $jdc_post['PlanData']['FirstInstallmentAmount']['Value'] = $_POST['splitprice'];
                            $jdc_post['RedirectUrls']['Succeeded'] = $base_url . "/get.php";
                            $jdc_post['RedirectUrls']['Failed'] = $base_url . "/get.php";

                            $post = json_encode($jdc_post);

                            $a = curlRequest("POST", $url, $header, $post);

                            $jdc_result = json_decode($a, true);

                            $publicToken = $jdc_result['PublicToken'];


                            function curlRequest($type, $url, $header, $post) {
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, $url);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                if ($type == "POST") {
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                                } else if ($type == "PUT" && $post <> NULL) {
                                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                                } else if ($type == "GET") {
                                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
                                }

                                $server_output = curl_exec($ch);
                                $err = curl_error($ch);
                                curl_close($ch);

                                return $server_output;
                            }
                            ?>
                            <script>
                            var datatest;
                            var flexFields = Splitit.FlexFields.setup({
                                // debug: true, // <<-- uncomment for extended errors
                                culture: "en-US",
                                publicToken: "<?php echo $publicToken ?>",
                                container: "#splitit-card-data",
                                fields: {
                                    number: {
                                        selector: "#splitit-card-number"
                                    },
                                    cvv: {
                                        selector: "#splitit-cvv"
                                    },
                                    expirationDate: {
                                        selector: "#splitit-expiration-date"
                                    }
                                },
                                installmentPicker: {
                                    selector: "#splitit-installment-picker"
                                },
                                termsConditions: {
                                    selector: "#splitit-terms-conditions"
                                },
                                errorBox: {
                                    selector: "#splitit-error-box"
                                },
                                paymentButton: {
                                    selector: "#splitit-btn-pay"
                                },
                                billingAddress: {
                                    addressLine: "260 Madison Avenue.",
                                    addressLine2: "Apartment 1",
                                    city: "New York",
                                    state: "NY",
                                    country: "USA",
                                    zip: "10016"
                                },
                                consumerData: {
                                    fullName: "John Smith",
                                    email: "JohnS@splitit.com",
                                    phoneNumber: "1-844-775-4848",
                                    cultureName: "en-us"
                                }
                            })
                                    .ready(function () {})
                                    .onSuccess(function (result) {
                                        location.href = 'get.php?ipn=' + result.data.installmentPlan.installmentPlanNumber;
                                        // datatest = result;
                                        // console.log(result.installmentPlan);
                                        // result.data.installmentPlan.installmentPlanNumber
                                    })
                                    .onError(function (err) {
                                        // Payment failed, error object will have the details (Flex Fields object descriptions are below)
                                        console.log(err);
                                    })
                            </script>
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </body>
</html>
