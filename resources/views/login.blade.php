<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="d-flex min-vh-100 align-items-center justify-content-center bg-light">
    <div class="d-flex flex-column align-items-center">
        <!-- Login Card -->
        <div class="card p-4 shadow-lg mb-3" style="width: 24rem;">
            <h2 class="text-center mb-4">Login to Your Account</h2>
            <form action="/admin/login" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" id="mobile" name="mobile" hidden>
                    <label for="login" class="form-label">Email</label>
                    <input type="text" class="form-control @error('Email') is-invalid @enderror" 
                           id="login" name="Email" value="{{ old('Email') }}">
                    @error('Email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
        <a href="/" class="btn btn-outline-primary">Home</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
