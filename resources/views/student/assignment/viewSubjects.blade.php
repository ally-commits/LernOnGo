@extends("layouts.app")

@section("content")
    <div class="container w-100" >
        <div class="card">
            <div class="card-header">
                <h3>Subjects</h3>
            </div>
            <div class="card-body row">
                @if(count($subjects) == 0)
                    <div>No Subjects Found for this semester</div>
                @else
                    @foreach($subjects as $subject)
                        <div class="col-md-3 my-2">
                            <div class="card p-2">
                                <h4 class="text-center" style="font-weight: 100;">{{ $subject->name }}</h4>
                                <a class="btn btn-danger m-2" href="/view-assignment/{{$subject->sem_id}}/{{$subject->id}}">View Assignments</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection