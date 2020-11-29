@extends('layout.master')

@section('content')
    <main class="main">
        <div class="welcome">
            <div class="text">
                <h1>Welcome To Artur</h1>
                <p>Make your UMKM go digital now <br/>
                with our features.</p>
                <a class="button" href="/register">Get Started</a>
            </div>
            <div class="video-wrapper" onclick="playVideo()">
                <img src="https://1.bp.blogspot.com/-w6Y9tzLYfv8/W-j4rX5o9kI/AAAAAAAAAC4/OdkGD4JkL1AkP6ySJDNqP5pOSBjubjLGQCPcBGAYYCw/s1600/T1.jpg" alt="About Artur">
                <img src="img/play.png" class="play-btn">
            </div>           
        </div>
        <div id="videoPlayer">
            <img src="img/close.png" class="close-btn" onclick="closeVideo()">
            <video controls autoplay muted>
                <source src="video/Rec 0001.mp4" type="video/mp4">
            </video>
        </div> 

        <div class="features">
            <div class="mockup">
                <img src="img/mockup.png" alt="Mockup Artur">
            </div>
            <div class="features-description">
                <div class="goals" id="about">
                    <h1>Our Goals</h1>
                    <p>We want furniture UMKM in Indonesia to go <br/>
                    digital and take advantage of technology for <br/>
                    marketing their products
                    </p>
                </div>
                <div class="features-list">
                    <h1>Features</h1>
                    <div class="features1">
                        <img src="{{asset('/img/Features1.png')}}" alt="Interior design with AR">
                        <p>
                            Interior design with<br/>
                            Augmented Reality technology
                        </p>
                        <div></div>
                    </div>
                    <div class="features2">
                        <img src="{{asset('/img/Features2.png')}}" alt="Interior design with AR">
                        <p>
                            Simulate your furniture choice<br/>
                            with instagram filter
                        </p>
                        <div></div>
                    </div>
                    <div class="features3">
                        <img src="{{asset('/img/Features3.png')}}" alt="Interior design with AR">
                        <p>
                            Get your furniture in<br/>
                            your favorite E-Commerce
                        </p>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="quotes">
            <img class="ceo-image" src="{{asset('/img/poto.png')}}" alt="CEO Artur">
            <div class="quotes-group">
                <p class="text">
                    "Dari data yang kami dapat, hanya 8-13% dari 64 juta UMKM di Indonesia
                    yang sudah Go Digital, maka dari itu kami hadir untuk membantu UMKM bidang furniture
                    dalam meninkatkan penjualan mereka secara digital dengan teknologi terbaru"
                </p>
                <p class="by">Alexandro Alvin Valentino</p>
                <p class="position">CEO Artur</p>
            </div>
            <div class="clear"></div>
        </div>

        <div class="mitra">
            <p class="text">More than 50+ <br/> UMKM Furnture <br/> has joined</p>
            <div class="list-mitra">
                <img src="{{asset('/img/toko.png')}}" alt="Sinar Jaya" class="logo">
                <p class="name">Sinar Jaya</p>
                <p class="ig">IG : Sinar Jaya</p>
            </div>
            <div class="list-mitra">
                <img src="{{asset('/img/toko.png')}}" alt="Yanto Mebel" class="logo">
                <p class="name">Yanto Mebel</p>
                <p class="ig">IG : Yanto Mebel</p>
            </div>
            <div class="list-mitra">
                <img src="{{asset('/img/toko.png')}}" alt="Pari Turu" class="logo">
                <p class="name">Pari Turu</p>
                <p class="ig">IG : Pari Turu</p>
            </div>
            <div class="list-mitra">
                <img src="{{asset('/img/toko.png')}}" alt="Toko Baru" class="logo">
                <p class="name">Toko Baru</p>
                <p class="ig">IG : Toko Baru</p>
            </div>
            <div class="background"></div>
        </div>

        <div class="pricing" id="pricing">
            <img src="{{asset('/img/pricing.png')}}" alt="Pricing">
            <div class="text">
                <h1>Pricing</h1>
                <p>
                    You don't need to pay us a monthly fee, but <br/>
                    just pay a commission fee for each product <br/>
                    at a very cheap price.
                </p>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        let videoPlayer = document.getElementById("videoPlayer");
        videoPlayer.classList.add("hideVideo");

        function playVideo(){
            videoPlayer.classList.add("showVideo");
            videoPlayer.classList.remove("hideVideo");
        }

        function closeVideo(){
            videoPlayer.classList.add("hideVideo");
            videoPlayer.classList.remove("showVideo");
        }
    </script>
@endpush