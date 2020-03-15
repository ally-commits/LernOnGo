@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ $event->name }}</h5>
                <div>
                    {{ $count }} : Registred
                    <p>Date: {{ $event->date}}</p>
                </div>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th> 
                    <th>Register Number</th> 
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection