<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Splitit Payment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="jumbotron text-center">
            <h1>Payment Confirmation</h1>
            <p>Splitit Payment</p> 
        </div>
        <?php

        $url = 'https://webapi.sandbox.splitit.com/api/Login?format=json';
        $header = array("Content-Type: application/json");
        $post = '{"UserName":"APIUser000034416", "Password":"nS1sdm19bV46XbYugrUuC4xeKkNaBktcvkjDvY4snMS9DxRzs1"}';
        $a = curlRequest("POST", $url, $header, $post);
        $result = json_decode($a, true);

        $sessionId = $result['SessionId'];

        $url = 'https://webapi.sandbox.splitit.com/api/InstallmentPlan/Get';
        $header = array("Content-Type: application/json");

        $post = new StdClass();
        $post->RequestHeader = new StdClass();
        $post->RequestHeader->SessionId = $sessionId;
        $post->QueryCriteria = new StdClass();
        $post->QueryCriteria->InstallmentPlanNumber = $_REQUEST['ipn'];

        $post = json_encode($post);

        $a = curlRequest("POST", $url, $header, $post);

        $b = json_decode($a, true);

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
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Result</h3>
                    <div class="alert alert-success" role="alert">
                      Completed your payment has been successfully!
                    </div>
                    <p>Installment Plan Number: 
                        <?php
                        $ipn = isset($b['PlansList'][0]['InstallmentPlanNumber']) ? $b['PlansList'][0]['InstallmentPlanNumber'] : '';
                        echo $ipn;
                        ?></p>
                    <p>
                        <?php
                        $base_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?');
                        $url = $base_url . '/refund.php?ipn=' . $ipn;
                        ?>
                        <button class="btn btn-success" style="background-color: #642F6C" onclick="window.location.href = '<?php echo $url ?>'">Refund</button>   

                    </p>
                </div>
                <div class="col-sm-6">
                    
                </div>

            </div>
        </div>

    </body>
</html>


