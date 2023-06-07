<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AmenityController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $amenity = Amenity::create($data);
        return redirect()->back()->with('success', 'Amenity Created Successfully');
    }

    public function update(Request $request, Amenity $amenity)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $amenity->update($data);
        return redirect()->back()->with('success', 'Amenity Updated Successfully');
    }

    public function destroy(Amenity $amenity)
    {
        $amenity->delete();
        return redirect()->back()->with('success', 'Amenity Deleted Successfully');
    }

    public function index()
    {
        $amenities = Amenity::all();

        return Inertia::render('Admin/Amenities', [
            'amenities' => $amenities
        ]);
        // return view('room-types.index', compact('amenitys'));
    }
}
