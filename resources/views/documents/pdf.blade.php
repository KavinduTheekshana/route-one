<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Documents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .document {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Documents for {{ $user->name }}</h1>
    @foreach ($documents as $document)
        <div class="document">
            <h3>Document Type: {{ $document->document_type }}</h3>
            <p><strong>Original Name:</strong> {{ $document->file_original_name }}</p>
            <p><strong>Size:</strong> {{ number_format($document->file_size / 1024, 2) }} KB</p>
            <p><strong>Type:</strong> {{ $document->file_type }}</p>
        </div>
    @endforeach
</body>
</html>
