@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        @foreach($semesters as $semester)
            <div class="col-md-4 my-2">
                <div class="card p-2">
                    <h2 class="text-center">{{ $semester->sem_name }}</h2>
                    <a class="btn btn-primary m-2" href="/view-notes/{{$semester->id}}">View Subjects</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection