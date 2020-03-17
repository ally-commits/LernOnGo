@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        @if(count($data) == 0) 
            No Events found 
        @endif
        @foreach($data as $d)
            <div class="col-md-6 col-xl-4"> 
                <div class="block d-flex flex-column">
                    <div class="block-content block-content-full min-height-125 flex-grow-0"
                        style="background-image: url({{$d->image}}); background-size: cover;"
                    >
                        <h3 class="h2 text-white-op text-center mt-30">{{ $d->name }}</h3>
                    </div>
                    <div class="block-content flex-grow-1">
                        <h5 class="mb-5">
                            <a class="text-dark" href="javascript:void(0)">
                                Event Venue: {{ $d->venue }}
                            </a>
                        </h5>
                        <p class="text-muted">
                            Date: {{ $d->date }}
                        </p> 
                        @if($d->active)
                            <a href="/register-event/{{$d->id}}" class=" btn btn-primary mb-2">+ Join</a>
                        @else
                            <a href="#" class="disbaled btn btn-primary mb-2">Already Registred</a>
                        @endif
                    </div> 
                </div> 
            </div> 
        @endforeach
    </div>
@endsection
