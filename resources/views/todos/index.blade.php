<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Todo List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f0f4f8; font-family: 'Segoe UI', sans-serif; }
.container { max-width: 600px; }
.card-todo { border-radius:12px; padding:15px 20px; background:white; box-shadow:0 6px 15px rgba(0,0,0,0.1); margin-bottom:12px; }
.btn-primary { background:#667eea; border:none; }
.btn-primary:hover { background:#5a67d8; }
.btn-success { background:#38b000; border:none; }
.btn-success:hover { background:#2f8c00; }
.btn-outline-danger { border-color:#e63946; color:#e63946; }
.btn-outline-danger:hover { background:#e63946; color:white; }
.text-done { text-decoration:line-through; color:#6c757d; }
</style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Halo, {{ $user->username }}!</h3>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('todos.store') }}" method="POST" class="mb-4 d-flex gap-2">
        @csrf
        <input type="text" name="title" class="form-control form-control-lg" placeholder="Tambah todo baru..." required>
        <button class="btn btn-primary btn-lg">Tambah</button>
    </form>

    @forelse($todos as $todo)
    <div class="card-todo d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm {{ $todo->is_done ? 'btn-success' : 'btn-outline-secondary' }}">
                    {{ $todo->is_done ? '✔' : '✗' }}
                </button>
            </form>
            <span class="{{ $todo->is_done ? 'text-done' : '' }}">{{ $todo->title }}</span>
        </div>
        <div class="d-flex gap-2">
            
            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center text-muted mt-4">Belum ada todo</div>
    @endforelse
</div>

</body>
</html>
