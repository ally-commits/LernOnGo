@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between">
                <h5>View Notes</h5>
                <a class="btn btn-primary" href="/staff/notes/create">Add One</a>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Semester Name</th>
                    <th>Subject Name</th>
                    <th>Notes Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->sem_name }}</td> 
                            <td>{{ $d->sub_name }}</td> 
                            <td>{{ $d->name }}</td> 
                            <td>
                                <a href="/staff/notes/{{$d->id}}/edit">Edit</a> |
                                <a href="/staff/notes/delete/{{$d->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection