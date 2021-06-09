<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Upload File</title>
</head>
<body>
    
    <form action="{{ route('save.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file[]" multiple>
        <input type="submit" value="Submit">

    </form>


    {{-- <img src="data:image/jpeg;base64, {{ $post->IMG }}"> --}}

    <br>

    @if (isset($post))
        @foreach ($post as $f)
        {{ $f->Id }}
        <a href="/download/{{ $f->Id }}">get data</a>
        @endforeach
    @endif
 
    <div class="test">test</div>


    @if (isset($posty))
        <span>true</span>

    @else
        <span>false</span>
    @endif



    <script>
        var x = $('.test').text("samp");
        console.log(x);
    </script>
</body>
</html>