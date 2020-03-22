@extends("layouts.staff")
@section("css")
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection
@section("js")
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
@endsection
@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>View MCQS</h5>
                <div>
                    <a class="btn btn-primary" href="/staff/mcq/create">Add One</a>
                </div>
            </div>
            <div class="card-body">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Subject Name</th>
                    <th>Semester Name</th> 
                    <th>Question</th>
                    <th>Publish</th>
                    <th>Action</th>
                    <th>Calculate</th>
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
                            @if(!$d->publish)
                                <a href="/staff/mcq/{{$d->id}}/edit">Edit</a> |
                            @endif
                                <a href="/staff/mcq/delete/{{$d->id}}">Delete</a>
                            </td>
                            <td>
                                <a href="/staff/mcq/{{$d->subId}}/calculate">Calculate Result</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection