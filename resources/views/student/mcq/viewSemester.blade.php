@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        <div class="card">
            <div class="card-header">
                <h3>MCQ</h3>
            </div>
            <div class="card-body row">
                @foreach($semesters as $semester)
                    <div class="col-md-4 my-2">
                        <div class="card p-2">
                            <h4 class="text-center" style="font-weight: 100;">{{ $semester->sem_name }}</h4>
                            <a class="btn btn-info m-2" href="/view-mcq/{{$semester->id}}">View Subjects</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection