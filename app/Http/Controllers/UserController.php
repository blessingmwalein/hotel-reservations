<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Users', [
            'users' => User::all()
        ]);
    }
    public function adminDash()
    {

        //pending reservations
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $approvedReservations = Reservation::where('status', 'approved')->count();
        $cancelled = Reservation::where('status', 'cancelled')->count();

        //last 10 reservations
        $lastReservations = Reservation::latest()->take(10)->get();
        $rooms = Room::all()->count();
        return Inertia::render('Admin/Dashboard', [
            'pendingReservations' => $pendingReservations,
            'approvedReservations' => $approvedReservations,
            'cancelled' => $cancelled,
            'rooms' => $rooms,
            'reservations' => $lastReservations,
        ]);
    }
    public function profile()
    {
        return Inertia::render('User/Profile', [
            'user' => auth()->user()
        ]);
    }
    public function profileUpdate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
        ]);

        auth()->user()->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function passwordUpdate(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return  redirect()->back()->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'user_type' => 'required',
        ]);

        $user->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
