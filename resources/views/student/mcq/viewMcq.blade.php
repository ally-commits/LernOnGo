@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        @if(count($mcq) == 0) 
            No MCQ found for this subject
        @endif
        @foreach($mcq as $m)
            <div class="col-md-6 col-xl-4"> 
                <div class="block d-flex flex-column">
                    <div class="block-content block-content-full bg-info min-height-125 flex-grow-0">
                        <h3 class="h2 text-white-op text-center mt-30">{{ $m->subName }}</h3>
                    </div>
                    <div class="block-content flex-grow-1">
                        <h5 class="mb-5">
                            <a class="text-dark" href="javascript:void(0)">
                                {{ $m->name }}
                            </a>
                        </h5>
                        <p class="text-muted">
                            Staff Name: {{ $m->staffName }}
                        </p>  
                        @if($m->active)
                            <a href="/mcq/answer-mcq/{{$m->id}}" class="btn btn-danger mb-1">Answer MCQ</a>
                        @else
                            <a href="#" class="btn btn-danger mb-1">Already Attended</a>
                        @endif
                    </div> 
                </div> 
            </div> 
        @endforeach
    </div>
@endsection