@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Add Subject</h5>
                <a href="/admin/subject" class="btn btn-primary">View Subject</a>
            </div>
            <div class="card-body">
                <form action="{{ route('subject.store') }}" method="POST">
                @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Select the Semester</label>
                            <select name="sem" class="form-control @error('sem') is-invalid @enderror">
                                @foreach($sem as $s)
                                    <option value="{{$s->id}}">{{$s->sem_name}}</option>
                                @endforeach
                            </select>

                            @error("sem")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the Subject Name</label>
                            <input type="text" place="Subject Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ old('subject') }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary">Add Subject</button>
                </form>
            </div>
        </div>
    </div>
@endsection