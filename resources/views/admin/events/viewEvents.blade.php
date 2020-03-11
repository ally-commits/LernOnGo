@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Image</th>
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
                            <td>
                                <a href="/admin/events/{{$d->id}}/edit">Edit</a>
                                <a href="/admin/events/delete/{{$d->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection