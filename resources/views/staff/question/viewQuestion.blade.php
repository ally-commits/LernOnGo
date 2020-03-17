@extends("layouts.staff")

@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>View Question - {{$mcq->name}}</h5>
                <a class="btn btn-primary" href="/staff/question/{{$id}}/create">Add One</a>
            </div>
            <table class="table table-striped table-vcenter">
                <thead>
                    <th>Sl No</th>
                    <th colspan="2">Question</th>
                    <th>Action</th>
                </thead>
                </thead>
                    <th>Option 1</th> 
                    <th>Option 2</th> 
                    <th>Option 3</th> 
                    <th>Option 4</th> 
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}) </td>
                            <td colspan="2">{{ $d->question }}</td>   
                            <td>
                                <a href="/staff/question/{{$id}}/{{$d->id}}/edit">Edit</a> |
                                <a href="/staff/question/{{$id}}/{{$d->id}}/delete">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td @if($d->op1 == $d->answer) class="bg-success text-white" @endif>a) {{$d->op1}}</td>
                            <td @if($d->op2 == $d->answer) class="bg-success text-white" @endif>b) {{$d->op2}}</td>
                            <td @if($d->op3 == $d->answer) class="bg-success text-white" @endif>c) {{$d->op3}}</td>
                            <td @if($d->op4 == $d->answer) class="bg-success text-white" @endif>d) {{$d->op4}}</td>
                        </tr> 
                        <tr>
                            <td colspan="4"></td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection