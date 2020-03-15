@extends("layouts.staff")

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
                    <th>Student Name</th>
                    <th>Subject Name</th>
                    <th>Notes Name</th>
                    <th>Status</th>
                    <th>Notes</th>
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
                            <td><a href="/{{$d->file}}">View Notes</a></td>
                            @if($d->status == "pending")
                                <td>
                                    <a href="/staff/view-sent-notes/{{$d->id}}/approve">Approve</a>
                                        |
                                    <a href="/staff/view-sent-notes/{{$d->id}}/reject">Reject</a>
                                </td>
                            @elseif($d->status == 'approved')
                                <td>Approved</td>
                            @else
                                <td>Rejected..</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection