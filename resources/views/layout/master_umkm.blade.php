<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta name="csrf-token" content="{{csrf_token()}}"> --}}
        
        <title>Artur</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{asset('/css/app.css')}}"> --}}
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    </head>
    <div id="wrapper">
        <header class="header">
            <div class="logo">
                <img src="img/logo.png" alt="Artur" width="100px">
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="/home">Home</a></li>
                    <li><a href="/home#about">About</a></li>
                    <li><a href="/umkm">UMKM</a></li>
                    <li><a href="/home#pricing">Pricing</a></li>
                    <li><a href="#contact-us">Contact Us</a></li>
                </ul>
            </nav>
            <div class="join">
                <a class="button" href="/register">Join Us</a>
            </div>
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>