<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    // get all students
    public function index()
    {
        $students = Student::all();
        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found!'
            ], 404);
        }
    }

    // create new student
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:students,email',
            'password' => 'required|string|max:191',
            'phone' => 'required|digits:10|unique:students,phone',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } 
        
        else {
            if ($request->hasFile('image')) {
                $image = $request->image;
                $name = time().'.'.$image->getClientOriginalExtension();
                $path = public_path('upload');
                $image->move($path, $name);
            }

            $student = Student::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Student Created Succesfully!',
                'data' => $student
            ], 200);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Something went wrong!'
        ], 500);
    }

    // get single student
    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such student found!'
            ], 404);
        }
    }

    // edit student
    public function edit($id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such student found!'
            ], 404);
        }
    }

    // update student
    public function update(Request $request, int $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->update([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->email,
                'password' => $request->password,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Student Updated Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such student found!'
            ], 404);
        }
    }

    // delete student
    public function delete($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Something went wrong!'
            ], 404);
        }
    }
}
