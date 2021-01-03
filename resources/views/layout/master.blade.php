<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta name="csrf-token" content="{{csrf_token()}}"> --}}
        
        <title>Artur</title>
        
        <!-- Fonts -->
        <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('/css/style-responsive.css')}}">
    </head>
    <div id="wrapper">
        <header class="header">
            <div class="logo">
                <img src="img/logo.png" alt="Artur">
            </div>
            <nav class="nav">
                <ul id="navbar" class="">
                    <?php $uri=$_SERVER['REQUEST_URI'];$route=ucwords(str_replace('/','',$uri));?>
                    
                    {{-- show current page nav on top --}}
                    <?php if($uri!='/register' && $uri!='/login'){?>
                        <li><a href="<?php echo $uri;?>"><?php echo $route;?></a></li>
                    <?php };?>

                    {{-- show other nav menu --}}
                    <?php if('/home'!=$uri){?>
                        <li><a href="/home">Home</a></li>
                    <?php };?>
                    <?php if('/product'!=$uri){?>
                        <li><a href="/product">Product</a></li>
                    <?php };?>
                    <?php if('/umkm'!=$uri){?>
                        <li><a href="/umkm">Umkm</a></li>
                    <?php };?>
                    <li><a class="button" href="/register">Join Us</a></li>
                </ul>
            </nav>
            <div class="join">
                <a class="button" href="/register">Join Us</a>
            </div>
            <i class="fas fa-bars" onclick="navbarToggle()"></i>
            <div class="clear"></div>
        </header>

        @yield('content')

        <footer class="footer">
            <div class="footer-group">
                <div class="contacts">
                    <h1 id="contact-us">Contact Us</h1>
                    <div class="contact">
                        <img src="img/wa.png" alt="WA Artur">
                        <p>097825681186</p>
                    </div>
                    <div class="contact">
                        <img src="img/ig.png" alt="IG Artur">
                        <p>arturmanagement.id</p>
                    </div>
                    <div class="contact">
                        <img src="img/email.png" alt="Email Artur">
                        <p>arturmanagement.id@gmail.com</p>
                    </div>
                </div>
                <img src="img/logo-white.png" alt="Logo Artur" class="logo">
                <div class="clear copyright">CopyRight 2020 by Artur. All Rights Reserved</div>
            </div>
        </footer>
    </div>

    <script src="{{asset('/js/app.js')}}"></script>
    @stack('script')
</body>
    <script>
        function navbarToggle(){
            document.getElementById('navbar').classList.toggle('responsive');
        }
    </script>
</html>