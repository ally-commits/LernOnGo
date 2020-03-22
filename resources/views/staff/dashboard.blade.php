@extends('layouts.staff')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Your Assigned Subjects</h5>
                    <a href="/staff/subject/create" class="btn btn-primary">Add Subject</a>
                </div>
                <div class="card-body">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <th>Sl No</th> 
                        <th>Subject Name</th> 
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$d)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $d->name }}</td>
                                <td>
                                    <a href="/staff/subject/delete/{{$d->id}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
