<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('auth/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>
<body>

    <div class="main">
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <!-- Sing in  Form -->
            <section class="sign-in">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure><img src="{{ asset('auth/images/signin-image.png') }}" alt="sing up image"></figure>
                        </div>
                        
                        <div class="signin-form">
                            <h2 class="form-title">Sistem Informasi Monitoring dan Evaluasi Penyaluran Kredit Produktif</h2>
                            <form method="POST" class="register-form" id="login-form">
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="email" id="email" placeholder="E-mail"/>
                                </div>
                                <div class="form-group" style="margin-top: -15px;">
                                    @if ($errors->has('email'))
                                        <span style="color:#dc3545;">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="password" placeholder="Password"/>
                                </div>
                                <div class="form-group" style="margin-top: -15px;">
                                    @if ($errors->has('password'))
                                    <span style="color:#dc3545;">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="remembere" id="remember" class="agree-term" />
                                    <label for="remember" class="label-agree-term"><span><span></span></span>Remember me</label>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" name="signin" class="form-submit" value="Log in"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>