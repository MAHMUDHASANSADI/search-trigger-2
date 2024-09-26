<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{asset('images/flowers-5229022_640.jpg')}}'), url('{{asset('images/white-paper-texture-background_23-2151025717.avif')}}'); /* Default light mode background image */
            background-size: cover;
            background-position: center;
            height: 1px;  
            background-repeat: no-repeat,repeat;
            background-size: cover;
        }
        .dark-mode {
            color: #af299e;
            background-image: url('{{ asset('images/fog-4479936_1280.jpg') }}'), url('{{ asset('images/HD-wallpaper-background-black-gray-dark-light-colors.jpg') }}'); /* Dark mode background image */
            height: 1px;  
            background-repeat: no-repeat,repeat;
            background-size: cover;
        }
        .container {
            max-width: 900px;
        }
        .table {
            width: 100%;
            table-layout: auto;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .form-inline {
            display: flex;
            justify-content: space-between;
        }
        .search-container {
            display: flex;
            align-items: center;
        }
        .search-container input {
            margin-right: 10px;
        }
        /* Sun and Moon Icon Styling */
        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            font-size: 24px;
        }
        .moon-size{
            height: 100px;
            width: 1000px;
        }
    </style>
</head>
<body>
    <!-- Theme Toggle Buttons -->
    <div class="theme-toggle">
        <span id="sun"  style="display: none;">&#9728;</span> <!-- Sun Icon -->
        <span id="moon" class='text-danger moon-size'>&#127765;</span> <!-- Moon Icon -->
    </div>

    <div class="container mt-5 p-4 bg-white shadow-sm rounded">
        <h1 class="text-center mb-4">Items List</h1>

        <!-- Search Form -->
        <form action="{{ route('items.search') }}" method="GET" class="form-inline">
            <div class="search-container">
                <input type="text" name="query" placeholder="Search items" class="form-control" value="{{ request()->input('query') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Clear Search</a>
        </form>

        <!-- Form to Add New Item -->
        <h2 class="mt-5">Add New Item</h2>
        <form action="{{ route('items.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Item Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter item name" required>
            </div>
            <button type="submit" class="btn btn-success">Add Item</button>
        </form>

        <!-- Display Success Messages -->
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Items Table -->
        <table class="table table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td class="text-center">{{ $item->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">No items found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $items->links('pagination::bootstrap-5') }}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const body = document.body;
        const sunIcon = document.getElementById('sun');
        const moonIcon = document.getElementById('moon');

        // Check localStorage for theme preference on page load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                body.classList.add('dark-mode');
                sunIcon.style.display = 'inline';
                moonIcon.style.display = 'none';
            }
        });

        // Event listener for moon (dark mode)
        moonIcon.addEventListener('click', () => {
            body.classList.add('dark-mode');
            sunIcon.style.display = 'inline';
            moonIcon.style.display = 'none';
            localStorage.setItem('theme', 'dark'); // Save dark mode preference
        });

        // Event listener for sun (light mode)
        sunIcon.addEventListener('click', () => {
            body.classList.remove('dark-mode');
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'inline';
            localStorage.setItem('theme', 'light'); // Save light mode preference
        });
    </script>
</body>
</html>
