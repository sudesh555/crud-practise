<?php

namespace App\Http\Controllers\api;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{

    // Login
    public function login(Request $request) {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();
            return response()->json(['message' => 'Login successful', 'user' => $user], 200);
        }

        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Create new Student
    public function register (Request $request) {
         // Validate the incoming request
         $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|unique:students,phone',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new student
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Return a response
        return response()->json(['message' => 'Student registered successfully', 'student' => $student], 201);
    }
}
