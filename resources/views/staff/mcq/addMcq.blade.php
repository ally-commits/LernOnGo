@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>Add MCQ</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mcq.store') }}" method="POST" enctype="multipart/form-data"> 
                @csrf
                    <div class="row"> 
                        <div class="form-group col-md-6">
                            <label for="">Select the Subject</label>
                            <select name="subject" class="form-control @error('subject') is-invalid @enderror">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>

                            @error("subject")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the MCQ Name</label>
                            <input type="text" placeholder="MCQ  Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>  

                    </div> 
                    <button type="submit" class="btn btn-primary">Add MCQ</button>
                </form>
            </div>
        </div>
    </div>
@endsection