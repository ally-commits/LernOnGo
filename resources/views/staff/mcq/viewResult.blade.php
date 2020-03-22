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
                <div>
                    <h5>MCQ Result</h5> 
                    <h5>{{ $mcq->name }}</h5>
                </div>
                <a href="/staff/mcq" class="btn btn-primary">Go Back</a>
            </div>
            <div class="card-body">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Register Number</th>
                    <th>Result</th>  
                    <th>Action</th> 
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->answer }} / {{ $d->count }}</td>  
                            <td><a href="/staff/mcq/student-attended/{{ $mcqId}}/{{ $d->userId }}">View Answers</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection