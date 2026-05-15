@extends('layouts.profile')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <div class="main-content py-2 ">
        <div class="my-2 shadow-[0_0_1px_rgba(0,0,0,.13)] min-h-[83vh]">
            <div class="px-4">
                @include('member_profile.parts.profile_breadcrumb')

                <div class="flex flex-wrap -mx-2">
                    @foreach ($records as $item)
                        <div class="basis-full md:basis-1/2 px-2 mb-4 item-user-story-history">
                            <div class="card-readed rounded h-full flex justify-between p-4 pr-8 bg-white shadow-[2px_2px_9px_rgba(0,0,0,.14)] relative">
                                <div class="block mr-2">
                                    <p class="name font-bold block mb-1">
                                        <span class="mr-2">Mã giao dịch:</span>
                                        {{ $item['code'] }}
                                    </p>
                                    <p class="flex">
                                        <span class="mr-2">Số tiền đã nạp:</span>
                                        <span class="text-[0.875rem] text-[#007bff] block">{{ number_format($item['amount'], 0, ',', '.') }} VND</span>
                                    </p>
                                    <p class="flex">
                                        <span class="mr-2">Số linh thạch nhận được:</span>
                                        <span class="text-[0.875rem] text-[#d31f1f] block ">{{ $item['money_web'] }} LT</span>
                                    </p>
                                    <p class="flex">
                                        <span class="mr-2">Thời gian giao dịch:</span>
                                        <span class="text-[0.875rem] text-[#28a745] block">{{ $item['transaction_date'] }}</span>
                                    </p>
                                </div>
                            
                            </div>
                        </div>
                        
                    @endforeach
       
                </div>
                @include('parts.template.paging_client_v1')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
