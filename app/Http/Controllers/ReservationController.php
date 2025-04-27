<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $tables = Table::with('reservations')->get();
        $reservations = Reservation::with('table')->orderBy('reservation_time')->get();
        return view('admin.reservations.index', compact('tables', 'reservations'));
    }
    public function createTable()
    {
        return view('admin.reservations.create_table');
    }

    public function storeTable(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ]);

        $table = new Table();
        $table->name = $validated['name'];
        $table->capacity = $validated['capacity'];
        $table->is_active = $request->has('is_active');
        $table->save();

        return redirect()->route('admin.reservations.index')->with('success', 'Table created successfully');
    }

    public function editTable($id)
    {
        $table = Table::findOrFail($id);
        return view('admin.reservations.edit_table', compact('table'));
    }

    public function updateTable(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ]);

        $table = Table::findOrFail($id);
        $table->name = $validated['name'];
        $table->capacity = $validated['capacity'];
        $table->is_active = $request->has('is_active');
        $table->save();

        return redirect()->route('admin.reservations.index')->with('success', 'Table updated successfully');
    }

    public function destroyTable($id)
    {
        $table = Table::findOrFail($id);
        
        if ($table->reservations()->count() > 0) {
            return redirect()->route('admin.reservations.index')->with('error', 'Cannot delete table with reservations');
        }
        
        $table->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Table deleted successfully');
    }

    
    public function createReservation()
    {
        $tables = Table::where('is_active', true)->get();
        return view('admin.reservations.create_reservation', compact('tables'));
    }

    public function storeReservation(Request $request)
    {
        $validated = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'reservation_time' => 'required|date',
            'guests' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        $reservation = new Reservation();
        $reservation->table_id = $validated['table_id'];
        $reservation->customer_name = $validated['customer_name'];
        $reservation->customer_phone = $validated['customer_phone'];
        $reservation->reservation_time = $validated['reservation_time'];
        $reservation->guests = $validated['guests'];
        $reservation->status = $validated['status'];
        $reservation->notes = $validated['notes'] ?? null;
        $reservation->save();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation created successfully');
    }

    public function editReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $tables = Table::where('is_active', true)->get();
        return view('admin.reservations.edit_reservation', compact('reservation', 'tables'));
    }

    public function updateReservation(Request $request, $id)
    {
        $validated = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'reservation_time' => 'required|date',
            'guests' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->table_id = $validated['table_id'];
        $reservation->customer_name = $validated['customer_name'];
        $reservation->customer_phone = $validated['customer_phone'];
        $reservation->reservation_time = $validated['reservation_time'];
        $reservation->guests = $validated['guests'];
        $reservation->status = $validated['status'];
        $reservation->notes = $validated['notes'] ?? null;
        $reservation->save();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated successfully');
    }

    public function destroyReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $validated['status'];
        $reservation->save();

        return redirect()->route('admin.reservations.index')->with('success', 'Status updated successfully');
    }
}