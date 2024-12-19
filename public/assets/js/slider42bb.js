var SLIDER = {
    slideMainCate: function() {
        if (typeof Tech.$('.slide-cate__thumbs') === 'undefined') return;

        const swiperBanner = new Swiper('.slide-cate__thumbs', {
            spaceBetween: 0,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });

        if (typeof Tech.$('.slide-cate__main') === 'undefined') return;

        const swiperBanner1 = new Swiper('.slide-cate__main', {
            slidesPerView: 1,
            speed: 600,
            spaceBetween: 16,
            effect: "fade",
            thumbs: {
                swiper: swiperBanner,
            },
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    },
    slideLib: function() {
        var slide = Tech.$('.slide-room__small');
        var btnPrev = Tech.$('.swiper-lib__prev');
        var btnNext = Tech.$('.swiper-lib__next');

        if (typeof Tech.$('.slide-room__small') === 'undefined') return;

        if (slide._element.length > 1) {
            for (i = 0; i < slide._element.length; i++) {
                slide._element[i].addClass('slide-room__small-' + i);
                btnPrev._element[i].addClass('swiper-lib__prev-' + i);
                btnNext._element[i].addClass('swiper-lib__next-' + i);
                const swiperBanner = new Swiper('.slide-room__small-' + i, {
                    slidesPerView: 2.5,
                    disableOnInteraction: true,
                    speed: 600,
                    spaceBetween: 8,
                    watchSlidesProgress: true,
                    navigation: {
                        nextEl: ".swiper-lib__next-" + i,
                        prevEl: ".swiper-lib__prev-" + i,
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 3.5,
                            spaceBetween: 8
                        },
                        768: {
                            slidesPerView: 3.5,
                            spaceBetween: 8
                        },
                        991: {
                            slidesPerView: 4.5,
                            spaceBetween: 8
                        },
                        1023: {
                            slidesPerView: 4.5,
                            spaceBetween: 12,
                        },
                    }
                });
            }
        } else {
            const swiperBanner = new Swiper('.slide-room__small', {
                slidesPerView: 2.5,
                disableOnInteraction: true,
                speed: 600,
                spaceBetween: 8,
                watchSlidesProgress: true,
                navigation: {
                    nextEl: ".swiper-lib__next",
                    prevEl: ".swiper-lib__prev",
                },
                breakpoints: {
                    576: {
                        slidesPerView: 3.5,
                        spaceBetween: 8
                    },
                    768: {
                        slidesPerView: 3.5,
                        spaceBetween: 8
                    },
                    991: {
                        slidesPerView: 4.5,
                        spaceBetween: 8
                    },
                    1023: {
                        slidesPerView: 4.5,
                        spaceBetween: 12,
                    },
                }
            });
        }
    },
    slideCateIndex: function() {
        const swiperBanner = new Swiper('.slide-cate', {
            slidesPerView: 3,
            disableOnInteraction: true,
            speed: 600,
            spaceBetween: 8,
            watchSlidesProgress: true,
            navigation: {
                nextEl: ".cate-next",
                prevEl: ".cate-prev",
            },
            breakpoints: {
                576: {
                    slidesPerView: 3,
                    spaceBetween: 8
                },
                767: {
                    slidesPerView: 3,
                    spaceBetween: 8
                },
                991: {
                    slidesPerView: 6,
                    spaceBetween: 8
                },
                1023: {
                    slidesPerView: 8,
                    spaceBetween: 12,
                },
            }
        });
    },
    slideStoryRelated: function() {
        const swiperBanner = new Swiper('.slide-story__related', {
            slidesPerView: 3,
            disableOnInteraction: true,
            speed: 600,
            spaceBetween: 8,
            watchSlidesProgress: true,
            navigation: {
                nextEl: ".related-next",
                prevEl: ".related-prev",
            },
            breakpoints: {
                576: {
                    slidesPerView: 3,
                    spaceBetween: 8
                },
                767: {
                    slidesPerView: 3,
                    spaceBetween: 8
                },
                991: {
                    slidesPerView: 5,
                    spaceBetween: 8
                },
                1023: {
                    slidesPerView: 5,
                    spaceBetween: 12,
                },
            }
        });
    },
    init: function() {
        SLIDER.slideMainCate();
        SLIDER.slideCateIndex();
        SLIDER.slideStoryRelated();
    },
}

Tech.Query.ready(function() {
    setTimeout(function() {
        SLIDER.init();
    }, 100);
});
