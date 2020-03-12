@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>Edit Scholarship</h5>
            </div>
            <div class="card-body">
                <form action="/admin/scholarship/{{$scholarship[0]->id}}" method="POST">
                @method("PUT")
                @csrf
                    <div class="row">
                         
                        <div class="form-group col-md-6">
                            <label for="">Enter the Subject Name</label>
                            <input type="text" place="Subject Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ $scholarship[0]->name }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the Last Date</label>
                            <input type="date" place="Last date" class="form-control  @error('lastDate') is-invalid @enderror"
                                name="lastDate" value="{{ $scholarship[0]->lastDate }}" />
                            @error("lastDate")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="">Enter the Description</label>
                            <textarea  rows="3" placeholder="Enter the Description" class="form-control  @error('desc') is-invalid @enderror"
                                name="desc">{{ $scholarship[0]->desc }}</textarea>
                            @error("desc")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>   
                    </div> 
                    <button type="submit" class="btn btn-primary">Edit Scholarship</button>
                </form>
            </div>
        </div>
    </div>
@endsection