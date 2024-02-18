<!doctype html>
<html lang="en">
<head>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin input[type="email"],
    .form-signin input[type="password"] {
      direction: ltr;
      margin-bottom: 10px;
    }

    .form-signin input[type="email"]:focus,
    .form-signin input[type="password"]:focus {
      z-index: 2;
    }

    .form-signin input[type="email"],
    .form-signin input[type="password"] {
      font-size: 16px;
      height: auto;
      padding: 10px;
    }

    .form-floating {
      margin-bottom: 10px;
    }

    .form-floating input {
      height: auto;
    }

    .form-floating label {
      padding: 10px;
    }

    .form-signin button {
      margin-top: 10px;
      font-size: 18px;
    }
  </style>
</head>
<body class="text-center">

<main class="form-signin">
  <form action="{{ route('auth.authenticate') }}" method="POST">
    @csrf
    <h5>Login</h5>
    <div class="form-floating">
      <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="name@example.com">
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
      @error('password')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    <a href="{{ route('auth.register') }}">Register</a>
  </form>
</main>

</body>
</html>
