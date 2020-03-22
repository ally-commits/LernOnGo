@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Add Scholarship</h5>
                <a href="/admin/scholarship" class="btn btn-primary">View Scholarships</a>
            </div>
            <div class="card-body">
                <form action="{{ route('scholarship.store') }}" method="POST">
                @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Enter the Scholarship Name</label>
                            <input type="text" place="Subject Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the last date to Apply</label>
                            <input type="date" place="last Date" class="form-control  @error('lastDate') is-invalid @enderror"
                                name="lastDate" value="{{ old('lastDate') }}" id="myDate" />
                            @error("lastDate")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-8">
                            <label for="">Enter the Description</label>
                            <textarea  rows="3" placeholder="Enter the Description" class="form-control  @error('desc') is-invalid @enderror"
                                name="desc">{{ old('desc') }}</textarea>
                            @error("desc")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> 
                    </div> 
                    <button type="submit" class="btn btn-primary">Add Scholarship</button>
                </form>
            </div>
        </div>
    </div>
    <script>
    let myDate = document.getElementById("myDate"); 
    let month = 0;
    if(parseInt(new Date().getMonth()+1) < 9) {
        month = "0" + parseInt(new Date().getMonth()+1);
    } else {
        month = parseInt(new Date().getMonth()+1);
    }
    let value = new Date().getFullYear() + "-" + month + "-" + new Date().getDate();
    myDate.min = value;

</script>
@endsection