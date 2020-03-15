@extends("layouts.app")
 
@section("content")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p><b>Question: </b> {{$data->question }}</p>
            </div>
            <div class="card-body">
                <form action="{{ route('submitAssignment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="answer" cols="30" rows="15" style="w-100"
                                class="form-control @error('answer') is-invalid @enderror"
                            ></textarea>
                            @error("answer")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group m-3">
                            <button class="btn btn-primary">Submit Assignment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection