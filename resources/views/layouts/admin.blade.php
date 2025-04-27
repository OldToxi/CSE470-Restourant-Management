<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System</title>
    <style>
        /* Modern CSS Reset */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        
        body, h1, h2, h3, h4, h5, h6, p, ul, ol {
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        /* Layout */
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, #2c3e50, #1a252f);
            color: #fff;
            padding: 2rem 0;
            transition: all 0.3s;
        }
        
        .sidebar-brand {
            padding: 0 1.5rem 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .sidebar-nav {
            list-style: none;
        }
        
        .sidebar-nav a {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s;
        }
        
        .sidebar-nav a:hover, .sidebar-nav a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left: 4px solid #e74c3c;
        }
        
        /* Main Content */
        .main {
            flex: 1;
            padding: 2rem;
            background-color: #f8f9fa;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .content {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 2rem;
        }
        
        /* Components */
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: all 0.15s ease-in-out;
            text-decoration: none;
            cursor: pointer;
        }
        
        .btn-primary {
            color: #fff;
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        
        .btn-primary:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        
        .btn-secondary {
            color: #fff;
            background-color: #7f8c8d;
            border-color: #7f8c8d;
        }
        
        .btn-secondary:hover {
            background-color: #6c7a7d;
            border-color: #6c7a7d;
        }
        
        .btn-danger {
            color: #fff;
            background-color: #c0392b;
            border-color: #c0392b;
        }
        
        .btn-danger:hover {
            background-color: #a93226;
            border-color: #a93226;
        }
        
        .btn-success {
            color: #fff;
            background-color: #27ae60;
            border-color: #27ae60;
        }
        
        .btn-success:hover {
            background-color: #219a52;
            border-color: #219a52;
        }
        
        /* Forms */
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: inline-block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #e74c3c;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }
        
        /* Tables */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            text-align: left;
        }
        
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #f8f9fa;
        }
        
        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.025);
        }
        
        /* Utilities */
        .text-center {
            text-align: center;
        }
        
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        
        .mt-4 {
            margin-top: 1.5rem;
        }
        
        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        
        .badge-success {
            color: #fff;
            background-color: #27ae60;
        }
        
        .badge-warning {
            color: #212529;
            background-color: #f39c12;
        }
        
        .badge-danger {
            color: #fff;
            background-color: #c0392b;
        }
        
        .badge-info {
            color: #fff;
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-brand">
                RMS
            </div>
            <ul class="sidebar-nav">
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.menu.index') }}" class="{{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">Menu Management</a></li>
                <li><a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">Reservation Management</a></li>
            </ul>
        </aside>
        
        <main class="main">
            <div class="header">
                <h1>@yield('title', 'Dashboard')</h1>
                <div>
                    @yield('header-actions')
                </div>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>