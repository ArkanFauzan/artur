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
        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('/css/app.css')}}"> --}}
        <style>
            h3{
                margin: 0;
            }
            .logout{
                margin-top: 4px;
            }
            .header .logo{
                position: relative;
                top: 7px;
            }
        </style>
    </head>
    <div id="app">
        <header class="header">
            <div class="logo">
                <img src="img/logo.png" alt="Artur" width="100px">
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="/admin"><h3>New UMKM (Need Verification)</h3></a></li>
                    <li><a href="/admin/umkm"><h3>Verified UMKM</h3></a></li>
                </ul>
            </nav>
            <div class="logout">
                <a class="button" href="/logout">Logout</a>
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
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
</body>
</html>