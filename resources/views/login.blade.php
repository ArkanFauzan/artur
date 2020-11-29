@extends('layout.master')

@section('content')
    <main class="main">
        <div class="login">
            <div class="mockup">
                <img src="img/mockup.png" alt="Artur">
            </div>
            <div class="login-form">
                <h1>Join and Get <br/> our Feature</h1>
                <form class="form" action="#">
                    <h2>Login to your account</h2>
                    <p>New user? <a href="/register">Create an account</a></p>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"/>
                    </div>
                    
                    <button class="button" type="submit">Sign Up</button>

                    <div class="backgroud clear"></div>
                </form>
            </div>
        </div>
    </main>
@endsection