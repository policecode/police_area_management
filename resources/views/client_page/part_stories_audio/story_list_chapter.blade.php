<div id="app_list_chapter_story_chapers">
    {{-- Nút kích hoạt player nhanh --}}
    <div class="flex flex-wrap items-center gap-3 mb-4 px-2">
        <button id="fvnBtnPreview" onclick="fvnShowPlayerPreview()"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-full font-bold text-white text-[0.875rem] transition-all duration-200 hover:scale-105 active:scale-95"
            style="background: linear-gradient(135deg, #1db954, #17a349); box-shadow: 0 4px 16px rgba(29,185,84,0.4);">
            <i class="fa-solid fa-headphones text-[1rem]"></i>
            Nghe truyện
        </button>
        <span class="text-[0.75rem] text-[#888]">
            <i class="fa-solid fa-circle-info mr-1"></i>
            Bấm vào từng chương để nghe, hoặc bấm nút trên để xem giao diện
        </span>
    </div>
    {{-- =================== AUDIO PLAYER BAR (Vue 2) =================== --}}
    <div id="fvnPlayerBar"
         role="region"
         aria-label="Trình phát audio"
         v-bind:class="{
             'ap-show':    ap_isVisible,
             'ap-playing': ap_isPlaying && !ap_isLoading,
             'ap-loading': ap_isLoading
         }">

        {{-- Seek bar --}}
        <div class="ap-seek-wrap" ref="ap_seekTrack" v-on:click="ap_onSeekTrackClick">
            <div class="ap-seek-buf"  v-bind:style="ap_bufferStyle"></div>
            <div class="ap-seek-fill" v-bind:style="ap_seekFillStyle"></div>
            <div class="ap-seek-thumb" v-bind:style="ap_seekThumbStyle"></div>
            <input type="range" class="ap-seek-input"
                   min="0" max="100" step="0.1"
                   v-bind:value="ap_seekPct"
                   v-on:input="ap_onSeekInput"
                   v-on:change="ap_onSeekChange"
                   aria-label="Thanh tiến trình">
        </div>

        <div class="ap-body">

            {{-- ===== HÀNG 1: Thumbnail + Info + Nút Close ===== --}}
            <div class="ap-row-info">
                <div class="ap-info">
                    <div class="ap-thumb-wrap">
                        <img v-bind:src="thumbnail" alt="Ảnh truyện" class="ap-thumb">
                        <div class="ap-thumb-ring"></div>
                    </div>
                    <div class="ap-text">
                        <p class="ap-story">@{{ ap_storyName }}</p>
                        <p class="ap-chapter">@{{ ap_chapterName }}</p>
                    </div>
                </div>

                <button class="ap-close" title="Đóng" aria-label="Đóng player"
                        v-on:click="ap_closePlayer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            {{-- ===== HÀNG 2: Toàn bộ Controls ===== --}}
            <div class="ap-row-controls">

                {{-- Tua lại 15s --}}
                <button class="ap-btn ap-btn-sec" title="Tua lại 15 giây" aria-label="Tua lại 15 giây"
                        v-on:click="ap_rewind">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span class="ap-btn-label">15s</span>
                </button>

                {{-- Play / Pause --}}
                <button class="ap-btn ap-btn-play" title="Phát / Tạm dừng"
                        v-bind:aria-label="ap_isPlaying ? 'Tạm dừng' : 'Phát'"
                        v-on:click="ap_togglePlay">
                    <i v-bind:class="ap_playIconClass"></i>
                </button>

                {{-- Tua nhanh 15s --}}
                <button class="ap-btn ap-btn-sec" title="Tua nhanh 15 giây" aria-label="Tua nhanh 15 giây"
                        v-on:click="ap_forward">
                    <i class="fa-solid fa-rotate-right"></i>
                    <span class="ap-btn-label">15s</span>
                </button>

                {{-- Thời gian --}}
                <div class="ap-time">
                    <span>@{{ ap_curTime }}</span>
                    <span class="ap-time-sep">/</span>
                    <span>@{{ ap_duration }}</span>
                </div>

                {{-- Tốc độ phát --}}
                <div class="ap-speed-wrap" ref="ap_speedWrap">
                    <button class="ap-speed-btn" title="Tốc độ phát"
                            v-on:click.stop="ap_toggleSpeedMenu">
                        <span>@{{ ap_speedLabel }}</span>
                    </button>
                    <div class="ap-speed-menu" role="menu"
                         v-bind:class="{ 'ap-open': ap_speedOpen }">
                        <button v-for="spd in ap_speeds" v-bind:key="spd"
                                class="ap-speed-opt" role="menuitem"
                                v-bind:class="{ 'ap-active': ap_speed === spd }"
                                v-on:click="ap_setSpeed(spd)">
                            @{{ spd === 1 ? '1x' : spd + 'x' }}
                        </button>
                    </div>
                </div>

                {{-- Âm lượng --}}
                <div class="ap-vol-wrap">
                    <button class="ap-vol-icon" title="Tắt/Bật tiếng"
                            v-on:click="ap_toggleMute">
                        <i v-bind:class="ap_volIconClass"></i>
                    </button>
                    <input type="range" class="ap-vol-slider"
                           min="0" max="1" step="0.05"
                           v-bind:value="ap_isMuted ? 0 : ap_volume"
                           v-bind:style="ap_volSliderStyle"
                           v-on:input="ap_onVolumeInput"
                           aria-label="Âm lượng">
                </div>

                {{-- Tự động chuyển chương --}}
                <button class="ap-btn ap-btn-autonext"
                        v-bind:class="{ 'ap-autonext-on': ap_autoNext }"
                        v-bind:title="ap_autoNextTitle"
                        aria-label="Tự động chuyển chương"
                        v-on:click="ap_toggleAutoNext">
                    <i class="fa-solid fa-forward-step"></i>
                </button>

            </div>{{-- end ap-row-controls --}}

        </div>{{-- end ap-body --}}
    </div>{{-- end fvnPlayerBar --}}

    
    {{-- ========================================================
         DANH SÁCH AUDIO — 2 TRẠNG THÁI (CSS Demo)
         - Chương lẻ  → has-audio  (có link, nút Play)
         - Chương chẵn → no-audio (chưa có, nút Tạo Audio)
    ======================================================== --}}
    <div class="fvn-audio-list">
        <div class="fvn-audio-list__header">
            <h2 class="fvn-audio-list__title">
                <span class="icon-sound"><i class="fa-solid fa-music"></i></span>
                Danh sách audio
            </h2>
            <span class="fvn-audio-list__badge">
                <i class="fa-solid fa-headphones mr-1"></i>
                {{ count($chapters) }} chương
            </span>
        </div>

        <ul
            style="margin:0; padding:0; list-style:none; max-height:420px; overflow-y:auto; scrollbar-width:thin; scrollbar-color:#1db954 #f0f0f0;">
            @foreach ($chapters as $index => $item)
                @php
                    /*
                     * DEMO CSS — 3 TRẠNG THÁI:
                     * index % 3 === 0 → CÓ AUDIO    (nút Play)
                     * index % 3 === 1 → ĐANG TẠO    (progress bar + spinner)
                     * index % 3 === 2 → CHƯA CÓ     (nút Tạo Audio)
                     * Khi có DB thực, thay bằng logic kiểm tra $item['audio_url'] và $item['is_generating']
                     */
                    $mod = $index % 3;
                    $hasAudio = $mod === 0;
                    $isGenerating = $mod === 1;
                    $noAudio = $mod === 2;
                @endphp

                <li class="fvn-aud-row
                            {{ $hasAudio ? 'has-audio fvn-chapter-row' : '' }}
                            {{ $isGenerating ? 'generating' : '' }}
                            {{ $noAudio ? 'no-audio' : '' }}
                            {{ $index === 0 ? 'fvn-playing' : '' }}"
                    @if ($hasAudio) data-audio-url="{{ $item['audio_url'] ?? '#demo' }}"
                        data-chapter-slug="{{ $item['slug'] }}"
                        data-chapter-name="{{ $item['name'] }}"
                        data-thumbnail="{{ $story['thumbnail'] }}"
                        title="Nghe: {{ $item['name'] }}"
                        style="cursor:pointer;"
                    @elseif($isGenerating)
                        title="Đang tạo audio cho chương này..."
                    @else
                        title="Chưa có audio — Bấm Tạo Audio để tạo" @endif>
                    {{-- Số thứ tự --}}
                    <span class="fvn-aud-num">{{ $index + 1 }}</span>

                    {{-- Icon tai nghe / Equalizer / Spinner --}}
                    <div class="fvn-aud-eq">
                        @if ($hasAudio)
                            <span class="fvn-eq-static">
                                <i class="fa-solid fa-headphones" style="color:#1db954; font-size:15px;"></i>
                            </span>
                            <div class="fvn-eq-bars">
                                <div class="fvn-eq-b"></div>
                                <div class="fvn-eq-b"></div>
                                <div class="fvn-eq-b"></div>
                                <div class="fvn-eq-b"></div>
                            </div>
                        @elseif($isGenerating)
                            {{-- Spinner xoay tím khi đang tạo --}}
                            <i class="fa-solid fa-compact-disc" style="color:#6366f1; font-size:15px;"></i>
                        @else
                            <i class="fa-solid fa-microphone-slash" style="color:#ddd; font-size:14px;"></i>
                        @endif
                    </div>

                    {{-- Thông tin chương --}}
                    <div class="fvn-aud-info">
                        <p class="fvn-aud-name">
                            @if ($item['money'] > 0 && empty($item['unlocked_content']))
                                <i class="fa-solid fa-lock"
                                    style="color:#d31f1f; font-size:10px; margin-right:4px;"></i>
                            @endif
                            @if ($item['money'] > 0 && !empty($item['unlocked_content']))
                                <i class="fa-solid fa-lock-open"
                                    style="color:#28a745; font-size:10px; margin-right:4px;"></i>
                            @endif
                            {{ ucwords($item['name']) }}
                        </p>

                        {{-- Progress bar chạy ngang khi đang tạo --}}
                        @if ($isGenerating)
                            <div class="fvn-gen-progress">
                                <div class="fvn-gen-progress__bar"></div>
                            </div>
                        @endif

                        <div class="fvn-aud-meta">
                            @if ($hasAudio)
                                <span class="fvn-aud-tag tag-has">
                                    <i class="fa-solid fa-circle-check"></i> Có audio
                                </span>
                            @elseif($isGenerating)
                                <span class="fvn-aud-tag tag-gen">
                                    <i class="fa-solid fa-circle-notch"
                                        style="animation:spin 1s linear infinite;"></i>
                                    Đang tạo...
                                </span>
                            @else
                                <span class="fvn-aud-tag tag-none">
                                    <i class="fa-solid fa-clock"></i> Chờ tạo
                                </span>
                            @endif
                            <span>{{ get_string_after_time($item['after_minutes']) }}</span>
                        </div>
                    </div>

                    {{-- Khu vực Action --}}
                    <div class="fvn-aud-actions">
                        @if ($hasAudio)
                            {{-- BADGE "Đang nghe" (chỉ hiện khi fvn-playing) --}}
                            <span class="fvn-now-playing-badge">
                                <i class="fa-solid fa-music"></i> Đang nghe
                            </span>

                            {{-- TRẠNG THÁI 1: CÓ AUDIO → Nút Play/Pause --}}
                            <span class="fvn-aud-time">3:42</span>
                            <button class="fvn-btn-play" title="Phát audio" aria-label="Nghe {{ $item['name'] }}"
                                onclick="event.stopPropagation()">
                                <span class="fvn-icon-play" style="margin-left:2px;">
                                    <i class="fa-solid fa-play"></i>
                                </span>
                                <span class="fvn-icon-pause">
                                    <i class="fa-solid fa-pause"></i>
                                </span>
                            </button>
                        @elseif($isGenerating)
                            {{-- TRẠNG THÁI 2: ĐANG TẠO → Label + Nút Hủy --}}
                            <span class="fvn-gen-label">Đang xử lý...</span>
                            <button class="fvn-btn-cancel" title="Hủy tạo audio"
                                aria-label="Hủy tạo audio {{ $item['name'] }}" data-chapter-id="{{ $item['id'] }}"
                                onclick="event.stopPropagation()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        @else
                            {{-- TRẠNG THÁI 3: CHƯA CÓ AUDIO → Nút Tạo Audio --}}
                            <span class="fvn-aud-pending">Chưa có</span>
                            <button class="fvn-btn-generate" title="Tạo audio AI cho chương này"
                                aria-label="Tạo audio {{ $item['name'] }}" data-chapter-id="{{ $item['id'] }}"
                                onclick="event.stopPropagation()">
                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                                <span>Tạo Audio</span>
                            </button>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    /* ================================================================
     * DATA dùng chung cho Vue instance
     * - vue_story_list_chapter_app : dữ liệu danh sách chương (cũ)
     * - ap_* prefix               : dữ liệu Audio Player (mới)
     * ================================================================ */
    var vue_story_list_chapter_app = {
        /* --- Danh sách chương (giữ nguyên) --- */
        loading: false,
        showDesc: false,
        show_box: 'introduce',
        user: {{ Illuminate\Support\Js::from($user) }},
        avatar_default: '{{ asset('assets/images/avatar_default.png') }}',
        items: [],
        querySearch: {
            total: 0,
            page: 1,
            per_page: 50,
            story_id: {{ $story['id'] }},
            order_by: 'position',
            order_type: 'ASC'
        },
        itemDetail: {{ Illuminate\Support\Js::from($story) }},
        apiUrl: FVN_LARAVEL_HOME + '/story',

        /* ============================================================
         * AUDIO PLAYER DATA
         * ============================================================ */
        /* Đối tượng Audio (không reactive — đặt ngoài data để tránh overhead) */
        _audio:        null,
        _saveTimer:    null,
        _activeRowEl:  null,

        /* Hằng số từ Blade */
        ap_lsKey:      'fvn_audio_v1',
        ap_storySlug:  '{{ $story['slug'] }}',
        ap_storyName:  '{{ addslashes($story['title']) }}',
        ap_thumbnail:  '{{ $story['thumbnail'] }}',

        /* Thông tin chương đang phát */
        ap_chapterSlug: '',
        ap_chapterName: 'Chọn một chương để bắt đầu nghe',

        /* Trạng thái phát */
        ap_isPlaying:  false,
        ap_isLoading:  false,
        ap_isVisible:  false,

        /* Seek bar */
        ap_seekPct:    0,
        ap_bufferPct:  0,
        ap_isDragging: false,
        ap_curTime:    '0:00',
        ap_duration:   '0:00',

        /* Tốc độ phát */
        ap_speed:      1,
        ap_speedOpen:  false,
        ap_speeds:     [0.75, 1, 1.25, 1.5, 1.75, 2],

        /* Âm lượng */
        ap_volume:     1,
        ap_isMuted:    false,

        /* Tự động chuyển chương */
        ap_autoNext:   true,
    };

    var appListChapterStory = new Vue({
        el: '#app_list_chapter_story_chapers',
        data: vue_story_list_chapter_app,

        /* ============================================================
         * COMPUTED — Audio Player
         * ============================================================ */
        computed: {
            /* Icon play / pause / loading */
            ap_playIconClass: function () {
                if (this.ap_isLoading) return 'fa-solid fa-circle-notch fa-spin';
                return this.ap_isPlaying ? 'fa-solid fa-pause' : 'fa-solid fa-play';
            },
            /* Icon âm lượng */
            ap_volIconClass: function () {
                if (this.ap_isMuted || this.ap_volume === 0) return 'fa-solid fa-volume-xmark';
                if (this.ap_volume < 0.5)                   return 'fa-solid fa-volume-low';
                return 'fa-solid fa-volume-high';
            },
            /* Style seek bar */
            ap_seekFillStyle:  function () { return { width: this.ap_seekPct + '%' }; },
            ap_seekThumbStyle: function () { return { left:  this.ap_seekPct + '%' }; },
            ap_bufferStyle:    function () { return { width: this.ap_bufferPct + '%' }; },
            /* Style slider âm lượng */
            ap_volSliderStyle: function () {
                var pct = this.ap_isMuted ? 0 : this.ap_volume * 100;
                return { background: 'linear-gradient(90deg, var(--ap-accent) ' + pct + '%, rgba(255,255,255,0.2) ' + pct + '%)' };
            },
            /* Nhãn tốc độ */
            ap_speedLabel: function () {
                return this.ap_speed === 1 ? '1x' : this.ap_speed + 'x';
            },
            /* Tooltip nút auto-next */
            ap_autoNextTitle: function () {
                return 'Tự động chuyển chương: ' + (this.ap_autoNext ? 'BẬT' : 'TẮT');
            },
        },

        /* ============================================================
         * MOUNTED
         * ============================================================ */
        mounted: function () {
            var vm = this;

            /* --- Click hàng chương (event delegation) --- */
            document.addEventListener('click', function (e) {
                if (e.target.closest('a[href]:not([href="javascript:void(0)"])') &&
                    !e.target.closest('.fvn-ch-play-btn')) return;

                var row = e.target.closest('.fvn-aud-row.has-audio');
                if (!row) return;

                var audioUrl    = row.getAttribute('data-audio-url') || '';
                var chapterSlug = row.getAttribute('data-chapter-slug') || '';
                var chapterName = row.getAttribute('data-chapter-name') || '';
                var thumbnail   = row.getAttribute('data-thumbnail') || '';

                if (!audioUrl || audioUrl === 'null' || audioUrl === '#demo') {
                    if (typeof jAlertCLient === 'function')
                        jAlertCLient('Chương này chưa có audio. Vui lòng thử chương khác!', 'danger');
                    return;
                }

                if (vm._activeRowEl === row && vm._audio) { vm.ap_togglePlay(); return; }
                vm.ap_loadAndPlay({ audioUrl: audioUrl, chapterSlug: chapterSlug, chapterName: chapterName, thumbnail: thumbnail, rowEl: row });
            });

            /* --- Đóng speed menu khi click ra ngoài --- */
            document.addEventListener('click', function (e) {
                if (vm.$refs.ap_speedWrap && !vm.$refs.ap_speedWrap.contains(e.target))
                    vm.ap_speedOpen = false;
            });

            /* --- Keyboard shortcuts --- */
            document.addEventListener('keydown', function (e) {
                if (['INPUT', 'TEXTAREA', 'SELECT'].includes(e.target.tagName)) return;
                if (!vm.ap_isVisible) return;
                if (e.code === 'Space')      { e.preventDefault(); vm.ap_togglePlay(); }
                if (e.code === 'ArrowLeft')  { e.preventDefault(); vm.ap_rewind(); }
                if (e.code === 'ArrowRight') { e.preventDefault(); vm.ap_forward(); }
            });

            /* --- Lưu khi rời trang --- */
            window.addEventListener('beforeunload', function () { vm.ap_lsSave(); });
            window.addEventListener('pagehide',     function () { vm.ap_lsSave(); });

            /* --- Public API --- */
            window.FvnPlayer = {
                play:    function (cfg) { vm.ap_loadAndPlay(cfg); },
                preview: function (u, s, n) { vm.ap_showPreview(u, s, n); },
                pause:   function () { if (vm._audio) vm._audio.pause(); },
                resume:  function () { if (vm._audio) vm._audio.play(); },
            };
            window.fvnShowPlayerPreview = function (url, slug, name) {
                vm.ap_showPreview(url || 'https://audio.hachoangdaide.online/audio-stories/cau-tai-vo-dao-the-gioi-thanh-thanh/chuong-01-loan-the.mp3', slug, name);
            };
        },

        /* ============================================================
         * METHODS
         * ============================================================ */
        methods: {

            /* --- Danh sách chương (giữ nguyên) --- */
            getStringAfterTime: function (after_minutes) {
                if (after_minutes < 60) return after_minutes + ' phút trước';
                else if (after_minutes < 60 * 24) return Math.floor(after_minutes / 60) + ' giờ trước';
                else if (after_minutes < 60 * 24 * 30) return Math.floor(after_minutes / (60 * 24)) + ' ngày trước';
                else if (after_minutes < 60 * 24 * 30 * 365) return Math.floor(after_minutes / (60 * 24 * 30)) + ' tháng trước';
                else return Math.floor(after_minutes / (60 * 24 * 30 * 365)) + ' năm trước';
            },

            /* ========================================================
             * AUDIO PLAYER METHODS
             * ======================================================== */

            /* --- Helpers --- */
            ap_fmt: function (s) {
                if (!s || isNaN(s) || !isFinite(s)) return '0:00';
                s = Math.floor(s);
                return Math.floor(s / 60) + ':' + (s % 60 < 10 ? '0' : '') + (s % 60);
            },
            ap_lsSave: function () {
                if (!this._audio || !this.ap_storySlug || !this.ap_chapterSlug) return;
                var k = this.ap_lsKey + '_' + this.ap_storySlug + '_' + this.ap_chapterSlug;
                try { localStorage.setItem(k, JSON.stringify({ t: this._audio.currentTime, at: Date.now() })); } catch (e) {}
            },
            ap_lsLoad: function (chapterSlug) {
                var k = this.ap_lsKey + '_' + this.ap_storySlug + '_' + chapterSlug;
                try {
                    var d = JSON.parse(localStorage.getItem(k));
                    if (d && Date.now() - d.at < 30 * 24 * 3600 * 1000) return d.t || 0;
                } catch (e) {}
                return 0;
            },
            ap_showBar: function () { this.ap_isVisible = true;  document.body.classList.add('has-ap'); },
            ap_hideBar: function () { this.ap_isVisible = false; document.body.classList.remove('has-ap'); },

            /* --- Active Row --- */
            ap_setActiveRow: function (rowEl) {
                if (this._activeRowEl) this._activeRowEl.classList.remove('fvn-playing');
                this._activeRowEl = rowEl;
                if (!rowEl) return;
                rowEl.classList.add('fvn-playing');
                setTimeout(function () {
                    var list = rowEl.closest('ul');
                    if (list && list.scrollHeight > list.clientHeight) {
                        list.scrollTo({ top: rowEl.offsetTop - list.clientHeight / 2 + rowEl.offsetHeight / 2, behavior: 'smooth' });
                    } else {
                        rowEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                }, 150);
            },

            /* --- Seek --- */
            ap_updateSeek: function () {
                if (!this._audio || !this._audio.duration || this.ap_isDragging) return;
                var pct = (this._audio.currentTime / this._audio.duration) * 100;
                this.ap_seekPct = pct;
                this.ap_curTime = this.ap_fmt(this._audio.currentTime);
            },
            ap_updateBuffer: function () {
                if (!this._audio || !this._audio.duration) return;
                var buf = this._audio.buffered;
                if (buf.length > 0) this.ap_bufferPct = (buf.end(buf.length - 1) / this._audio.duration) * 100;
            },

            /* --- CORE: Load & Play --- */
            ap_loadAndPlay: function (cfg) {
                var vm = this;
                if (this._audio && this.ap_chapterSlug) this.ap_lsSave();
                if (this._audio) { this._audio.pause(); this._audio.src = ''; }
                clearInterval(this._saveTimer);

                this.ap_chapterSlug = cfg.chapterSlug || '';
                this.ap_chapterName = cfg.chapterName || '—';
                if (cfg.thumbnail) this.ap_thumbnail = cfg.thumbnail;

                this.ap_seekPct = 0; this.ap_bufferPct = 0;
                this.ap_curTime = '0:00'; this.ap_duration = '0:00';
                this.ap_isPlaying = false;
                this.ap_setActiveRow(cfg.rowEl || null);
                this.ap_showBar();
                this.ap_isLoading = true;

                var audio = new Audio(cfg.audioUrl);
                this._audio = audio;
                audio.volume = this.ap_volume;
                audio.muted = this.ap_isMuted;
                audio.playbackRate = this.ap_speed;

                audio.addEventListener('loadedmetadata', function () {
                    vm.ap_duration = vm.ap_fmt(audio.duration);
                    var saved = vm.ap_lsLoad(vm.ap_chapterSlug);
                    if (saved > 5 && saved < audio.duration - 5) {
                        audio.currentTime = saved;
                        if (typeof jAlertCLient === 'function') jAlertCLient('Tiếp tục từ ' + vm.ap_fmt(saved), 'success');
                    }
                });
                audio.addEventListener('canplay', function () {
                    vm.ap_isLoading = false; vm.ap_isPlaying = true;
                    audio.play().catch(function () { vm.ap_isPlaying = false; });
                });
                audio.addEventListener('timeupdate', function () { vm.ap_updateSeek(); });
                audio.addEventListener('progress',   function () { vm.ap_updateBuffer(); });
                audio.addEventListener('play',    function () { vm.ap_isPlaying = true;  vm.ap_isLoading = false; });
                audio.addEventListener('pause',   function () { vm.ap_isPlaying = false; vm.ap_lsSave(); });
                audio.addEventListener('waiting', function () { vm.ap_isLoading = true; });
                audio.addEventListener('playing', function () { vm.ap_isLoading = false; });
                audio.addEventListener('ended',   function () { vm.ap_lsSave(); vm.ap_onEnded(); });
                audio.addEventListener('error',   function () {
                    vm.ap_isLoading = false;
                    if (typeof jAlertCLient === 'function') jAlertCLient('Chương này chưa có audio hoặc không thể phát.', 'danger');
                });
                this._saveTimer = setInterval(function () { if (vm.ap_isPlaying) vm.ap_lsSave(); }, 10000);
            },

            /* --- Auto-Next --- */
            ap_onEnded: function () {
                if (!this.ap_autoNext || !this._activeRowEl) return;
                var rows = Array.from(document.querySelectorAll('.fvn-aud-row.has-audio[data-audio-url]'));
                var idx = rows.indexOf(this._activeRowEl);
                var vm = this;
                if (idx !== -1 && rows[idx + 1]) {
                    setTimeout(function () { rows[idx + 1].click(); }, 600);
                } else if (idx !== -1) {
                    if (typeof jAlertCLient === 'function') jAlertCLient('Đã phát hết tất cả các chương!', 'success');
                }
            },

            /* --- Controls --- */
            ap_togglePlay: function () { if (!this._audio) return; this.ap_isPlaying ? this._audio.pause() : this._audio.play(); },
            ap_rewind:     function () { if (this._audio) this._audio.currentTime = Math.max(0, this._audio.currentTime - 15); },
            ap_forward:    function () { if (this._audio) this._audio.currentTime = Math.min(this._audio.duration || 0, this._audio.currentTime + 15); },

            /* --- Seek events --- */
            ap_onSeekInput: function (e) {
                this.ap_isDragging = true;
                var pct = parseFloat(e.target.value);
                this.ap_seekPct = pct;
                if (this._audio && this._audio.duration) this.ap_curTime = this.ap_fmt((pct / 100) * this._audio.duration);
            },
            ap_onSeekChange: function (e) {
                this.ap_isDragging = false;
                if (this._audio && this._audio.duration) this._audio.currentTime = (parseFloat(e.target.value) / 100) * this._audio.duration;
            },
            ap_onSeekTrackClick: function (e) {
                if (e.target.tagName === 'INPUT') return;
                if (!this._audio || !this._audio.duration) return;
                var rect = this.$refs.ap_seekTrack.getBoundingClientRect();
                var pct = Math.max(0, Math.min(100, (e.clientX - rect.left) / rect.width * 100));
                this._audio.currentTime = (pct / 100) * this._audio.duration;
            },

            /* --- Speed --- */
            ap_toggleSpeedMenu: function () { this.ap_speedOpen = !this.ap_speedOpen; },
            ap_setSpeed: function (spd) {
                this.ap_speed = spd; this.ap_speedOpen = false;
                if (this._audio) this._audio.playbackRate = spd;
            },

            /* --- Volume --- */
            ap_onVolumeInput: function (e) {
                var v = parseFloat(e.target.value);
                this.ap_volume = v; this.ap_isMuted = (v === 0);
                if (this._audio) { this._audio.volume = v; this._audio.muted = (v === 0); }
            },
            ap_toggleMute: function () {
                this.ap_isMuted = !this.ap_isMuted;
                if (this._audio) this._audio.muted = this.ap_isMuted;
            },

            /* --- Auto-Next toggle --- */
            ap_toggleAutoNext: function () { this.ap_autoNext = !this.ap_autoNext; },

            /* --- Close --- */
            ap_closePlayer: function () {
                if (this._audio) { this._audio.pause(); this.ap_lsSave(); }
                this.ap_setActiveRow(null);
                this.ap_hideBar();
                this.ap_isPlaying = false;
                this.ap_chapterName = 'Chọn một chương để bắt đầu nghe';
            },

            /* --- Preview --- */
            ap_showPreview: function (audioUrl, chapterSlug, chapterName) {
                if (audioUrl) {
                    this.ap_loadAndPlay({ audioUrl: audioUrl, chapterSlug: chapterSlug || 'preview', chapterName: chapterName || 'Xem trước giao diện', thumbnail: this.ap_thumbnail, rowEl: null });
                    return;
                }
                this.ap_chapterName = 'Chọn một chương để bắt đầu nghe';
                this.ap_showBar();
            },
        },
    });
</script>

