<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Todo App</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #667eea, #5a67d8);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    border-radius: 15px;
    padding: 30px;
    width: 380px;
    background: rgba(255,255,255,0.95);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.btn-success {
    background: #667eea;
    border: none;
}

.btn-success:hover {
    background: #5a67d8;
}
</style>
</head>
<body>

<div class="card">
    <h3 class="text-center mb-4">Register</h3>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" required class="form-control form-control-lg">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" required class="form-control form-control-lg">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required class="form-control form-control-lg">
        </div>

        <button class="btn btn-success w-100 btn-lg">Register</button>
    </form>

    <div class="text-center mt-3">
        <p>Sudah punya akun?</p>
        <a href="{{ route('login') }}" class="btn btn-outline-success w-100">Login Sekarang</a>
    </div>
</div>

</body>
</html>
