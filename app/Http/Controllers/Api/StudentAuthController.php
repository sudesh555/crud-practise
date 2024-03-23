<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class StudentAuthController extends Controller
{

    // Login
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the student
        $credentials = $request->only('email', 'password');
        $student = Student::where('email', $credentials['email'])->first();

        // if (!$student || !Hash::check($credentials['password'], $student->password)) {
        //     throw ValidationException::withMessages([
        //         'email' => ['The provided credentials are incorrect.'],
        //         'password' => ['The provided credentials are incorrect.']
        //     ]);
        // }

        if(!Hash::check($credentials['password'], $student->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Incorrect password!'
            ], 401);
        }

        if (!$student || $credentials['email'] !== $student->email) {
            return response()->json([
                'status' => 401,
                'message' => 'Incorrect Email!'
            ], 401);
        }

        // if(!$student) {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'No such student found!'
        //     ], 404);
        // }

        // Authentication successful
        Auth::login($student);
        return response()->json(['message' => 'Login successful', 'user' => $student], 200);
    }

    // Create new Student
    public function register(Request $request)
    {
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
