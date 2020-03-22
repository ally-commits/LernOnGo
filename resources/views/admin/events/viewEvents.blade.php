@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>View Events</h4>
                <a href="/admin/events/create" class="btn btn-primary">Add Event</a>
            </div>
            <div class="card-body">
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Image</th>
                    <th>View Registred</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->date }}</td>
                            <td>{{ $d->venue }}</td>
                            <td><img src="{{ asset($d->image) }}" style="width: 100px;"/></td>
                            <td><a href="/admin/view-registred/{{$d->id}}">View Registred</a></td>
                            <td>
                                <a href="/admin/events/{{$d->id}}/edit">Edit</a> |
                                <a href="/admin/events/delete/{{$d->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection