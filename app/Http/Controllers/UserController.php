<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{

    public function index(Request $request){
        $name = $request->query("username","");
        $sortBy = $request->query("sort_by", "id");
        $sortDirection = $request->query("sort_dir","asc");
        $perPage = $request->query("per_page",10);

        $query = User::query();

        if(!empty($name)){
            $query->where("name", "like", "%{$name}%");
        }

        $query->orderBy($sortBy, $sortDirection);

        $data = $query->paginate($perPage);
        
        return response()->json([
            "message"       => "Data successfully showed",
            "data"          => $data
        ],200);
    }

    public function create(){
        return view('cms.users.add-user');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'username' => "required",
            'role_user' => "required",
            "password"  => "required"
        ]);

        $user = new User();
        $user->id = Str::uuid()->toString();
        $user->username = $validatedData['username'];
        $user->role_user = $validatedData['role_user'];
        $user->password = Hash::make($validatedData['password']);

        $user->save();

        return redirect()->back()->with('success', 'Sukses daftar akun baru');
    }
    public function edit()
    {
        $profile = Auth::user();
        return view('cms.profile.index', [
            'profile' => $profile
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $messages = [
            'oldpassword.required' => 'Old password is required.',
            'newpassword.required' => 'New password is required.',
            'newpassword.confirmed' => 'Password tidak sama.',
        ];

        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed', // Ensure new password and confirmation match
        ], $messages);
        $oldPassword = $request->oldpassword;
        $newPassword = $request->newpassword;

        if (!Hash::check($oldPassword, $user->password)) {
            return redirect()->back()->with('error', 'Old password is incorrect.')->withInput();
        }

        $user->password = Hash::make($newPassword);
        $user->save();


        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function delete(Request $request)
    {
        $id = $request->id; // Get the ID from the request
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }
    
        $user->delete();
        return response()->json(['success' => 'User berhasil dihapus'], 200);
    }
    
}
