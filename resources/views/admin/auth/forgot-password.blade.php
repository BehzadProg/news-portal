<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('admin_localize.Admin Forgot Password')}}</title>
    <link rel="stylesheet" href="{{asset('backend/admin-login-page-asset/style.css')}}">
</head>
<body>
    <section>
        <div class="leaves">
            <div class="set">
                <div>
                    <img src="{{asset('backend/admin-login-page-asset/img/leaf_01.png')}}" alt="">
                </div>
                <div>
                    <img src="{{asset('backend/admin-login-page-asset/img/leaf_02.png')}}" alt="">
                </div>
                <div>
                    <img src="{{asset('backend/admin-login-page-asset/img/leaf_03.png')}}" alt="">
                </div>
                <div>
                    <img src="{{asset('backend/admin-login-page-asset/img/leaf_04.png')}}" alt="">
                </div>
                <div>
                    <img src="{{asset('backend/admin-login-page-asset/img/leaf_01.png')}}" alt="">
                </div>
                <div>
                    <img src="{{asset('backend/admin-login-page-asset/img/leaf_02.png')}}" alt="">
                </div>
                <div>
                    <img src="{{asset('backend/admin-login-page-asset/img/leaf_03.png')}}" alt="">
                </div>
                <div>
                    <img src="{{asset('backend/admin-login-page-asset/img/leaf_04.png')}}" alt="">
                </div>
            </div>
        </div>
        <img src="{{asset('backend/admin-login-page-asset/img/bg.jpg')}}" class="bg">
        <img src="{{asset('backend/admin-login-page-asset/img/girl.png')}}" class="girl">
        <img src="{{asset('backend/admin-login-page-asset/img/trees.png')}}" class="trees">
        <div class="login">
            <h2>Forgot Password</h2>
            <form action="{{route('admin.password.email')}}" method="post">
                @csrf
                <div class="inputBox">
                    <p>{{__('admin_localize.Forgot your password? No problem. we will email you a password reset link that will allow you to choose a new one')}}.</p>
                    @if (session()->has('success'))
                    <i><b style="color: #8f2c24">{{session()->get('success')}}</b></i>
                    @endif
                    <input type="email" name="email" value="{{old('email')}}" placeholder="{{__('admin_localize.Email')}}">
                    @error('email')
                    <code style="color: red">{{$message}}</code>
                   @enderror
                </div>
                <div class="inputBox">
                    <input type="submit" value="{{__('admin_localize.Send Reset Link')}}" id="btn">
                </div>
            </form>
        </div>
    </section>
</body>
</html>
