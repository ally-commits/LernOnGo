@extends("layouts.staff")
@section("content")
    <div class="container">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>View Question - {{$mcq->name}}</h5>
                <a href="/staff/mcq/student-attended/{{$mcqId}}" class="btn btn-primary">Go Back</a> 
            </div>
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <th>Sl No</th>
                    <th colspan="4">Question</th> 
                </thead>
                </thead>
                    <th>Option 1</th> 
                    <th>Option 2</th> 
                    <th>Option 3</th> 
                    <th>Option 4</th> 
                    <th>Answered</th>
                </thead>
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{ $key+1 }}) </td>
                            <td colspan="4">{{ $d->question }}</td>    
                        </tr>
                        <tr>
                            <td @if($d->op1 == $d->answer) class="bg-success text-white" @endif>a) {{$d->op1}}</td>
                            <td @if($d->op2 == $d->answer) class="bg-success text-white" @endif>b) {{$d->op2}}</td>
                            <td @if($d->op3 == $d->answer) class="bg-success text-white" @endif>c) {{$d->op3}}</td>
                            <td @if($d->op4 == $d->answer) class="bg-success text-white" @endif>d) {{$d->op4}}</td>
                            @if($d->correct)
                                <td class="bg-success text-white">| {{ $d->ans }}</td>
                            @else
                                <td class="bg-danger text-white">| {{ $d->ans }}</td>
                            @endif
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