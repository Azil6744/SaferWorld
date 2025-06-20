@extends('layouts.guest')
@section('title', 'Verification Status')
@section('content')
    <div class="wrapper-page">
        <div class="card mb-0">
            <div class="card-body">
                <div class="p-4">
                    <div class="mb-3 text-center">
                        <img src="{{ asset('assets/images/logo-lg.png') }}" width="160px" alt="logo" />
                    </div>
                    <div class="mb-3 text-center">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24">
                                <!-- Blue star -->
                                <path fill="#2563eb"
                                    d="m9.023 21.23l-1.67-2.814l-3.176-.685l.312-3.277L2.346 12L4.49 9.546L4.177 6.27l3.177-.685L9.023 2.77L12 4.027l2.977-1.258l1.67 2.816l3.176.684l-.312 3.277L21.655 12l-2.142 2.454l.311 3.277l-3.177.684l-1.669 2.816L12 19.973zm.427-1.28L12 18.889l2.562 1.061L16 17.55l2.75-.611l-.25-2.839l1.85-2.1l-1.85-2.111l.25-2.839l-2.75-.6l-1.45-2.4L12 5.112L9.439 4.05L8 6.45l-2.75.6l.25 2.839L3.65 12l1.85 2.1l-.25 2.85l2.75.6zm1.5-5.092L15.908 9.9l-.708-.72l-4.25 4.25l-2.15-2.138l-.708.708z" />
                                <!-- Green tick -->
                                <path fill="#22c55e"
                                    d="M10.95 14.858a1 1 0 0 1-1.414 0l-2.122-2.121a1 1 0 1 1 1.414-1.415l1.415 1.415 4.243-4.243a1 1 0 1 1 1.414 1.415l-4.95 4.949z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <h5 class="mb-0"> {{ $status }} </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
