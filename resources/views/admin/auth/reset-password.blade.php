<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reset Password</title>
    <link rel="stylesheet" href="{{ asset('backend/admin-login-page-asset/style.css') }}">
</head>

<body>
    <section>
        <div class="leaves">
            <div class="set">
                <div>
                    <img src="{{ asset('backend/admin-login-page-asset/img/leaf_01.png') }}" alt="">
                </div>
                <div>
                    <img src="{{ asset('backend/admin-login-page-asset/img/leaf_02.png') }}" alt="">
                </div>
                <div>
                    <img src="{{ asset('backend/admin-login-page-asset/img/leaf_03.png') }}" alt="">
                </div>
                <div>
                    <img src="{{ asset('backend/admin-login-page-asset/img/leaf_04.png') }}" alt="">
                </div>
                <div>
                    <img src="{{ asset('backend/admin-login-page-asset/img/leaf_01.png') }}" alt="">
                </div>
                <div>
                    <img src="{{ asset('backend/admin-login-page-asset/img/leaf_02.png') }}" alt="">
                </div>
                <div>
                    <img src="{{ asset('backend/admin-login-page-asset/img/leaf_03.png') }}" alt="">
                </div>
                <div>
                    <img src="{{ asset('backend/admin-login-page-asset/img/leaf_04.png') }}" alt="">
                </div>
            </div>
        </div>
        <img src="{{ asset('backend/admin-login-page-asset/img/bg.jpg') }}" class="bg">
        <img src="{{ asset('backend/admin-login-page-asset/img/girl.png') }}" class="girl">
        <img src="{{ asset('backend/admin-login-page-asset/img/trees.png') }}" class="trees">
        <div class="login">
            <h2>Reset Password</h2>
            <form action="{{ route('admin.password.store') }}" method="post">
                @csrf
                <div class="inputBox">
                    @error('email')
                        <code style="color: red">{{ $message }}</code>
                    @enderror
                    <input type="email" name="email" placeholder="Email" value="{{@request()->email}}">
                    <input type="hidden" name="token"  value="{{request()->token}}">
                </div>
                <div class="inputBox">
                    @error('password')
                    <code style="color: red">{{ $message }}</code>
                   @enderror
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="inputBox">
                    @error('password_confirmation')
                    <code style="color: red">{{ $message }}</code>
                    @enderror
                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <div class="inputBox">
                    <input type="submit" value="Save" id="btn">
                </div>
            </form>
        </div>
    </section>
</body>

</html>
