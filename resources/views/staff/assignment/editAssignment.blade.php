@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>Edit Assignment</h5>
            </div>
            <div class="card-body">
                <form action="/staff/assignment/{{ $assignment[0]->id }}"  method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Select the Subject</label>
                            <select name="subject" class="form-control @error('subject') is-invalid @enderror">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}" @if($assignment[0]->subId == $subject->id) selected @endif)>{{$subject->name}}</option>
                                @endforeach
                            </select>

                            @error("subject")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the Name</label>
                            <input type="text" place="Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ $assignment[0]->name }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Enter the Video Question</label>
                            <textarea type="url" rows="3" placeholder="Enter the Question" class="form-control  @error('question') is-invalid @enderror"
                                name="question">{{ $assignment[0]->question }}</textarea>
                            @error("link")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>  
                    </div> 
                    <button type="submit" class="btn btn-primary">Update Assignment</button>
                </form>
            </div>
        </div>
    </div>
@endsection