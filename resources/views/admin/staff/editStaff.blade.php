@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>Edit Staff</h5>
            </div>
            <div class="card-body">
                <form action="/admin/staff/{{$staff->id}}" method="POST">
                @method("PUT")
                @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Enter the Name</label>
                            <input type="text" place="Name" class="form-control  @error('name') is-invalid @enderror"
                                name="name" value="{{$staff->name }}" />
                            @error("name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Enter the Username</label>
                            <input type="text" place="username" class="form-control  @error('email') is-invalid @enderror"
                                name="email" value="{{$staff->email }}" />
                            @error("email")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> 
                    </div>
                    <span class="text-danger">Write password only if want to change</span>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary">Update Staff</button>
                </form>
            </div>
        </div>
    </div>
@endsection