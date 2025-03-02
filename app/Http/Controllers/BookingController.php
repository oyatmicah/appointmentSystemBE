<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        return response()->json(Booking::all());
    }

    // Fetch bookings for a logged-in user
    public function userBookings()
    {
        return response()->json(Auth::user()->bookings);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        // To ensure valid time slot format
        $allowedSlots = [
            '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
            '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
            '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'
        ];

        if (!in_array($request->time, $allowedSlots)) {
            return response()->json(['message' => 'Invalid time slot'], 400);
        }

        // Ensure booking is within the current month
        $date = Carbon::parse($request->date);
        if ($date->month !== Carbon::now()->month) {
            return response()->json(['message' => 'Bookings are only allowed for the current month'], 400);
        }

        // Ensure booking is on a weekday (Monday-Friday)
        if ($date->isWeekend()) {
            return response()->json(['message' => 'Bookings are only allowed from Monday to Friday'], 400);
        }

        $existingBooking = Booking::where('date', $request->date)->where('time', $request->time)->first();
        if ($existingBooking) {
            return response()->json(['message' => 'This time slot is already booked'], 409);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return response()->json($booking, 201);
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(['message' => 'Booking cancelled successfully']);
    }
}

