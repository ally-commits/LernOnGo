@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between">
                <h5>View Events</h5>
                <a class="btn btn-primary" href="/staff/staffEvent/create">Add One</a>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Image</th>
                    <th>Registred</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->date }}</td>
                            <td>{{ $d->venue }}</td>
                            <td><img src="{{ asset($d->image) }}" style="width: 100px;"/></td>
                            <td><a href="/staff/view-registred/{{$d->id}}">View Registred</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection