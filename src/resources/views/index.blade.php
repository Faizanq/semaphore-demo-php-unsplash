<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Know Your City Weather</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Raleway;
            background-color: #202125;
        }

        .heading {
            text-align: center;
            font-size: 2.0em;
            letter-spacing: 1px;
            padding: 40px;
            color: white;
        }

        .gallery-image {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gallery-image img {
            height: 250px;
            @if($orientation=='portrait')
                width: 190px;
            @else
                width: 350px;
            @endif
            transform: scale(1.0);
            transition: transform 0.4s ease;
        }

        .img-box {
            box-sizing: content-box;
            margin: 10px;
            height: 250px;
            @if($orientation=='portrait')
                width: 190px;
            @else
                width: 350px;
            @endif
            overflow: hidden;
            display: inline-block;
            color: white;
            position: relative;
            background-color: white;
        }

        .caption {
            position: absolute;
            bottom: 5px;
            left: 20px;
            opacity: 0.0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .transparent-box {
            height: 250px;
            @if($orientation=='portrait')
                width: 190px;
            @else
                width: 350px;
            @endif
            background-color:rgba(0, 0, 0, 0);
            position: absolute;
            top: 0;
            left: 0;
            transition: background-color 0.3s ease;
        }

        .img-box:hover img {
            transform: scale(1.1);
        }

        .img-box:hover .transparent-box {
            background-color:rgba(0, 0, 0, 0.5);
        }

        .img-box:hover .caption {
            transform: translateY(-20px);
            opacity: 1.0;
        }

        .img-box:hover {
            cursor: pointer;
        }

        .caption > p:nth-child(2) {
            font-size: 0.8em;
        }

        .opacity-low {
            opacity: 0.5;
        }

        .gallery-form {
            text-align: center;
        }

    </style>
</head>

<body>
  <p class="heading">Know Your City Weather</p>
  <!-- <div class="city-form">
    {{ Form::open(array('url' => '/city/search')) }}
    {{ Form::text('search', $search) }}
    {{ Form::number('count', $count) }}
    {{ Form::select('orientation', ['landscape' => 'Landscape', 'portrait' => 'Portrait'], $orientation) }}
    {{ Form::submit('Search') }}
    {{ Form::close() }}
  </div> -->
  <div class="gallery-image">

    @foreach($cities as $city)
    <div >
        <a class="img-box" href="{{ route('forcast',['city_id'=>$city->id]) }}">
 <img src="{{ $city->cover_image_url }}" >
      <div class="transparent-box">
        <div class="caption">
            <p>{{ $city->name }}</p>
        </div>
      </div>
        </a>
    </div>
    @endforeach

</body>
</html>
