@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>View Subjects</h5>
                <a href="/admin/subject/create" class="btn btn-primary">Add Subject</a>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Semester</th>
                    <th>Subject Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->sem_name }}</td>
                            <td>{{ $d->name }}</td>
                            <td>
                                <a href="/admin/subject/{{$d->id}}/edit">Edit</a> |
                                <a href="/admin/subject/delete/{{$d->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection