@extends('layouts.admin')

@section('title', 'Add New Menu Item')

@section('header-actions')
    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Back to Menu</a>
@endsection

@section('content')
    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="price" class="form-label">Price ($)</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price') }}" required>
        </div>
        
        <div class="form-group">
            <label for="category" class="form-label">Category</label>
            <select class="form-control" id="category" name="category" required>
                <option value="">Select Category</option>
                <option value="starters" {{ old('category') == 'starters' ? 'selected' : '' }}>Starters</option>
                <option value="mains" {{ old('category') == 'mains' ? 'selected' : '' }}>Mains</option>
                <option value="drinks" {{ old('category') == 'drinks' ? 'selected' : '' }}>Drinks</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        
        <div class="form-group">
            <div style="display: flex; align-items: center;">
                <input type="checkbox" id="is_available" name="is_available" {{ old('is_available') ? 'checked' : '' }} value="1" style="margin-right: 10px;">
                <label for="is_available" class="form-label" style="margin-bottom: 0;">Available</label>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Menu Item</button>
    </form>
@endsection