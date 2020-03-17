@extends("layouts.staff")

@section("content")
    <div class="container card">
        <div class="card-header">
            <h5>Add Question</h5>
        </div>
        <div class="card-body">
            <form action="/staff/question/{{$id}}/{{$data->id}}/update" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Enter the Question</label>
                        <input type="text" placeholder="MCQ  Question" class="form-control  @error('question') is-invalid @enderror"
                            name="question" value="{{ $data->question }}" />
                        @error("question")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="">Enter the Option 1</label>
                        <input onblur="func();" id="op1" type="text" placeholder="Option 1" class="form-control  @error('op1') is-invalid @enderror"
                            name="op1" value="{{ $data->op1 }}" />
                        @error("op1")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="">Enter the Option 2</label>
                        <input onblur="func();" id="op2"  type="text" placeholder="Option 2" class="form-control  @error('op2') is-invalid @enderror"
                            name="op2" value="{{ $data->op2 }}" />
                        @error("op2")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="">Enter the Option 3</label>
                        <input onblur="func();" id="op3" type="text" placeholder="Option 3" class="form-control  @error('op3') is-invalid @enderror"
                            name="op3" value="{{ $data->op3 }}" />
                        @error("op3")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="">Enter the Option 4</label>
                        <input onblur="func();" id="op4" type="text" placeholder="Option 4" class="form-control  @error('op4') is-invalid @enderror"
                            name="op4" value="{{ $data->op4 }}" />
                        @error("question")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="">Select Answer</label>
                        <select name="answer" id="answer" class="form-control  @error('answer') is-invalid @enderror">

                        </select>
                        @error("answer")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>  
                </div>
                <button class="btn btn-danger">Update Question</button>
            </form>
        </div>
    </div>
@endsection

@section("js")
<script>
    let op1 = document.getElementById("op1");
    let op2 = document.getElementById("op2"); 
    let op3 = document.getElementById("op3");
    let op4 = document.getElementById("op4");
    let answer = document.getElementById("answer");

    let func = () => {
        answer.innerHTML = 
            `<option>${op1.value}</option>
            <option>${op2.value}</option>
            <option>${op3.value}</option>
            <option>${op4.value}</option>`;
    }
    func();
</script>
@endsection

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam quidem numquam itaque, voluptate, tempora corporis suscipit commodi quod temporibus officiis modi dicta, id labore soluta aliquid consequuntur a molestias alias quos. Similique blanditiis architecto nihil doloribus eveniet nostrum vel vero excepturi porro, quasi exercitationem veniam voluptate in, error quaerat provident eos necessitatibus omnis ullam. 