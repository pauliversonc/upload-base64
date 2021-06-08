<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload File</title>
</head>
<body>
    
    <form action="{{ route('save.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file[]" multiple>
        <input type="submit" value="Submit">

    </form>


    <img src="data:image/jpeg;base64, {{ $post->IMG }}">


</body>
</html>