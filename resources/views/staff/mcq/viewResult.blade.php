@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between">
                <h5>MCQ Result</h5> 
                <h5>{{ $mcq->name }}</h5>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Register Number</th>
                    <th>Result</th>   
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->answer }} / {{ $d->count }}</td>  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection