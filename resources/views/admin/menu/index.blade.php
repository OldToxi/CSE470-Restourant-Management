@extends('layouts.admin')

@section('title', 'Menu Management')

@section('header-actions')
    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Add New Item</a>
@endsection

@section('content')
    <!-- Search box -->
    <div class="mb-4">
        <div class="input-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Search menu items by name...">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">Clear</button>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h2>Starters</h2>
        @if($starters->count() > 0)
            <table class="table" id="starters-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($starters as $item)
                        <tr class="menu-item">
                            <td>
                                @if($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div style="width: 60px; height: 60px; background-color: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #adb5bd;">No Image</div>
                                @endif
                            </td>
                            <td class="item-name">{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                @if($item->is_available)
                                    <span class="badge badge-success">Available</span>
                                @else
                                    <span class="badge badge-danger">Unavailable</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">Edit</a>
                                    
                                    <form action="{{ route('admin.menu.toggle', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn {{ $item->is_available ? 'btn-danger' : 'btn-success' }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">
                                            {{ $item->is_available ? 'Mark Unavailable' : 'Mark Available' }}
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No starters available.</p>
        @endif
    </div>

    <div class="mb-4">
        <h2>Mains</h2>
        @if($mains->count() > 0)
            <table class="table" id="mains-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mains as $item)
                        <tr class="menu-item">
                            <td >
                                @if($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div style="width: 60px; height: 60px; background-color: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #adb5bd;">No Image</div>
                                @endif
                            </td>
                            <td class="item-name">{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>৳{{ number_format($item->price, 2) }}</td>
                            <td>
                                @if($item->is_available)
                                    <span class="badge badge-success">Available</span>
                                @else
                                    <span class="badge badge-danger">Unavailable</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">Edit</a>
                                    
                                    <form action="{{ route('admin.menu.toggle', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn {{ $item->is_available ? 'btn-danger' : 'btn-success' }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">
                                            {{ $item->is_available ? 'Mark Unavailable' : 'Mark Available' }}
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No main dishes available.</p>
        @endif
    </div>

    <div class="mb-4">
        <h2>Drinks</h2>
        @if($drinks->count() > 0)
            <table class="table" id="drinks-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drinks as $item)
                        <tr class="menu-item">
                            <td>
                                @if($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div style="width: 60px; height: 60px; background-color: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #adb5bd;">No Image</div>
                                @endif
                            </td>
                            <td class="item-name">{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                @if($item->is_available)
                                    <span class="badge badge-success">Available</span>
                                @else
                                    <span class="badge badge-danger">Unavailable</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">Edit</a>
                                    
                                    <form action="{{ route('admin.menu.toggle', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn {{ $item->is_available ? 'btn-danger' : 'btn-success' }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">
                                            {{ $item->is_available ? 'Mark Unavailable' : 'Mark Available' }}
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No drinks available.</p>
        @endif
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            searchMenuItems();
        });

        function searchMenuItems() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            const menuItems = document.querySelectorAll('.menu-item');
            
            menuItems.forEach(function(item) {
                const itemName = item.querySelector('.item-name').textContent.toLowerCase();
                
                if (itemName.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function clearSearch() {
            document.getElementById('searchInput').value = '';
            searchMenuItems(); 
        }
    </script>
@endsection