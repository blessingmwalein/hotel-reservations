<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomTypeController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $roomType = RoomType::create($data);
        return redirect()->back()->with('success', 'Room Type Created Successfully');
    }

    public function update(Request $request, RoomType $roomType)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $roomType->update($data);
        return redirect()->back()->with('success', 'Room Type Updated Successfully');
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return redirect()->back()->with('success', 'Room Type Deleted Successfully');
    }

    public function index()
    {
        $roomTypes = RoomType::all();

        return  Inertia::render('Admin/RoomTypes', [
            'roomTypes' => $roomTypes
        ]);
        // return view('room-types.index', compact('roomTypes'));
    }
}
