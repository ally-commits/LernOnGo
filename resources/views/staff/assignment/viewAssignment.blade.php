@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Semester Name</th>
                    <th>Subject Name</th>
                    <th>Assignemnt Name</th>
                    <th>Assignemnt Question</th>
                    <th>Submission</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->sem_name }}</td> 
                            <td>{{ $d->sub_name }}</td> 
                            <td>{{ $d->name }}</td> 
                            <td>{{ $d->question }}</td> 
                            <td><a href="/staff/view-assignment/{{$d->id}}">View Submission</a></td>
                            <td>
                                <a href="/staff/assignment/{{$d->id}}/edit">Edit</a>
                                <a href="/staff/assignment/delete/{{$d->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection