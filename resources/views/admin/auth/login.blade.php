<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('admin_localize.Admin Login')}}</title>
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
            <h2>{{__('admin_localize.Sign In')}}</h2>
            <form action="{{route('admin.handle.login')}}" method="post">
                @csrf
                <div class="inputBox">
                    @if (session()->has('success'))
                    <i><b style="color: #8f2c24">{{session()->get('success')}}</b></i>
                    @endif
                    @error('email')
                    <code style="color: red">{{$message}}</code>
                   @enderror
                    <input type="email" name="email" placeholder="{{__('admin_localize.Email')}}">
                </div>
                <div class="inputBox">
                    @error('password')
                    <code style="color: red">{{$message}}</code>
                   @enderror
                    <input type="password" name="password" placeholder="{{__('admin_localize.Password')}}">
                </div>
                <div class="inputBox">
                    <input type="submit" value="Login" id="btn">
                </div>
                <div class="group">
                    <a href="{{route('admin.password.request')}}">{{__('admin_localize.Forget Password')}}</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
