@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-wrap" style="justify-content: space-around;">
        @foreach($data as $d)
            <div class="col-md-6 col-xl-4"> 
                <div class="block d-flex flex-column">
                    <div class="block-content block-content-full bg-secondary min-height-125 flex-grow-0">
                        <h3 class="h2 text-white-op text-center mt-30">{{ $d->name }}</h3>
                    </div>
                    <div class="block-content flex-grow-1">
                        <h5 class="mb-5">
                            <a class="text-dark" href="javascript:void(0)">
                                {{ $d->name }}
                            </a>
                        </h5>
                        <p class="text-muted">
                            Last Date To Apply: {{ $d->lastDate }}
                        </p>
                        <p><b>Description:</b>{{ $d->desc }}</p>
                    </div> 
                </div> 
            </div> 
        @endforeach
    </div>
@endsection
