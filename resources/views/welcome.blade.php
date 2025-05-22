<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloudinary Image Upload Test</title>
</head>
<body>
    <h2>Upload Image to Cloudinary</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        <img src="{{ session('url') }}" alt="Uploaded Image" width="200">
    @endif

    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="image">Choose Image:</label>
        <input type="file" name="image" accept="image/*" required><br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>
