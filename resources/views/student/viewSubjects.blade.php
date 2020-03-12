@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        @foreach($subjects as $subject)
            <div class="col-md-4 my-2">
                <div class="card p-2">
                    <h2 class="text-center">{{ $subject->name }}</h2>
                    <a class="btn btn-primary m-2" href="/view-notes/{{$subject->sem_id}}/{{$subject->id}}">View Notes</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection