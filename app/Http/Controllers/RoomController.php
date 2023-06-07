<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomAmenity;
use App\Models\RoomType;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function welcome()
    {

        return Inertia::render('Welcome', [
            'rooms' => Room::where('status', 'available')->get(),
            'roomTypes' => RoomType::all(),
        ]);
    }
    public function show(Room $room)
    {

        return Inertia::render('RoomDetail', [
            'room' => $room,
        ]);
    }
    public function book(Room $room)
    {

        $clientToken = $this->gateway()->clientToken()->generate();


        return Inertia::render('BookRoom', [
            'room' => $room,
            'clientToken' => $clientToken,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
            'room_type_id' => 'required ',
            'status' => 'required',
            'location' => 'required',
        ]);
        $room = Room::create($data);
        //check if the request has an images
        if ($request->has('images')) {
            //loop through the images
            foreach ($request->images as $image) {
                //store the image in the images folder
                $image->store('images', 'public');
                //store the image in the database
                $room->images()->create([
                    'image_path' => $image->hashName(),
                ]);
            }
        }
        //check if request have amenities
        if ($request->has('amenities')) {
            //loop through the amenities
            foreach ($request->amenities as $amenity) {
                //store the amenity in the database
                RoomAmenity::create([
                    'room_id' => $room->id,
                    'amenity_id' => $amenity,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Room Created Successfully');
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
            'room_type_id' => 'required',
            'status' => 'required',
            'location' => 'required',
        ]);
        $room->update($data);

        //check if the request has an images
        if ($request->has('images')) {
            //loop through the images
            foreach ($request->images as $image) {
                //store the image in the images folder
                $image->store('images', 'public');
                //store the image in the database
                $room->images()->create([
                    'image_path' => $image->hashName(),
                ]);
            }
        }

        //check if request have amenities
        if ($request->has('amenities')) {
            //loop through the amenities
            foreach ($request->amenities as $amenity) {
                //store the amenity in the database
                RoomAmenity::create([
                    'room_id' => $room->id,
                    'amenity_id' => $amenity,
                ]);
            }
        }


        return redirect()->back()->with('success', 'Room Updated Successfully');
    }

    public function destroy(Room $room)
    {

        //delete the images
        foreach ($room->images as $image) {
            //delete the image from the images folder
            unlink(public_path('storage/images/' . $image->url));
            //delete the image from the database
            $image->delete();
        }

        //delete the amenities
        foreach ($room->amenities as $amenity) {
            //delete the amenity from the database
            $room->amenities()->detach($amenity);
        }
        $room->delete();
        return redirect()->back()->with('success', 'Room Deleted Successfully');
    }

    public function index()
    {
        $rooms = Room::all();

        $availableRooms = Room::where('status', 'Available')->get();
        $unAvailableRooms = Room::where('status', 'Unavailable')->get();
        return Inertia::render('Admin/Rooms', [
            'rooms' => $rooms,
            'amenities' => Amenity::all(),
            'roomTypes' => RoomType::all(),
            'availableRooms' => $availableRooms,
            'unAvailableRooms' => $unAvailableRooms,
        ]);
        // return view('room-types.index', compact('amenitys'));
    }
}
