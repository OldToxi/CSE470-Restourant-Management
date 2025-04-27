@extends('layouts.admin')

@section('title', 'Reservation Management')

@section('header-actions')
    <div>
        <a href="{{ route('admin.reservations.tables.create') }}" class="btn btn-secondary">Add New Table</a>
        <a href="{{ route('admin.reservations.create') }}" class="btn btn-primary">Add New Reservation</a>
    </div>
@endsection

@section('content')
    <div class="mb-4">
        <h2>Tables</h2>
        @if($tables->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>{{ $table->name }}</td>
                            <td>{{ $table->capacity }} people</td>
                            <td>
                                @if($table->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.reservations.tables.edit', $table->id) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">Edit</a>
                                    
                                    <form action="{{ route('admin.reservations.tables.destroy', $table->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" onclick="return confirm('Are you sure you want to delete this table?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tables available.</p>
        @endif
    </div>

    <div class="mb-4">
        <h2>Reservations</h2>
        @if($reservations->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Table</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Date & Time</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->table->name }}</td>
                            <td>{{ $reservation->customer_name }}</td>
                            <td>{{ $reservation->customer_phone }}</td>
                            <td>{{ $reservation->reservation_time->format('M d, Y h:i A') }}</td>
                            <td>{{ $reservation->guests }}</td>
                            <td>
                                @if($reservation->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($reservation->status == 'confirmed')
                                    <span class="badge badge-success">Confirmed</span>
                                @elseif($reservation->status == 'cancelled')
                                    <span class="badge badge-danger">Cancelled</span>
                                @elseif($reservation->status == 'completed')
                                    <span class="badge badge-info">Completed</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">Edit</a>
                                    
                                    <form action="{{ route('admin.reservations.status.update', $reservation->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" style="padding: 0.25rem; border-radius: 4px; border: 1px solid #ced4da;">
                                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </form>
                                    
                                    <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No reservations available.</p>
        @endif
    </div>
@endsection
