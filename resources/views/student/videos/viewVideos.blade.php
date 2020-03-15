@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        @foreach($videos as $video)
            <div class="col-md-6 col-xl-4"> 
                <div class="block d-flex flex-column">
                    <div class="block-content block-content-full bg-flat min-height-125 flex-grow-0">
                        <h3 class="h2 text-white-op text-center mt-30">{{ $video->subName }}</h3>
                    </div>
                    <div class="block-content flex-grow-1">
                        <h5 class="mb-5">
                            <a class="text-dark" href="javascript:void(0)">
                                {{ $video->name }}
                            </a>
                        </h5>
                        <p class="text-muted">
                            Staff Name: {{ $video->staffName }}
                        </p>
                        <a href="{{ asset($video->link) }}" class="btn btn-danger mb-1">View Video</a>
                    </div> 
                </div> 
            </div> 
        @endforeach
    </div>
@endsection