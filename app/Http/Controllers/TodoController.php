<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;

class TodoController extends Controller
{
    // ================================
    // Tampilkan semua todo milik user login
    // ================================
    public function index(Request $request)
    {
        $user_id = $request->session()->get('user_id');

        if (!$user_id) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = User::find($user_id);
        $todos = Todo::where('user_id', $user_id)
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('todos.index', compact('todos', 'user'));
    }

    // ================================
    // Form tambah todo
    // ================================
    public function create(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        if (!$user_id) return redirect()->route('login');

        return view('todos.create');
    }

    // ================================
    // Simpan todo baru
    // ================================
    public function store(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        if (!$user_id) return redirect()->route('login');

        $request->validate([
            'title' => 'required|string|min:3'
        ]);

        Todo::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'is_done' => false
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo berhasil ditambahkan!');
    }

    // ================================
    // Toggle status selesai / belum
    // ================================
    public function toggleDone(Request $request, $id)
    {
        $user_id = $request->session()->get('user_id');
        if (!$user_id) return redirect()->route('login');

        $todo = Todo::where('id', $id)
                    ->where('user_id', $user_id)
                    ->firstOrFail();

        $todo->is_done = !$todo->is_done;
        $todo->save();

        return redirect()->route('todos.index')->with('success', 'Status todo diperbarui!');
    }

    // ================================
    // Hapus todo
    // ================================
    public function destroy(Request $request, $id)
    {
        $user_id = $request->session()->get('user_id');
        if (!$user_id) return redirect()->route('login');

        $todo = Todo::where('id', $id)
                    ->where('user_id', $user_id)
                    ->firstOrFail();

        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo berhasil dihapus!');
    }
}
