@extends('layouts.admin')
@section('title', 'Add New Reservation')
@section('header-actions')
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Back to Reservations</a>
@endsection
@section('content')
    <form action="{{ route('admin.reservations.store') }}" method="POST">
        @csrf
       
        <div class="form-group">
            <label for="table_id" class="form-label">Table</label>
            <select class="form-control" id="table_id" name="table_id" required>
                <option value="">Select Table</option>
                @foreach($tables as $table)
                    <option value="{{ $table->id }}" {{ old('table_id') == $table->id ? 'selected' : '' }}>{{ $table->name }} (Capacity: {{ $table->capacity }})</option>
                @endforeach
            </select>
        </div>
       
        <div class="form-group">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
        </div>
       
        <div class="form-group">
            <label for="customer_phone" class="form-label">Customer Phone</label>
            <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
        </div>
       
        <div class="form-group">
            <label for="reservation_time" class="form-label">Reservation Date & Time</label>
            <input type="datetime-local" class="form-control" id="reservation_time" name="reservation_time" value="{{ old('reservation_time') }}" required>
        </div>
       
        <div class="form-group">
            <label for="guests" class="form-label">Number of Guests</label>
            <input type="number" class="form-control" id="guests" name="guests" value="{{ old('guests', 2) }}" min="1" required>
        </div>
       
        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
       
        <div class="form-group">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Reservation</button>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set default datetime to current datetime + 1 hour if not already set
            const reservationTimeInput = document.getElementById('reservation_time');
            if (!reservationTimeInput.value) {
                const now = new Date();
                now.setHours(now.getHours() + 1);
                now.setMinutes(0); // Round to the nearest hour
                
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                
                reservationTimeInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
            }
            
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