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
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6>
                    MCQ Results Of:
                    @foreach($data as $d)
                        | {{$d->name}} 
                    @endforeach
                </h6>
                <a href="/staff/mcq" class="btn btn-primary">GO Back</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Reg No</th>
                            @foreach($data as $d)
                                <th>{{$d->name}}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentData as $key=>$d) 
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $d[0]->name }}</td>
                                <td>{{ $d[0]->email }}</td> 
                                @if(count($d) == 1 && $count == 2) 
                                    @if(array_search($d[0]->mcqId, $mcq) == 0)
                                        <td>{{$d[0]->answer}} / {{$d[0]->count}}</td>
                                        <td>Not Atttended</td> 
                                    @else
                                        <td>Not Atttended</td> 
                                        <td>{{$d[0]->answer}} / {{$d[0]->count}}</td>
                                    @endif
                                @else
                                    @foreach($d as $a)
                                        <td>{{$a->answer}} / {{$a->count}}</td>
                                    @endforeach 
                                @endif
                                <td> 
                                    {{ $d->total }} /  {{$d->quest }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection