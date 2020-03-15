@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>Edit Notes</h5>
            </div>
            <div class="card-body">
                <form action="/staff/notes/{{ $notes[0]->id }}"  method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Select the Subject</label>
                            <select name="subject" class="form-control @error('subject') is-invalid @enderror">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}" @if($notes[0]->subId == $subject->id) selected @endif)>{{$subject->name}}</option>
                                @endforeach
                            </select>

                            @error("subject")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the Name</label>
                            <input type="text" place="Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ $notes[0]->Name }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-danger">Choose file only if u want to change</div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Enter the File</label>
                            <input type="file" place="File" class="form-control  @error('file') is-invalid @enderror"
                                name="file" value="{{ $notes[0]->file }}" />
                            @error("file")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>  
                    </div> 
                    <button type="submit" class="btn btn-primary">Update Notes</button>
                </form>
            </div>
        </div>
    </div>
@endsection