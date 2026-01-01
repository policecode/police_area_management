<div class="banner relative flex justify-center md:justify-start items-end h-[250px] bg-no-repeat bg-center bg-cover mb-20 md:mb-0"
    style="background-image:url({{ $user['banner_url'] }});">
    <div class="translate-y-[90px] md:translate-y-[20px]">
        <div class="profile flex flex-col md:flex-row items-center relative md:ml-5 w-fit">
            <span
                class="avatar mr-2 img_full img-h-full rounded-full overflow-hidden w-[140px] h-[140px] shadow-[0_1px_2px_rgba(0,0,0,.1)] border-[5px] border-[#fff]">
                <picture>

                    <img loading="lazy" src="{{$user['avatar_url']}}" alt="{{$user['avatar_url']}}" class="img-fluid">
                </picture>
            </span>
            <div class="content text-center md:text-left">
                <p class="name lg:text-[1.5rem] text-[1.25rem] text-[#128c7e] font-bold">{{$user['name']}}</p>
                <p class="role text-[0.75rem] text-[#128c7e] font-bold">{{$user['group']['name']}}</p>
            </div>
        </div>
    </div>
</div>
