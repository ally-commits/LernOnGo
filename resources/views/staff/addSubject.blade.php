@extends("layouts.staff")

@section("content")
    <div class="container card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Choose Subject You Teach</h4>
            <a href="/staff/dashboard" class="btn btn-primary">View Subjects</a>
        </div>
        <div class="card-body">
            @if(count($subject) == 0)
                <p class="text-center"> No SubjectS are Available</p>
            @else
            <form action="/staff/addSubject" method="POST">
            @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Choose Subject</label>
                        <select name="subject" class="form-control">
                            @foreach($subject as $s)
                            <option value="{{$s->id}}">{{$s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"> 
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @endif
        </div>
    </div>
@endsection