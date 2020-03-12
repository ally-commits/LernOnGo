@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Last Date</th>
                    <th>Description</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->lastDate }}</td>
                            <td>{{ $d->desc }}</td>
                            <td>
                                <a href="/admin/scholarship/{{$d->id}}/edit">Edit</a>
                                <a href="/admin/scholarship/delete/{{$d->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection