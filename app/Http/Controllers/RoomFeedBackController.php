<?php

namespace App\Http\Controllers;

use App\Models\RoomFeedBack;
use Illuminate\Http\Request;

class RoomFeedBackController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required',
            'comment' => 'required',
            'rating' => 'required',
            'user_id' => 'required',
        ]);
        $feedback = RoomFeedBack::create($data);
        return redirect()->back()->with('success', 'Feedback Created Successfully');
    }


    public function destroy(RoomFeedBack $feedback)
    {
        $feedback->delete();
        return redirect()->back()->with('success', 'Feedback Deleted Successfully');
    }
}
