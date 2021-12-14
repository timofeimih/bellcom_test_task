<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Get metting information from id</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<style>
		BODY{padding-top: 50px}
		#results{padding-top: 30px; display: none}

	</style>
	
</head>
<body>
	<div class="container">
		<form id="getMeeting" action="./get_meeting_data.php">
			<div id="alert" class="alert alert-danger" role="alert" style='display:none'></div>
			<div class="mb-3">
				<label for="meetingId" class="form-label">Number of an meeting agenda:</label>
				<input type="number" class="form-control" required name='meetingId' id="meetingId">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		<div id="results">
			<h1>Meeting information:</h1>
			Name: <span id='name'></span><br/>
			Sysid: <span id='sysid'></span><br/>
			Date: <span id='date'></span>
		</div>
	</div>

	<script>
		const contactForm = document.getElementById("getMeeting");
		const alert = document.getElementById("alert");
		const results = document.getElementById("results");

        contactForm.addEventListener("submit", function(event) {

          	event.preventDefault();

          	alert.style.display = 'none';
          	results.style.display = 'none';

          	var meetingId =  document.getElementById("meetingId").value;

            var request = new XMLHttpRequest();
            var url = contactForm.getAttribute("action") + "?meetingId=" + meetingId;
            request.open("GET", url, true);
            request.setRequestHeader("Content-Type", "application/json");
            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    var jsonData = JSON.parse(request.response);
                    if(jsonData.error){
                    	alert.innerHTML = jsonData.error;
                    	alert.style.display = 'block';
                    } else{
                    	document.getElementById("name").innerHTML = jsonData.name;
                    	document.getElementById("sysid").innerHTML = jsonData.sysid;
                    	document.getElementById("date").innerHTML = jsonData.date;

                    	results.style.display = 'block';
                    }
                }
            };
            
            request.send();

        });  
	</script>
	
	
</body>
</html>