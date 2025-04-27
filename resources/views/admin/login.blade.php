<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurant Management System</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
       
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
       
        .login-container {
            width: 400px;
            padding: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
       
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
       
        .login-header h1 {
            color: #e74c3c;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
       
        .login-header p {
            color: #7f8c8d;
        }
       
        .form-group {
            margin-bottom: 1.5rem;
        }
       
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
       
        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 4px;
            transition: all 0.15s ease-in-out;
        }
       
        .form-control:focus {
            background-color: #fff;
            border-color: #e74c3c;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }
       
        .btn {
            display: block;
            width: 100%;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 4px;
            transition: all 0.15s ease-in-out;
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
       
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Restaurant Management</h1>
            <p>Please login to continue</p>
        </div>
       
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
       
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
           
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            
            <div class="text-center mt-3">
                <p class="text-muted">Admin access only</p>
            </div>
        </form>
    </div>
</body>
</html>