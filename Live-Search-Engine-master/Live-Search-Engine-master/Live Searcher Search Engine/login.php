<html>
    <head>
        <title>Login Page - SS</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <style>
            .divider:after,
            .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
            }
        </style>
    </head>

    <body>
    <h2>Login</h2>
    
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://cdn.dribbble.com/users/2782877/screenshots/5662221/ezgif.com-video-to-gif.gif" class="img-fluid" alt="Sample image" style="border-radius: 500px">
                </div>
      
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form autocomplete="off" action="" method="post">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="hidden" id="action" value="login">
                            <input type="text" name="demail" id="email" value="" class="form-control form-control-lg" placeholder="abc@mail.com">
                            <!-- <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" /> -->
                            <label class="form-label" for="form3Example3">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" name="password" id="password" value="" class="form-control form-control-lg" placeholder="Enter password">
                            <label class="form-label" for="form3Example3">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                                Remember me
                            </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="button" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;" onclick="submitForm();">Login</button>
                                                       
                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? 
                            <a href="Register_index.html" class="link-danger">Register</a></p>
                            <a href="#!" class="small text-muted">Terms of use.</a>
                            <a href="#!" class="small text-muted">Privacy policy</a>
                        </div>

                </form>
            </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
                <i class="fab fa-linkedin-in"></i>
            </a>
            </div>
            <!-- Right -->
        </div>
        </section>

    </body>

    <script type="text/javascript">
    function submitForm()
    {
       
        var email=$('input[name=demail]').val();
        var password=$('input[name=password]').val();
        
        if ( email == '' || password == '' ) {
            alert("Please fill all fields...!!!!!!");
    } 
    else {
        
        var formData={email:email, password:password};
        $.ajax({url:"http://localhost/Awt-project-cat-1/submit1.php",type:'POST',data:formData,success: function(response)
    {
        
        // alert(response)

        var res = JSON.parse(response);

        // alert(res);
 
		// console.log(res);
                    
        if(res.success == true)
        {
            alert("Login successful!");
            window.location.href = "main_home.php";	
        }
        else{
            alert("invalid creditionals")
        }
    }
    });
    }};
  
</script>

</html>
