<!DOCTYPE html>
<html>
<head>
  <title>Provide email and Pay Now</title>
  <link href="https://www.filepicker.io/api/file/Lh5PgMCTrKBCvUNRhSKy" rel="shortcut icon" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet" />
</head>
<body onload="startUp()">
  <div class="container">
    <div class="jumbotron">
      <h1 class="display-3">Paystack inline sample</h1>
      <form class="form" id="pay-form">
        <div id="alert-holder"></div>
        <div class="text-center">
          <p>Please provide your details and click "Pay" to make your payment.</p>
        </div>
        <fieldset class="form-group row">
          <label class="col-sm-3" for="firstname">First Name</label>
          <div class=" col-sm-9">
            <input class="form-control" id="firstname" type="text" placeholder="Your First name (optional)" />
          </div>
        </fieldset>
        <fieldset class="form-group row">
          <label class="col-sm-3" for="lastname">Last Name</label>
          <div class=" col-sm-9">
            <input class="form-control" id="lastname" type="text" placeholder="Your Last name (optional)" />
          </div>
        </fieldset>
        <fieldset class="form-group row">
          <label class="col-sm-3" for="email">Email Address</label>
          <div class=" col-sm-9">
            <input class="form-control" id="email" required="required" type="email" placeholder="Your Email Address" />
          </div>
          <small class="text-muted col-sm-9 col-sm-offset-3">We'll never share your email with anyone else.</small>
        </fieldset>
        <!-- The amount box is not displayed by default. Will stay so unless the GET parameter amountinkobo is a valid integer -->
        <fieldset class="form-group row" id="amountinnaira" style="display:none">
          <label class="col-sm-3" for="amount-in-naira">Amount (in Naira)</label>
          <div class="col-sm-9">
            <div class="input-group">
              <div class="input-group-addon">&#x20a6;</div>
              <input class="form-control" id="amount-in-naira" required="required" type="number" step="100" placeholder="Amount" />
              <div class="input-group-addon">.00</div>
            </div>
          </div>
        </fieldset>
        <p class="text-center" id="static-amount">You are paying: <span id="amountinngn">0</span> naira</p>
        <fieldset class="form-group row">
          <div class="col-sm-offset-3 col-sm-9">
            <button class="btn btn-secondary" type="button" onclick="validateAndPay()"> Pay </button>
          </div>
        </fieldset>
 
      </form>
    </div>
  </div>
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <script src="cv.js"></script>
  
</body>
</html>