<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index () {
        $staff = Staff::all();
        if($staff->count() > 0) {
            return response()->json([
                'status' => 200,
                'staffs' => $staff
            ], 200);
        } 
        else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found!'
            ], 404);
        }
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'phone' => 'required|digits:10',
            'email' => 'required|email|max:191',
            'job_type' => 'required|string|max:191',
        ]);

        if($validator -> fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator -> messages()
            ], 422);
        }

        else {
            $staff = Staff::create([
                'name' => $request ->name,
                'address' => $request ->address,
                'phone' => $request ->phone,
                'email' => $request ->email,
                'job_type' => $request ->job_type
            ]);
        }

        if($staff) {
            return response()->json([
                'status' => 200,
                'message' => 'Staff Created Succesfully!'
            ], 200);
        }

         else {
            return response()-> json([
                'status' => 500,
                'message' => 'Something went wrong!'
            ], 500);
         }
    }

    public function show($id) {
        $staff = Staff::find($id);
        if($staff) {
            return response()->json([
                'status' => 200,
                'staff' => $staff
            ], 200);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'No such staff found!'
            ], 404);
        }
    }

    public function edit($id) {
        $staff = Staff::find($id);
        if($staff) {
            return response()->json([
                'status' => 200,
                'staff' => $staff
            ], 200);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'No such staff found!'
            ], 404);
        }
    }

    public function update (Request $request, int $id) {
        $staff = Staff::find($id);
        if($staff){
            $staff -> update([
                'name' => $request ->name,
                'address' => $request ->address,
                'phone' => $request ->phone,
                'email' => $request ->email,
                'job_type' => $request ->job_type
            ]);
            return response()-> json([
                'status' => 200,
                'message' => 'Staff Updated Successfully'
            ], 200);
        }
        else{
            return response()-> json([
                'status' => 404,
                'message' => 'No such staff found!'
            ], 404);
        }
    }

    public function delete($id) {
        $staff = Staff::find($id);
        if($staff) {
            $staff->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student Deleted Successfully'
            ], 200);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'No such staff found!'
            ], 404);
        }
    }
}
