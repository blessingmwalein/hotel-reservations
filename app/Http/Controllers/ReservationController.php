<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use Inertia\Inertia;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'room_id' => 'required',
            'number_of_guests' => 'required | numeric',
            'status' => 'required'
        ]);
        $room = Room::find($request->room_id);
        //create date object from the check_in_date
        $check_in_date = \Carbon\Carbon::parse($request->check_in_date);
        //create date object from the check_out_date
        $check_out_date = \Carbon\Carbon::parse($request->check_out_date);
        $data['total_price'] = $room->unit_price * $request->number_of_guests * $check_in_date->diffInDays($check_out_date);
        $reservation = Reservation::create($data);


        return redirect()->back()->with('success', 'Reservation Created Successfully');
    }
    public function storeClient(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'room_id' => 'required',
            'number_of_guests' => 'required | numeric',
        ]);
        $room = Room::find($request->room_id);
        //create date object from the check_in_date
        $check_in_date = \Carbon\Carbon::parse($request->check_in_date);
        //create date object from the check_out_date
        $check_out_date = \Carbon\Carbon::parse($request->check_out_date);
        $data['total_price'] = $room->unit_price * $request->number_of_guests * $check_in_date->diffInDays($check_out_date);
        $reservation = Reservation::create($data);

        $nonceFromTheClient = $request->input('nonce');



        try {
            $response = $this->gateway()->transaction()->sale([
                'amount' => $reservation->total_price,
                'paymentMethodNonce' => $nonceFromTheClient
            ]);

            if ($response->success) {
                $transaction = Transaction::create([
                    'total_amount' => $reservation->total_price,
                    'status' => $response->transaction->status,
                    'payment_method' => $response->transaction->paymentInstrumentType,
                    'poll_url' => $response->transaction->type,
                    'reference_number' => $response->transaction->id,
                ]);


                $reservation->transaction_id = $transaction->id;
                $reservation->save();

                return redirect('/user/reservations')->with('success', 'Payment successful');
            }
        } catch (\Throwable $th) {
            $th->getMessage();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'room_id' => 'required',
            'number_of_guests' => 'required | numeric',
            'status' => 'required'
        ]);
        $room = Room::find($request->room_id);

        //create date object from the check_in_date
        $check_in_date = \Carbon\Carbon::parse($request->check_in_date);
        //create date object from the check_out_date
        $check_out_date = \Carbon\Carbon::parse($request->check_out_date);
        $data['total_price'] = $room->unit_price * $request->number_of_guests * $check_in_date->diffInDays($check_out_date);
        $reservation = Reservation::create($data);

        $reservation->update($data);


        return redirect()->back()->with('success', 'Reservation Updated Successfully');
    }

    public function destroy(Reservation $reservation)
    {

        $reservation->delete();
        return redirect()->back()->with('success', 'Reservation Deleted Successfully');
    }

    public function createTransaction(Request $request, Reservation $reservation)
    {

        $data['total_amount'] = $reservation->total_price;
        $data['payment_method'] = $request->payment_method;
        $data['status'] = 'pending';
        $data['poll_url'] = 'test';
        $data['reference_number'] = 'REF' . rand(100000, 999999);

        $transaction = Transaction::create($data);

        return redirect()->back()->with('success', 'Transaction Created Successfully');
    }

    public function index()
    {
        $reservations = Reservation::all();

        return Inertia::render('Admin/Reservations', [
            'reservations' => $reservations,
            'rooms' => Room::all(),
            'users' => User::all()
        ]);
        // return view('reservation-types.index', compact('amenitys'));
    }
    public function userReservations()
    {
        $pendingReservations = Reservation::where('user_id', auth()->user()->id)->where('status', 'pending')->get();
        $cancelledReservations = Reservation::where('user_id', auth()->user()->id)->where('status', 'cancelled')->get();
        $approvedReservations = Reservation::where('user_id', auth()->user()->id)->where('status', 'approved')->get();

        return Inertia::render('User/Reservations', [
            'pendingReservations' => $pendingReservations,
            'cancelledReservations' => $cancelledReservations,
        'approvedReservations' => $approvedReservations,
            'rooms' => Room::all(),
            'users' => User::all()
        ]);
        // return view('reservation-types.index', compact('amenitys'));
    }
    public function show(Reservation $reservation)
    {
    }
}
