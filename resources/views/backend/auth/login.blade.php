<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background: #090a0c;
            background: linear-gradient(to right, #030c17, #ffffff);
            background-size: 400% 400%;
            /* animation: gradient 30s ease infinite; */
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-weight: 300;
        }

        .form-floating:focus-within {
            z-index: 2;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }

        .btn-google {
            color: white !important;
            background-color: #ea4335;
        }

        .btn-facebook {
            color: white !important;
            background-color: #3b5998;
        }

        .checkbox-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .checkbox-container>div {
            display: flex;
            align-items: center;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
            border-radius: 0.5rem;
            color: white;
            font-weight: bold;
        }

        .social-btn i {
            margin-right: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg my-5">
                    <div class="card-body p-5">
                        <h5 class="card-title text-center mb-4">Đăng nhập</h5>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="email" placeholder="name@example.com"
                                    value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <label for="floatingInput">Nhập Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword"
                                    placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                <label for="floatingPassword">Nhập mật khẩu</label>
                            </div>
                            <div class="form-check mb-3">
                                <div class="checkbox-container">
                                    <div>
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="rememberPasswordCheck">
                                        <label class="form-check-label" for="rememberPasswordCheck">
                                            Ghi nhớ mật khẩu
                                        </label>
                                    </div>
                                    <div>
                                        <label class="form-check-label" for="register">
                                            <a href="{{ route('register') }}" class="text-decoration-none">Đăng kí</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid mb-3">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Đăng
                                    nhập</button>
                            </div>
                            <hr class="my-4">
                            <div class="d-grid mb-2">
                                <a href="{{ route('auth.google') }}" class="social-btn btn-google text-decoration-none">
                                    <i class="fab fa-google"></i> Đăng nhập bằng Google
                                </a>
                            </div>
                            <div class="d-grid mb-2">
                                <a href="{{ route('auth.github') }}" class="social-btn btn-github btn btn-dark text-decoration-none">
                                    <i class="fab fa-github"></i> Đăng nhập bằng Github
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

</html>
