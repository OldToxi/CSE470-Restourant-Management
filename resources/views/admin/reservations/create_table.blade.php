@extends('layouts.admin')

@section('title', 'Add New Table')

@section('header-actions')
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Back to Reservations</a>
@endsection

@section('content')
    <form action="{{ route('admin.reservations.tables.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">Table Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Table 1" required>
        </div>
        
        <div class="form-group">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', 4) }}" min="1" required>
        </div>
        
        <div class="form-group">
            <div style="display: flex; align-items: center;">
                <input type="checkbox" id="is_active" name="is_active" {{ old('is_active', 1) ? 'checked' : '' }} value="1" style="margin-right: 10px;">
                <label for="is_active" class="form-label" style="margin-bottom: 0;">Active</label>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Table</button>
    </form>
@endsection