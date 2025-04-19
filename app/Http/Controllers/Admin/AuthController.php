<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
//_________________________________________________________________________________________________________

public function loginAdmin(Request $request)
{
    return view('login'); 
}
//________________________________________________________________________________________________________

public function loginAdminDashboard(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $admin = Admin::where('email', $request->email)->first();

    if (!$admin || !Hash::check($request->password, $admin->password)) {
        return redirect()->back()->withErrors(['error' => 'بيانات تسجيل الدخول غير صحيحة'])->withInput();
    }

    return redirect()->route('images.index');
}
//___________________________________________________________________________________________________________
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['error' => 'بيانات تسجيل الدخول غير صحيحة'], 401);
        }

        $token = $admin->createToken('admin_token')->plainTextToken;

        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح',
            'token' => $token,
        ], 200);
    }

    // __________________________________________________________________________________________________
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6',
        ]);

            Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return response()->json([
            'message' => 'تم التسجيل بنجاح',
        ], 201);
    }

    //__________________________________________________________________________________________________________

    public function logout(Request $request)
    {
        $admin = auth()->user(); 
    
        if ($admin) {
            $admin->tokens()->delete(); 
            return response()->json(['message' => 'تم تسجيل الخروج بنجاح'], 200); 
        }
    
        return response()->json(['message' => 'لم يتم العثور على المستخدم'], 404); 
    }

//___________________________________________________________________________________________________________
public function logoutAdmin(Request $request)
{
    auth()->guard('web')->logout();

    return redirect()->route('login');
}
//___________________________________________________________________________________________________________
}
