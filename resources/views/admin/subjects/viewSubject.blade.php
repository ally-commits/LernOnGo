@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card p-2">
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th>Semester</th>
                    <th>Subject Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $d->sem_name }}</td>
                            <td>{{ $d->name }}</td>
                            <td>Edit Del</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection