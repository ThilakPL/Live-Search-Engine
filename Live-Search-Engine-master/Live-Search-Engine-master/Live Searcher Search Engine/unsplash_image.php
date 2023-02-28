<?php
   session_start();
   if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
      $name = $_SESSION["name"];
    //   echo "Hello, " . $name;
   } else {
      header("Location: login.php");
   }
?>
<html lang="en">
<head>
    <style>
        body{
            height: 100vh;
            width: 100vw;
            display: grid;
            justify-content: center;
            overflow-x: hidden;

        }
        img{
            height: 250px;
            width: 370px;
            margin: 10px;
            border-radius: 3px;
        }
        #result{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            position: absolute;
            margin-left: -155px;
            margin-top: 25px;
        }
        input{
            /* position: absolute; */
            /* margin-left: -355px; */
            width: 70vw !important;
        }

        .form-group {
        display: flex;
        align-items: center;
        }

    </style>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
        <br>
        <div class="form-group">
            <img src="https://cdn-icons-png.flaticon.com/512/5968/5968763.png" alt="Logo" style="width: 50px;height: 50px;"/><input type="text" name="" id="search" placeholder="Search Images" class="form-control" autocomplete="off"> &nbsp;&nbsp; <button class="btn btn-success" id="button">Search</button> &nbsp;&nbsp;  <i class='fas fa-user-circle' style='font-size:26px;'></i><?php echo "<p style='color: red;'>" . $name . "</p>";?>
        </div><br>
        <div id="result">
            
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <script>
        $("button").click(function(event){
            event.preventDefault()
            $("#result").empty()
            var search=$("#search").val()
            var url="https://api.unsplash.com/search/photos?query="+search+"&client_id=cbWdmzbLydBpalkCWVY1gYh-GsljrpD2wURsLP89ci4&per_page=60"

            $.ajax({
                method: 'GET',
                url: url,
                success:function(data){
                    console.log(data)
                    
                    data.results.forEach(photo => {
					$("#result").append(`
						<img src="${photo.urls.small}" />
					`)
				});
                }
            })
        })
    </script>
</body>
</html>
