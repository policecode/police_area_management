<div class="head pb-8 mt-4 flex flex-col md:flex-row items-center justify-between">
    <div class="flex items-center mb-2 md:mb-0"></div>
    <ul class="tab-categories-title bg-[#128c7e] text-[13px] flex justify-between items-center rounded overflow-hidden text-white">
        <li>
            @if (request()->routeIs('member.profile'))
                <a href="javascript:void(0)" title="Thông tin" class="block !text-[#fff] hover:!bg-[#0e6d62] p-2 bg-[#0e6d62]">Thông tin</a></li>
            @else
                <a href="{{ route('member.profile', ['user_id' => $user['id']]) }}" title="Thông tin" class="block !text-[#fff] hover:!bg-[#0e6d62] p-2">Thông tin</a></li>
            @endif
        <li>
        <li>
            @if (request()->routeIs('member.profile.votes'))
                <a href="javascript:void(0)" title="Đánh giá" class="block !text-[#fff] hover:!bg-[#0e6d62] p-2 bg-[#0e6d62]">Đánh giá</a></li>
            @else
                <a href="{{ route('member.profile.votes', ['user_id' => $user['id']]) }}" title="Đánh giá" class="block !text-[#fff] hover:!bg-[#0e6d62] p-2">Đánh giá</a></li>
            @endif
        </li>
        <li>
             @if (request()->routeIs('member.profile.comments'))
                <a href="javascript:void(0)" title="Bình luận" class="block !text-[#fff] hover:!bg-[#0e6d62] p-2 bg-[#0e6d62]">Bình luận</a></li>
            @else
                <a href="{{ route('member.profile.comments', ['user_id' => $user['id']]) }}" title="Bình luận" class="block !text-[#fff] hover:!bg-[#0e6d62] p-2">Bình luận</a></li>
            @endif
        </li>
    </ul>
</div>
