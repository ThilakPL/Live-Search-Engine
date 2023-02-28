<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <style>
            .form-group{
                width: 60%;
                text-align: center;
            }
            .container {
                border-radius: 5px;
                padding: 20px;
            }
            /*Notification div message*/
            .notification {
                background-color: #555;
                color: white;
                text-decoration: none;
                padding: 15px 26px;
                position: relative;
                display: inline-block;
                border-radius: 2px;
            }

            .notification:hover {
                background: red;
                border: 1px solid;
                padding: 15px 26px;
                box-shadow: 3px 10px black;
            }

            .notification .badge {
                position: absolute;
                top: -10px;
                right: -10px;
                padding: 5px 10px;
                border-radius: 50%;
                background: red;
                color: white;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <center><h2>FeedBack Form - Searcher Search</h2></center>

            <div id="message">
                <!-- <span>Notify Message</span> -->
                <span></span>
            </div> <br>
            <div id ="city" class="city"></div>
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="abc@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">FeedBack</label>
                    <textarea class="form-control" id="feedback" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Place / City</label>
                    <input type="text" class="form-control" id="cityname" placeholder="City Name" value="Coimbatore">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <label for="checkbox">Fill as Anonymous Form: </label> &nbsp;&nbsp;&nbsp; <input type="checkbox" class="form-check-input" type="checkbox" id="checkbox" required><br>
                <label for="checkbox">Rules and Regulation: </label> &nbsp;&nbsp;&nbsp; <input type="checkbox" class="form-check-input" type="checkbox" id="checkbox" required> <br><p> I agree to the terms and conditions.</p>
                
                <input type="button" class="btn btn-primary btn-block mb-4" onclick="submitForm();" name="save_contact" value="Submit" />
            </form>
        </div>
    </body>
    <script>
        document.getElementById("cityname").disabled = true;
        document.getElementById("checkbox").addEventListener("click", function() {
            if (this.checked) {
                document.getElementById("name").value = "Anonymous";
                document.getElementById("email").value = "anon@mail.com";
            } else {
                document.getElementById("name").value = "";
                document.getElementById("emailid").value = "";
            }
        });

        // Step 1: Get user coordinates
        function getCoordintes() {
            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            function success(pos) {
                var crd = pos.coords;
                var lat = crd.latitude.toString();
                var lng = crd.longitude.toString();
                var coordinates = [lat, lng];
                console.log(`Latitude: ${lat}, Longitude: ${lng}`);
                getCity(coordinates);
                return;

            }

            function error(err) {
                console.warn(`ERROR(${err.code}): ${err.message}`);
            }

            navigator.geolocation.getCurrentPosition(success, error, options);
        }

        // Step 2: Get city name
        function getCity(coordinates) {
            var xhr = new XMLHttpRequest();
            var lat = coordinates[0];
            var lng = coordinates[1];

            // Paste your LocationIQ token below.
            xhr.open('GET', "https://us1.locationiq.com/v1/reverse.php?key=pk.0883639afb44652f78d6e376cb8469ea&lat=" +
            lat + "&lon=" + lng + "&format=json", true);
            xhr.send();
            xhr.onreadystatechange = processRequest;
            xhr.addEventListener("readystatechange", processRequest, false);

            function processRequest(e) {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    var city = response.address.city;
                    // console.log(city);
                    document.getElementById("cityname").textContent = city;
                    var input = document.getElementById("cityname");
                    input.value = city;
                }
            }
        }
        // getCoordintes();

        //Form DB Connection
        function submitForm(){
            var name = $('#name').val();
            var email = $('#email').val();
            var feedback = $('#feedback').val();
            var loc = $('#cityname').val();

            console.log(name);
            console.log(email);
            console.log(feedback);
            console.log(loc);

        if(name != '' && email != '' && feedback != '' && loc != '' ){
            var formData = {name: name, email:email, feedback:feedback, loc:loc};

            $.ajax({
                url: "http://localhost/Awt-Project-cat-1/api/feedbackform.php", 
                type: 'POST', 
                data: formData, 
                success: function(response){
                    alert(response);
                var res = JSON.parse(response);
                console.log(res)
                
                if(res.success == true)
                    $('#message').html('<span style="color: green">Form Submitted Successfully Thank You</span>')
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
            

            });
    }else{
        // $('#message').html('<span style="color: red" class="badge">Pleasé fill all the fields *</span>')
            $('#message').html('<a href="#" class="notification"><span>Pleasé fill all the fields *</span><span class="badge">1</span></a>');
            $('#alertres').html('<span style="color:red">*<span>');
        }
        }    

    </script>
</html>