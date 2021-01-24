<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta name="csrf-token" content="{{csrf_token()}}"> --}}
        
        <title>Artur</title>
        <!-- Created By Arkan | arkanfauzan93@gmail.com | github.com/ArkanFauzan -->
        
        <!-- Fonts -->
        <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{asset('/css/app.css')}}"> --}}
        
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('/css/style-responsive.css')}}">
    </head>
    <div id="wrapper">
        <header class="header">
            <!-- Created By Arkan | arkanfauzan93@gmail.com | github.com/ArkanFauzan-->
            <div class="logo">
                <img src="/img/logo.png" alt="Artur">
            </div>
            <nav class="nav responsive">
                <ul id="navbar" class="">
                    <?php $uri='/'.preg_replace('/[0-9\/]*/','',$_SERVER['REQUEST_URI']);$route=ucwords(preg_replace('/\//','',$uri));?>
                    
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
            <nav class="nav normal">
                <ul class="">
                    <li><a href="/home">Home</a></li>
                    <li><a href="/product">Product</a></li>
                    <li><a href="/umkm">Umkm</a></li>
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
                        <img src="/img/wa.png" alt="WA Artur">
                        <p>097825681186</p>
                    </div>
                    <div class="contact">
                        <img src="/img/ig.png" alt="IG Artur">
                        <p>arturmanagement.id</p>
                    </div>
                    <div class="contact">
                        <img src="/img/email.png" alt="Email Artur">
                        <p>arturmanagement.id@gmail.com</p>
                    </div>
                </div>
                <img src="/img/logo-white.png" alt="Logo Artur" class="logo">
                <div class="clear copyright">CopyRight <?php echo date('Y'); ?> by Artur. All Rights Reserved</div>
            </div>
            <!-- Created By Arkan | arkanfauzan93@gmail.com | github.com/ArkanFauzan -->
        </footer>
    </div>

    <script src="{{asset('/js/app.js')}}"></script>
    @stack('script')

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
    <script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
    <script>
        function navbarToggle(){
            document.getElementById('navbar').classList.toggle('responsive');
        }
    </script>
</html>