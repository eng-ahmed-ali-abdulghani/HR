<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    @if (App::getLocale() == 'en')
        <link rel="stylesheet" href={{ asset('front/css/styles.css') }}>
    @else
        <link rel="stylesheet" href={{ asset('front/css/rtlstyles.css') }}>
    @endif
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    @yield('style')
</head>

<body>
    <div class="container" style="margin-top: 150px">
        <form class="login-form" method="POST" action="{{ route('supmitlogin') }}">
            @csrf
            <div class="mb-3 d-flex flex-column">
                <label for="exampleInputphone" class="form-label">phone</label>
                <input type="phone" class="form-control" id="exampleInputphone" name="phone">
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </div>
        </form>
    </div>

    <style>
        .login-form {
            max-width: 500px;
            height: 250px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
    </style>
</body>
