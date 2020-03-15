@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        @foreach($assignments as $assign)
            <div class="col-md-6 col-xl-4"> 
                <div class="block d-flex flex-column">
                    <div class="block-content block-content-full bg-danger min-height-125 flex-grow-0">
                        <h3 class="h2 text-white-op text-center mt-30">{{ $assign->subName }}</h3>
                    </div>
                    <div class="block-content flex-grow-1">
                        <h5 class="mb-5">
                            <a class="text-dark" href="javascript:void(0)">
                                {{ $assign->name }}
                            </a>
                        </h5>
                        <p class="text-muted">
                            Staff Name: {{ $assign->staffName }}
                        </p>
                        <p><b>Question:</b>{{ $assign->question }}</p>
                        @if($assign->active)
                            <a href="/answer-assignment/{{$assign->id}}" class="btn btn-danger mb-1">Answer Assignment</a>
                        @else
                            <a href="#" class="btn btn-danger mb-1">Answered</a>
                        @endif
                    </div> 
                </div> 
            </div> 
        @endforeach
    </div>
@endsection