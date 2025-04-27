@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="text-center">
        <h2>Welcome to Restaurant Management System</h2>
        <p class="mt-4">Please use the sidebar to navigate to different sections</p>
        
        <div style="margin-top: 3rem; display: flex; justify-content: center; gap: 2rem;">
            <div style="text-align: center; padding: 2rem; background: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); width: 300px;">
                <h3 style="margin-bottom: 1rem; color: #e74c3c;">Menu Management</h3>
                <p>Manage your restaurant's menu items, categories, and availability</p>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Go to Menu Management</a>
            </div>
            
            <div style="text-align: center; padding: 2rem; background: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); width: 300px;">
                <h3 style="margin-bottom: 1rem; color: #e74c3c;">Reservation Management</h3>
                <p>Manage tables and customer reservations for your restaurant</p>
                <a href="{{ route('admin.reservations.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Go to Reservation Management</a>
            </div>
        </div>
    </div>
@endsection