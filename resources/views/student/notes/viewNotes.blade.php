@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        @if(count($notes) == 0) 
            No Notes found 
        @endif
        @foreach($notes as $note)
            <div class="col-md-6 col-xl-4"> 
                <div class="block d-flex flex-column">
                    <div class="block-content block-content-full bg-primary min-height-125 flex-grow-0">
                        <h3 class="h2 text-white-op text-center mt-30">{{ $note->subName }}</h3>
                    </div>
                    <div class="block-content flex-grow-1">
                        <h5 class="mb-5">
                            <a class="text-dark" href="javascript:void(0)">
                                {{ $note->name }}
                            </a>
                        </h5>
                        <p class="text-muted">
                            Staff Name: {{ $note->staffName }}
                        </p>
                        <a href="{{ asset($note->file) }}" class="btn btn-danger mb-1">View Note</a>
                    </div> 
                </div> 
            </div> 
        @endforeach
    </div>
@endsection