<div class="flex justify-end mb-4">
    <ul
        class="tab-categories-title tab-categories-title-admin border border-solid bg-[#128c7e] border-[#128c7e] text-[13px] flex justify-between items-center rounded-xl overflow-hidden text-white">
        <li>
            <a href="{{route('member.mystory')}}" title="Công pháp đã tu luyện"
                class="block sm:min-w-[180px] text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e] 
                @if(request()->routeIs('member.mystory')) active @endif">Công pháp đã tu luyện</a>
        </li>
        {{-- <li>
            <a href="https://blhvip.vn/truyen-cua-toi/dang-mua" title="Truyện đang mua"
                class="block sm:min-w-[180px] text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e] ">Truyện
                đang mua</a>
        </li> --}}
        <li>
            <a href="{{route('member.mystory.favorites')}}" title="Công pháp đã lưu"
                class="block sm:min-w-[180px] text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e] 
                @if(request()->routeIs('member.mystory.favorites')) active @endif">Công pháp đã lưu</a>
        </li>
    </ul>
</div>