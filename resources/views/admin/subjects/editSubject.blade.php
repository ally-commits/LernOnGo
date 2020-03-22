@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Edit Subject</h5>
                <a href="/admin/subject" class="btn btn-primary">View Subject</a>
            </div>
            <div class="card-body">
                <form action="/admin/subject/{{$sem[0]->id}}" method="POST">
                @method("PUT")
                @csrf
                    <div class="row">
                        <div class="col-md-6">                          
                            <div class="form-group">
                                <label for="">Enter the Semester </label>
                                <select class="form-control @error('level') is-invalid @enderror" name="sem">
                                    <option @if($sem[0]->id == "1") selected @endif value="1">Semester 1</option>
                                    <option @if($sem[0]->id == "2") selected @endif value="2">Semester 2</option>
                                    <option @if($sem[0]->id == "3") selected @endif value="3">Semester 3</option>
                                    <option @if($sem[0]->id == "4") selected @endif value="4">Semester 4</option>
                                    <option @if($sem[0]->id == "5") selected @endif value="5">Semester 5</option>
                                    <option @if($sem[0]->id == "6") selected @endif value="6">Semester 6</option>
                                </select>   
                                @error('sem')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror 
                            </div>
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="">Enter the Subject Name</label>
                            <input type="text" place="Subject Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ $sem[0]->name }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary">Edit Subject</button>
                </form>
            </div>
        </div>
    </div>
@endsection