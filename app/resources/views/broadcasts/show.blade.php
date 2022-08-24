@extends('layouts.main')

<link href="https://vjs.zencdn.net/7.20.2/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/7.20.2/video.min.js"></script>


@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">

                <video
                    id="my-video"
                    class="video-js"
                    controls
                    preload="auto"
                    width="640"
                    height="264"
                    poster="{{asset('/images/vprew.png')}}"
                    data-setup="{}"
                >
                    <source src="{{$broadcast['rtmp_url']}}"  />
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank"
                        >supports HTML5 video</a
                        >
                    </p>
                </video>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Id: {{$broadcast['id']}}</li>
                <li class="list-group-item">Описание: {{$broadcast['description']}}</li>
                <li class="list-group-item">Описание: {{$broadcast['description']}}</li>
                <li class="list-group-item">Автор стрима: {{$broadcast['username'] ?? '-'}}</li>
                <li class="list-group-item">Ссылка на трансляцию: {{$broadcast['rtmp_url']}}</li>
            </ul>
        </div>
    </section>
@endsection
