@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header">
                <h5>{{ $assign->name }}</h5>
                <p>{{ $assign->question }} </p>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Student Name</th>
                    <th>Register Number</th> 
                    <th>View Answer</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->name }}</td> 
                            <td>{{ $d->email }}</td>  
                            <td>
                                <a href="/staff/view-assignment-answer/{{$d->id}}/">View Answer</a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection