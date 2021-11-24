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
            <h1>Refund Status</h1>
            <p>Splitit Payment</p> 
        </div>
        <?php
        $base_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?');
        $url = 'https://webapi.sandbox.splitit.com/api/Login?format=json';
        $header = array("Content-Type: application/json");
        $post = '{"UserName":"APIUser000034416", "Password":"nS1sdm19bV46XbYugrUuC4xeKkNaBktcvkjDvY4snMS9DxRzs1"}';
        $a = curlRequest("POST", $url, $header, $post);
        $result = json_decode($a, true);

        $sessionId = $result['SessionId'];

        $url = 'https://webapi.sandbox.splitit.com/api/InstallmentPlan/Refund';
        $header = array("Content-Type: application/json");

        $post = '{
            "RequestHeader": {
                "SessionId": "",
            },
            "InstallmentPlanNumber": "",
            "Amount": {
                "Value": "150"
            },
            "RefundStrategy": "FutureInstallmentsFirst"
        }';

        $jdc_post = json_decode($post, true);
        $jdc_post['RequestHeader']['SessionId'] = $sessionId;
        $jdc_post['InstallmentPlanNumber'] = $_REQUEST['ipn'];
        $post = json_encode($jdc_post);

        $a = curlRequest("POST", $url, $header, $post);

        $jdc_result = json_decode($a, true);

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
                    Refunded sucessfully!.
                    </div>

                </div>
                <div class="col-sm-6">
                   
                </div>

            </div>
        </div>

    </body>
</html>





