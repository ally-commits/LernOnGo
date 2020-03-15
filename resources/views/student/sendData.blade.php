@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Send Notes To Lecture</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('uploadNotes') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Select Lecture</label>
                            <select name="staffId" class="form-control">
                                @foreach($staff as $s)
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Select Subject</label>
                            <select name="subId" class="form-control">
                                @foreach($subject as $s)
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the Name</label>
                            <input type="text" place="File" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="">Enter the File</label>
                            <input type="file" place="File" class="form-control  @error('file') is-invalid @enderror"
                                name="file" value="{{ old('file') }}" />
                            @error("file")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> 
                    </div>
                    <button type="submit" class="btn btn-warning">Submit Notes</button>
                </form>
            </div>
        </div>
    </div>
@endsection