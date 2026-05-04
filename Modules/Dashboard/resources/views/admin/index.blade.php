@extends('layouts.admin.master')

@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fe fe-life-buoy ml-1"></i>
                    داشبورد</a></li>
        </ol>
        <div class="mt-3 mt-lg-0">
            <div class="d-flex align-items-center flex-wrap text-nowrap">
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="mt-0 text-right">
                                        <span class="fs-16 font-weight-semibold">جمع کمک های نقدی امروز :</span>
                                        <p class="mb-0 mt-1 text-primary fs-20"> {{ number_format($todayTotal) }}
                                            @if($todayTotal > 0)
                                                <span class="font-weight-bold fs-18">
                                                    تومن
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon1 bg-primary my-auto float-left">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="mt-0 text-right">
                                        <span class="fs-16 font-weight-semibold">جمع کمک های نقدی هفته اخیر :</span>
                                        <p class="mb-0 mt-1 text-pink  fs-20">{{ number_format($weekTotal) }}
                                            @if($weekTotal > 0)
                                                <span class="font-weight-bold fs-18">
                                                    تومن
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon1 bg-pink my-auto float-left">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="mt-0 text-right">
                                        <span class="fs-16 font-weight-semibold">جمع کمک های نقدی ماه اخیر :</span>
                                        <p class="mb-0 mt-1 text-success fs-20"> {{ number_format($monthTotal) }}
                                            @if($monthTotal > 0)
                                                <span class="font-weight-bold fs-18">
                                                    تومن
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon1 bg-secondary my-auto float-left">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="mt-0 text-right">
                                        <span class="fs-16 font-weight-semibold">جمع کل کمک های نقدی :</span>
                                        <p class="mb-0 mt-1 text-success fs-20"> {{ number_format($allTotal) }}
                                            @if($allTotal > 0)
                                                <span class="font-weight-bold fs-18">
                                                    تومن
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon1 bg-success my-auto float-left">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection