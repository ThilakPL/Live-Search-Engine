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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet"/>
    <script src="https://apis.google.com/js/platform.js"></script>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            position: relative;
            font-family: 'roboto', sans-serif;
        }

        .navbar{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background: #fff;
            display: flex;
            align-items: center;
            padding: 0 2.5vw;
            z-index: 1;
        }

        .search-box{
            width: 50%;
            height: 35px;
            float:right;
            z-index: 0;
        }

        /* side-bar */
        .side-bar{
            position: fixed;
            top: 60px;
            left: 0;
            min-width: 50px;
            width: 60px;
            height: calc(100vh - 60px);
            background: #fff;
            padding-right: px;
        }

        .links{
            display: block;
            width: 100%;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            text-transform: capitalize;
            color: #242424;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        .links img{
            height: 25px;
            margin-right: 20px;
        }

        .links:hover,
        .links.active{
            background: rgba(0, 0, 0, 0.1);
        }

        .form-group {
        display: flex;
        align-items: center;
        }

        .form-control {
        flex: 1;
        margin-right: 10px;
        }

        #videos {
            z-index: -1;
        }



    </style>
</head>
<body>
    <div class="container">
    <nav class="navbar">
        <img src="https://i.postimg.cc/tJPY17Jj/logo.png" class="logo" alt="" style="width: 8%;">
        <div class="search-box">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="search" required/><input type="submit" class="btn btn-danger" value="Search"> &nbsp;  <i class='fas fa-user-circle' style='font-size:26px;'></i><?php echo "<p style='color: red;'>" . $name . "</p>";?>
                </div>
            </form>
        </div>
    </nav>

    <!-- sidebar -->
    <div class="side-bar">
        <a href="#" class="links active"><img src="https://i.postimg.cc/m2Ls1tty/home.png" alt=""></a>
        <a href="#" class="links"><img src="https://i.postimg.cc/3wv5QGcY/explore.png" alt=""></a>
        <a href="#" class="links"><img src="https://i.postimg.cc/bNN7NWB6/subscription.png" alt=""></a>
        <hr class="seperator">
        <a href="#" class="links"><img src="https://i.postimg.cc/Qt3PLy7J/library.png" alt=""></a>
        <a href="#" class="links"><img src="https://i.postimg.cc/DzqjcPNJ/history.png" alt=""></a>
        <a href="#" class="links"><img src="https://i.postimg.cc/qqgxWs1G/your-video.png" alt=""></a>
        <a href="#" class="links"><img src="https://i.postimg.cc/Dy9PYbLq/watch-later.png" alt=""></a>
        <a href="#" class="links"><img src="https://i.postimg.cc/2Sdhc9zD/liked-video.png" alt=""></a>
        <a href="#" class="links"><img src="https://i.postimg.cc/85Y6Jqbh/show-more.png" alt=""></a>
    </div>

    <br><br>
        <div class="row">
            <div class="col-md-12">
                <div id="videos" class="d-flex flex-wrap justify-content-around">

                </div>
            </div>
        </div>

    </div>
    
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
   $(document).ready(function(){
    var API_KEY = "AIzaSyBXg-1L3bobylq0NpU1icvIdA0F4_mkETI"

    var video = ''

    $("form").submit(function(event){
        event.preventDefault()

        //Search by the user
        var search = $("#search").val()

        videoSearch(API_KEY, search, 20)
    })

    //Receive the details 
    function videoSearch(key, search, maxResults){
        $.get("https://www.googleapis.com/youtube/v3/search?key= " + key + "&type=video&part=snippet&maxResults=" + maxResults + "&q=" +search, function(data){
            console.log(data);
            data.items.forEach(item => {
                // Extract values from each item
                let vdname = item.snippet.title;
                let chname = item.snippet.channelTitle;
                let vddes = item.snippet.description;
                let updatetime = item.snippet.publishedAt;

                var date = new Date(updatetime);
                var formattedDate = (date.getDate()<10?'0':'') + date.getDate() + '/' + (date.getMonth()<10?'0':'') + (date.getMonth()+1) + '/' + date.getFullYear() + ' - ' + date.getHours() + ':' + date.getMinutes();
                // console.log(formattedDate);

                video = `
                <div class="card" style="width: 26.5rem;">
                    <iframe width="420" height="315" src="http://www.youtube.com/embed/${item.id.videoId}" frameborder="0" allowfullscreen></iframe>
                    <div class="card-body">
                        <h5 class="card-title">${vdname}</h5>
                        <h6 class="card-title">${chname}</h6>
                        <p class="card-text">${vddes}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Posted On: ${formattedDate}</small>
                    </div>
                </div>
                `
                // <iframe width="420" height="315" src="http://www.youtube.com/embed/${item.id.videoId}" frameborder="0" allowfullscreen></iframe>
 
                $("#videos").append(video)              
            });
        })
    }

})
</script>

</html>