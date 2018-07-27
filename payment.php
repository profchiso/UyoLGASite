<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UyoLGA | Payment</title>
    <link href="img/favicon.png" rel="icon">
 




    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="assets/bootstrap/fonts/font-awesome.min.css">
</head>

<body class="bg-dark" style="background-color: black;">
    <div class="container-fluid"></div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Welcome to our secured Payment platform</h3></div>
        <div class="panel-body" style="background-color: black;">
            <div class="row .payment-dialog-row">
                <div class="col-md-4 col-md-offset-4 col-xs-12">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="panel-title-text">Payment Details </span><img class="img-responsive panel-title-image" src="img/accepted_cards.png"></h3></div>
                        <div class="panel-body">
                            <form id="payment-form">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="cardNumber">Card number </label>
                                            <div class="input-group">
                                                <input class="form-control" type="tel" required="" placeholder="Valid Card Number" id="cardNumber">
                                                <div class="input-group-addon"><span><span class="fa fa-credit-card"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7">
                                        <div class="form-group">
                                            <label class="control-label" for="cardExpiry"><span class="hidden-xs">expiration </span><span class="visible-xs-inline">EXP </span> date</label>
                                            <input class="form-control" type="tel" required="" placeholder="MM / YY" id="cardExpiry">
                                        </div>
                                    </div>
                                    <div class="col-xs-5 pull-right">
                                        <div class="form-group">
                                            <label class="control-label" for="cardCVC">cv code</label>
                                            <input class="form-control" type="tel" required="" placeholder="CVC" id="cardCVC">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="couponCode">coupon code</label>
                                            <input class="form-control" type="text" id="couponCode">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-success btn-block btn-lg" type="submit">Pay </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"><a href="index.php"> <span>Home </span></a></div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>