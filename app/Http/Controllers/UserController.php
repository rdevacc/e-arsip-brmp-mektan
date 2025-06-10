<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(){
        $users = User::get(['id', 'role_id', 'name']);

        return view('apps.user.index', compact('users'));
    }

    public function create(){
        $roles = Role::get(['id', 'name']);

        return view('apps.user.create', compact('roles'));
    }

    public function store(Request $request){
         $validated = $request->validate([
            'name' => 'required',
            'role_id' =>  'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
         ],[
            'name.required' => 'Nama User field is required!',
            'role_id.required' =>  'Role field is required!',
            'email.required' => 'Email field is required!',
            'password.required' => 'Password field is required!',
            'password.min' => 'Password field is Min 8 Characters!',
            'password.confirmed' => 'Password field must be same!',
         ]
        );

        User::create($validated);

        return redirect()->route('user.index')->with('success', 'Data User Baru Berhasil Ditambahkan');

    }

    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::get(['id', 'name']);

        return view('apps.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Ambil user berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        try {
            // Update field umum
            $user->name = $validated['name'];
            $user->role_id = $validated['role_id'];
            $user->email = $validated['email'];

            // Hanya update password jika diisi
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
        } catch (\Throwable $e) {
            Log::error('Gagal update user: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withErrors(['update_error' => 'Gagal memperbarui data user.'])->withInput();
        }
    }

    public function destroy(User $user){
        // Destroy data by id
        User::destroy($user->id);

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Dihapus');
    }
}
