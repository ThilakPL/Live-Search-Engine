<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Github Profile Fetch Api</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }
        body{
            height: 100vh;
            width: 100%;
            display: grid;
            place-items: center;
            /* background: #140d35; */
        }

        .output-container{
            height: 300px;
            width: 750px;
            background: gray;
            margin: 15px 0 0 0;
            border-radius: 10px;
        }
        img{
            margin-left: 15px;
            position: absolute;
            margin-top: 15px;
            height: 200px;
            width: 200px;
            border-radius: 50%;
            border: 15px solid rgb(0, 140, 255);
        }

        .username h1{
            position: absolute;
            margin-top: 15px;
            margin-left: 245px;
            font-weight: 750;
            color: white;
        }
        .bio p{
            font-size: 20px;
            font-weight: 600;
            margin-left: 245px;
            width: 500px;
            color: white;
            margin-top: 75px;
            position: absolute;
        }
        .info ul{
            position: absolute;
            margin-top: 175px;
            margin-left: 245px;
            color: white;
            display: flex;
        }
        ul li{font-weight: 650;
            color: white;
            letter-spacing: 2px;
            margin: 15px;
            padding: 5px 15px;
            background: #687fbd;
            list-style: none;
        }
        #output{
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <center><h2>GITHUB PROFILE</h2></center>
        <div class="search-area">
            <input type="text" name="" id="username" placeholder="Enter Github Username" autocomplete="off" class="form-control"/>
            <button class="btn btn-primary" onclick="getDetails();">Get Details</button>
        </div>
        <div class="output-container" id="output">
            <div class="profile" id="profile"></div>
            <div class="username">
                <h1 id="name"></h1>
            </div>
            <div class="bio">
                <p id="bio"></p>
            </div>
            <div class="info">
                <ul>
                    <li id="followers"></li>
                    <li id="following"></li>
                </ul>
            </div>
        </div>
    </div>
</body>
<script>
    function getDetails(){
        document.getElementById('output').style.display="block";
        const name=document.getElementById('username').value;
        fetch(`https://api.github.com/users/${name}`)
        .then(response=>response.json().then(data=>{
            console.log(data)
            document.getElementById('name').innerHTML=data.name;
            document.getElementById('bio').innerHTML=data.bio;
            document.getElementById('followers').innerHTML=data.followers +" Followers";
            document.getElementById('following').innerHTML=data.following + " Following";
            document.getElementById('profile').innerHTML=`
            <img src="${data.avatar_url}" />
            `
        }))
    }
</script>
</html>