@extends("layouts.app")

@section("content")
    <div class="container">
        <form action="/mcq/answer-mcq/{{$id}}" method="POST">
        @csrf
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>MCQ - {{$mcq->name}}</h5> 
            </div>
            <table class="table table-striped table-center"> 
                <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td colspan="4">{{ $key+1 }} | {{ $d->question }}</td>   
                        </tr>
                        <tr>
                            <td>
                                a) 
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" id="{{ $d->op1 }}{{$d->id}}" value="{{ $d->op1 }}" name="{{$d->quest}}" @if(old($d->quest) == $d->op1) checked @endif>
                                    <label class="custom-control-label" for="{{ $d->op1 }}{{$d->id}}">{{$d->op1}}</label>
                                </div>
                            </td>
                            <td>
                                b)
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" id="{{ $d->op2 }}{{$d->id}}" value="{{ $d->op2 }}" name="{{$d->quest}}"  @if(old($d->quest) == $d->op2) checked @endif>
                                    <label class="custom-control-label" for="{{ $d->op2 }}{{$d->id}}">{{$d->op2}}</label>
                                </div>
                            </td>
                            <td>
                                c)
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" id="{{ $d->op3 }}{{$d->id}}" value="{{ $d->op3 }}" name="{{$d->quest}}"  @if(old($d->quest) == $d->op3) checked @endif>
                                    <label class="custom-control-label" for="{{ $d->op3 }}{{$d->id}}">{{$d->op3}}</label>
                                </div>
                            </td>
                            <td>
                                d) 
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" id="{{ $d->op4 }}{{$d->id}}" value="{{ $d->op4 }}" name="{{$d->quest}}"  @if(old($d->quest) == $d->op4) checked @endif>
                                    <label class="custom-control-label" for="{{ $d->op4 }}{{$d->id}}">{{$d->op4}}</label>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="4">
                            @error($d->quest)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <button type="submit" class="btn btn-primary">Submit MCQ</button>
            </div>
        </div>
        </form>
    </div>
@endsection