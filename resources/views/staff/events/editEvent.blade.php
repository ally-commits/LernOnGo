@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>Edit Event</h5>
            </div>
            <div class="card-body">
                <form action="/admin/events/{{$event[0]->id}}" method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                    <div class="row">
                         
                        <div class="form-group col-md-6">
                            <label for="">Enter the Subject Name</label>
                            <input type="text" placeholder="Subject Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ $event[0]->name }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="">Enter the Date</label>
                            <input type="date" placeholder="date" class="form-control  @error('date') is-invalid @enderror"
                                name="date" value="{{ $event[0]->date }}" />
                            @error("date")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="">Enter the Venue</label>
                            <input type="text" placeholder="Venue" class="form-control  @error('venue') is-invalid @enderror"
                                name="venue" value="{{ $event[0]->venue }}" />
                            @error("venue")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="">Choose image <span class="text-danger">Only choose image if your want to change</span></label>
                            <input type="file" placeholder="image" class="form-control  @error('image') is-invalid @enderror"
                                name="image" value="{{ $event[0]->image }}" />
                            @error("image")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div> 
                    <button type="submit" class="btn btn-primary">Update Event</button>
                </form>
            </div>
        </div>
    </div>
@endsection