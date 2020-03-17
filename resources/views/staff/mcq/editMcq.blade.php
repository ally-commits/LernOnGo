@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>Edit Event</h5>
            </div>
            <div class="card-body">
                <form action="/staff/mcq/{{$data[0]->id}}" method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                    <div class="row"> 
                        <div class="form-group col-md-6">
                            <label for="">Select the Subject</label>
                            <select name="subject" class="form-control @error('subject') is-invalid @enderror">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}" @if($data[0]->subjectId == $subject->id) selected @endif)>{{$subject->name}}</option>
                                @endforeach
                            </select>

                            @error("subject")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the MCQ Name</label>
                            <input type="text" placeholder="MCQ  Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ $data[0]->name }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>  

                    </div> 
                    <button type="submit" class="btn btn-primary">Update MCQ</button>
                </form>
            </div>
        </div>
    </div>
@endsection