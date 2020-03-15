@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between">
                <h5>View Sent Notes</h5>
                <a class="btn btn-primary" href="/send-notes">Add One</a>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Lecture Name</th>
                    <th>Subject Name</th>
                    <th>Notes Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->sName }}</td> 
                            <td>{{ $d->subName }}</td> 
                            <td>{{ $d->name }}</td> 
                            <td>{{ $d->status }}</td>
                            <td> 
                                @if($d->status == "pending")
                                    <a href="/sent-notes/delete/{{$d->id}}">Delete</a>
                                @else
                                    <a href="#">None</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection