<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentRoom;
use Illuminate\Http\Request;

class StudentRoomController extends Controller
{
    public function allocate(Request $request) {
        StudentRoom::firstOrCreate($request->only('student_id', 'room_id'));
    }
}
