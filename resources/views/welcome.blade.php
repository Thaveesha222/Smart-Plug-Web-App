<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart Plug User Interface</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Karla', sans-serif;
        }
        body{
            color: #fff;
        }
        .container{
            width: 100%;
            height: 100vh;
            background-image: url({{asset("back4.jpg")}});
            background-position: center;
            background-size: cover;
            padding-top: 35px;
            padding-left: 8%;
            padding-right: 8%;
        }
        nav{

            padding: 10px 0;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .logo a{
            font-size: 40px;
            text-decoration: none;
        }
        span{
            color: #f9004d;
        }
        .buttons{

            display: flex;
            align-items: center;
            margin-top: 10px;
            justify-content: space-between;
        }

        .login{
            text-decoration: none;
            margin-right: 15px;
            font-size: 18px;
        }
        .btn{
            background: #000;
            border-radius: 6px;
            padding: 9px 25px;
            text-decoration: none;
            transition: 0.5s;
            font-size: 18px;
        }

        .content{
            margin-top: 10%;
            max-width: 600px;
        }
        .content h2{
            font-size: 60px
        }
        .content p{
            margin-top: 10px;
            line-height: 25px;
        }
        a{
            color: #fff;
        }
        .link {
            margin-top: 30px;
        }
        .hire{
            color: #000;
            text-decoration: none;
            background: #fff;
            padding: 9px 25px;
            font-weight: bold;
            border-radius: 6px;
            transition: 0.5s;
        }
        .link .hire:hover{
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <nav>
        <div class="logo">
            <a href="/">Smart<span>Plug.</span></a>
        </div>

        <div class="buttons">
            @auth
                <a href="{{ url('/dashboard/any') }}" class="btn">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="login">Log in</a>
                <a href="{{ route('register') }}" class="btn">Register</a>
            @endauth
        </div>
    </nav>
    <div class="content">
        <h2>Welcome,<br>It's On Your Fingertip</h2>
        <p>Effortlessly control your devices from anywhere with our Smart Plugs<br>Simplify your life with a smarter home</p>
    </div>

</div>
</body>
</html>
