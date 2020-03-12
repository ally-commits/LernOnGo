@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>Edit Videos</h5>
            </div>
            <div class="card-body">
                <form action="/staff/videos/{{ $video[0]->id }}"  method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Select the Subject</label>
                            <select name="subject" class="form-control @error('subject') is-invalid @enderror">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}" @if($video[0]->subId == $subject->id) selected @endif)>{{$subject->name}}</option>
                                @endforeach
                            </select>

                            @error("subject")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the Name</label>
                            <input type="text" place="Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ $video[0]->name }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Enter the Video Link</label>
                            <input type="url" place="link" class="form-control  @error('link') is-invalid @enderror"
                                name="link" value="{{ $video[0]->link }}" />
                            @error("link")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>  
                    </div> 
                    <button type="submit" class="btn btn-primary">Update Videos</button>
                </form>
            </div>
        </div>
    </div>
@endsection