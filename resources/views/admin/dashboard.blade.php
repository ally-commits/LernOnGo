@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row gutters-tiny js-appear-enabled animated fadeIn" data-toggle="appear"> 
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block text-center" href="javascript:void(0)">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-dusk">
                                    <div class="ribbon-box">{{ $student}}</div>
                                    <p class="mt-5">
                                        <i class="si si-user fa-3x text-white-op"></i>
                                    </p>
                                    <p class="font-w600 text-white">Students</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block text-center" href="javascript:void(0)">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-primary">
                                    <div class="ribbon-box">{{ $staff }}</div>
                                    <p class="mt-5">
                                        <i class="si si-user-following fa-3x text-white-op"></i>
                                    </p>
                                    <p class="font-w600 text-white">Staffs</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block text-center" href="be_pages_forum_categories.html">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-sea">
                                    <div class="ribbon-box">{{ $notes }}</div>
                                    <p class="mt-5">
                                        <i class="si si-layers fa-3x text-white-op"></i>
                                    </p>
                                    <p class="font-w600 text-white">Notes</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block text-center" href="be_pages_generic_search.html">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-lake">
                                    <div class="ribbon-box">{{ $videos }}</div>
                                    <p class="mt-5">
                                        <i class="si si-film fa-3x text-white-op"></i>
                                    </p>
                                    <p class="font-w600 text-white">Videos</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block text-center" href="be_comp_charts.html">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-emerald">
                                    <div class="ribbon-box">{{ $subjects }}</div>
                                    <p class="mt-5">
                                        <i class="si si-docs fa-3x text-white-op"></i>
                                    </p>
                                    <p class="font-w600 text-white">Subjects</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block text-center" href="javascript:void(0)">
                                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-corporate">
                                    <div class="ribbon-box">6</div>
                                    <p class="mt-5">
                                        <i class="si si-grid fa-3x text-white-op"></i>
                                    </p>
                                    <p class="font-w600 text-white">Semester</p>
                                </div>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
