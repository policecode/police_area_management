<?php
$categories = get_all_categories();
?>
<div class="fixed top-0 modal-story-genre right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-white duration-500 md:inset-0 invisible pointer-events-none opacity-0"
    modal-rs="modal_cate">
    <span class="btn-close-genre close-modal items-center justify-center cursor-pointer absolute top-2 right-2 z-[1]"
        modal-rs-close>
        <i class="fa-solid fa-xmark"></i>
    </span>
    <div class="w-full h-full overflow-auto">
        <ul class="flex flex-wrap">
            @foreach ($categories as $item)
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="{{ route('client.tag', ['tag_slug' => $item['slug']]) }}" title="{{ $item['name'] }}c" class="block p-2">{{ $item['name'] }}</a>
                </li>
            @endforeach

        </ul>
    </div>
</div>
