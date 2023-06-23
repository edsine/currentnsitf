
<div id="data">Results:</div>
<script src="jquery.min.js"></script>
<script>
const newValues = {
			amount:"2000",
			payerName:"james atiluku",
			payerEmail:"prince1@gmail.com",
			payerPhone:"08089999009",
			description:"payment for data center."
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
			  //alert(JSON.stringify(data));
            var datas1 = JSON.parse(JSON.stringify(data));
            $('#data').append('</br>statuscode: '+datas1.statuscode+"</br>RRR: "+datas1.RRR+"</br>Status: "+datas1.status);
            console.log(data);
            
            window.location.replace("http://www.w3schools.com");

          },
          error: function(xhr, status, err) {
          alert('error// '+err);//test for unsuccessful ajax request
          console.log(err);
          }
       });
	   
</script>