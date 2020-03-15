@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h6>{{$user->name}}</h6>
                    <h6>{{$user->email}}</h6>
                </div>
                <a href="javascript:history.back()" class="btn btn-primary">Back</a>
            </div>
            <div class="card-body">
                <p>
                    {{$data->answer}}
                </p>
            </div>
        </div>
    </div>
@endsection
