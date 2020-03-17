@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>View MCQS</h5>
                <a class="btn btn-primary" href="/staff/mcq/create">Add One</a>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Subject Name</th>
                    <th>Semester Name</th> 
                    <th>Question</th>
                    <th>Publish</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->sub_name }}</td>
                            <td>{{ $d->sem_name }}</td> 
                            @if($d->publish) 
                                <td><a href="/staff/mcq/student-attended/{{$d->id}}">View Results</a></td>
                            @else
                                <td>
                                    <a href="/staff/question/{{$d->id}}/create">Add Question</a> |
                                    <a href="/staff/question/{{$d->id}}">View Question</a>
                                </td>
                            @endif
                            @if($d->publish)
                                <td>Published</td>
                            @else
                                <td><a href="/staff/mcq/publish/{{$d->id}}">Publish</a></td>
                            @endif
                            <td>
                                <a href="/staff/mcq/{{$d->id}}/edit">Edit</a> |
                                <a href="/staff/mcq/delete/{{$d->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection