<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <!-- Using Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5 p-4 bg-white shadow-sm rounded">
        <h1 class="text-center mb-4">Edit Item</h1>
        
        <!-- Form for Editing Item -->
        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Item Name Input -->
            <div class="form-group">
                <label for="name" class="form-label">Item Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $item->name }}" required>
            </div>

            <!-- Update Button -->
            <button type="submit" class="btn btn-success w-100">Update Item</button>
            
            <!-- Back Button -->
            <a href="{{ route('items.index') }}" class="btn btn-secondary w-100 mt-2">Back to Items List</a>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
