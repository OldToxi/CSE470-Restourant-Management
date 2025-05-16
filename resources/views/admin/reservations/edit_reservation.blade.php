@extends('layouts.admin')
@section('title', 'Edit Reservation')
@section('header-actions')
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Back to Reservations</a>
@endsection
@section('content')
    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
       
        <div class="form-group">
            <label for="table_id" class="form-label">Table</label>
            <select class="form-control" id="table_id" name="table_id" required>
                <option value="">Select Table</option>
                @foreach($tables as $table)
                    <option value="{{ $table->id }}" {{ old('table_id', $reservation->table_id) == $table->id ? 'selected' : '' }}>{{ $table->name }} (Capacity: {{ $table->capacity }})</option>
                @endforeach
            </select>
        </div>
       
        <div class="form-group">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', $reservation->customer_name) }}" required>
        </div>
       
        <div class="form-group">
            <label for="customer_phone" class="form-label">Customer Phone</label>
            <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $reservation->customer_phone) }}" required>
        </div>
       
        <div class="form-group">
            <label for="reservation_time" class="form-label">Reservation Date & Time</label>
            <input type="datetime-local" class="form-control" id="reservation_time" name="reservation_time" value="{{ old('reservation_time', $reservation->reservation_time->format('Y-m-d\TH:i')) }}" required>
        </div>
       
        <div class="form-group">
            <label for="guests" class="form-label">Number of Guests</label>
            <input type="number" class="form-control" id="guests" name="guests" value="{{ old('guests', $reservation->guests) }}" min="1" required>
        </div>
       
        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ old('status', $reservation->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ old('status', $reservation->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="completed" {{ old('status', $reservation->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
       
        <div class="form-group">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $reservation->notes) }}</textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Reservation</button>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validate that the number of guests doesn't exceed table capacity
            const tableSelect = document.getElementById('table_id');
            const guestsInput = document.getElementById('guests');
            const form = document.querySelector('form');
            
            form.addEventListener('submit', function(e) {
                const selectedOption = tableSelect.options[tableSelect.selectedIndex];
                if (selectedOption.value) {
                    const capacity = parseInt(selectedOption.textContent.match(/Capacity: (\d+)/)[1]);
                    const guests = parseInt(guestsInput.value);
                    
                    if (guests > capacity) {
                        e.preventDefault();
                        alert(`The selected table has a capacity of ${capacity}, but you're trying to reserve for ${guests} guests.`);
                    }
                }
            });
        });
    </script>
@endsection