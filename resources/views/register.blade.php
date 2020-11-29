@extends('layout.master')

@section('content')
    <main class="main">
        <div class="register">
            <div class="mockup">
                <img src="img/mockup.png" alt="Artur">
            </div>
            <div class="register-form">
                <h1>Join and Get <br/> our Feature</h1>
                <form class="form" action="#">
                    <h2>Create an account</h2>
                    <p>Already have an account? <a href="/login">Sign in</a></p>

                    <div class="form-group">
                        <label for="name">UMKM's Name</label>
                        <input type="text" name="name" id="name"/>
                    </div>
                    <div class="section">
                        <div class="form-group">
                            <label for="place">Place</label>
                            <input type="text" name="place" id="place"/>
                        </div>
                        <div class="space"></div>
                        <div class="form-group">
                            <label for="phone">Phone Number (WhatsApp)</label>
                            <input type="text" name="phone" id="phone"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"/>
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" id="instagram"/>
                    </div>
                    
                    <button class="button" type="submit">Sign Up</button>

                    <div class="backgroud clear"></div>
                </form>
            </div>
        </div>
    </main>
@endsection