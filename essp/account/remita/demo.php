<?php session_start() ?>
<form onsubmit="makePayment()" id="payment-form">
    <ul class="form-style-1">
        <li>
            <label>Full Name <span class="required">*</span></label>
            <input type="text" id="js-firstName" value="checking" name="firstName" class="field-divided" placeholder="First"/>&nbsp;
            <input type="text" id="js-lastName" name="lastName" value="mubarak"  class="field-divided" placeholder="Last"/>
        </li>
        <li>
            <label>Email <span class="required">*</span></label>
            <input type="email" id="js-email" value="local@gmail.com" name="email" value class="field-long"/>
        </li>
        <li>
            <label>Narration <span class="required">*</span></label>
            <input type="text" id="js-narration" value="local saying" name="narration" class="field-long"/>
        </li>
        <li>
            <label>Amount <span class="required">*</span></label>
            <input type="number" id="js-amount" value="20000" name="amount" class="field-long"/>
        </li>
        <li>
            <input type="button" onclick="makePayment()" value="Pay"/>
        </li>
    </ul>
</form>

<div id="data">Results:</div>

<script src="jquery.min.js"></script>
<script>



  function makePayment() {
      
      var form = document.querySelector("#payment-form");
      

const newValues = {
			amount:form.querySelector('input[name="amount"]').value,
			payerName:form.querySelector('input[name="lastName"]').value,
			payerEmail:form.querySelector('input[name="email"]').value,
			payerPhone:"08089999009",
			description:form.querySelector('input[name="narration"]').value,
		};
	
$.ajax({
          url: "TestRRRGeneratorAndStatus.php",
          method:'POST',
          dataType: "json",
		  data: newValues ,
          beforeSend: function() {
          alert('loading...');
         },
          success: function(data) {
			//  alert(JSON.stringify(data));
            var datas1 = JSON.parse(JSON.stringify(data));
            $('#data').append('</br>statuscode: '+datas1.statuscode+"</br>RRR: "+datas1.RRR+"</br>Status: "+datas1.status);
            console.log(data);
            
          //  window.location.replace("http://www.w3schools.com");

          },
          error: function(xhr, status, err) {
          alert('error// '+err);//test for unsuccessful ajax request
          console.log(err);
          }
       });
	   
  }
</script>