document.addEventListener('DOMContentLoaded', function () {
    // ローディング画面
    if (document.body.id === "home") {
        function loadedPage() {
            const homeMvMainTitle = document.querySelector(".home-mv__main--title");
            const homeMvSubTitle = document.querySelector(".home-mv__sub--title");
            const homeMvEmblem = document.querySelector(".home-mv__emblem");
            const mainVideo = document.querySelector(".home-mv__wrapper--video video");
            const loading = document.querySelector(".loading");

            loading.classList.add("is-loaded");
            homeMvMainTitle.classList.add("opening");
            homeMvSubTitle.classList.add("opening");
            homeMvEmblem.classList.add("opening");
            mainVideo.classList.add("opening");
            mainVideo.play();
        }
        if (!sessionStorage.getItem('visited')) {
            sessionStorage.setItem('visited', 'first');
            window.addEventListener('load', function () {
                setTimeout(loadedPage, 1500);
            });
            setTimeout(loadedPage, 3000);
        } else {
            loadedPage();
        }
    }
    // ----------------------------------------------------------------
    //header PC部分
    if (!["shop", "shop_detail", "inquiry", "post", "announcements", "unknown", "php_mail"].includes(document.body.id)) {
        if (window.innerWidth >= 576) {
            const headerElm = document.querySelector("header");
            const headerLogo = document.querySelector(".header__logo");
            const headerNavi = document.querySelector(".header__navi");
            const headerNaviText = document.querySelectorAll(".header__navi>ul li a");
            const hoverUl = document.querySelector(".header__navi .hover-ul");
            const languageSelectedBox = document.querySelector(".language-select-box");
            const logoImg = document.querySelector(".logo-img");
            const logoSourceElement = document.querySelector('.logo-source');
            const sourceSrcset = logoSourceElement.getAttribute('srcset');
            // img要素のsrc属性のURLを取得
            const imgSrc = logoImg.getAttribute('src');

            function updateHeaderOnScroll() {
                const isScrolled = window.scrollY > 0 && window.scrollY < window.innerHeight;
                const isScrolledPastInitialHeight = window.innerHeight < window.scrollY;

                headerElm.classList.toggle("header-hide", isScrolled);

                if (isScrolledPastInitialHeight) {
                    logoImg.src = sourceSrcset;
                    headerElm.style.backgroundColor = "rgba(255, 255, 255, .9)";
                    headerLogo.style.color = "black";
                    headerNavi.classList.add("scroll-color");
                    hoverUl.style.backgroundColor = "rgba(255, 255, 255, .8)";
                    headerNaviText.forEach(text => text.style.color = "black");
                    languageSelectedBox.classList.add("text-black");
                } else {
                    logoImg.src = imgSrc;
                    headerElm.style.backgroundColor = "initial";
                    headerLogo.style.color = "white";
                    headerNavi.classList.remove("scroll-color");
                    hoverUl.style.backgroundColor = "rgba(77, 77, 77, .8)";
                    headerNaviText.forEach(text => text.style.color = "white");
                    languageSelectedBox.classList.remove("text-black")
                }
            }

            window.addEventListener("scroll", updateHeaderOnScroll);
        }
    }
    // -----------------------------------------------------------
    // メニューボタン開閉およびメニュー動作、スマホ言語ボタン開閉
    const menuBtn = document.querySelector(".menu__btn");
    const headerNavi = document.querySelector(".header__navi");
    const mainElm = document.querySelector("main");
    const footerElm = document.querySelector("footer");
    const logoSource = document.querySelector(".logo-source");
    const logoImg = document.querySelector(".logo-img");
    const sourceSrcset = logoSource.getAttribute('srcset');
    // img要素のsrc属性のURLを取得
    const imgSrc = logoImg.getAttribute('src');

    const languageSelectBox = document.querySelector(".language-select-box");

    menuBtn.addEventListener("click", function () {
        const isActive = this.classList.toggle("is-active");
        if (languageSelectBox && languageSelectBox.classList.contains("open")) {
            languageSelectBox.classList.remove("open");
        }
        // .is-activeクラスが追加されたかどうかで画像を切り替える
        const newSrc = isActive ? imgSrc : sourceSrcset;
        logoSource.setAttribute('srcset', newSrc);
        logoImg.src = newSrc;

        headerNavi.classList.toggle("is-opened");
        mainElm.classList.toggle("is-off");
        footerElm.classList.toggle("is-off");
    });
    // スマホ言語ボタン開閉
    if (window.innerWidth <= 1024) {
        languageSelectBox.addEventListener("click", function () {
            languageSelectBox.classList.toggle("open");
        })
    };
    //----------------------------------------------------------------
    // 出現アクション
    document.addEventListener('scroll', function handleScroll() {
        const fadeUpElms = document.querySelectorAll('.fade-up');

        fadeUpElms.forEach(fadeUpElm => {
            // 要素の上端がビューポートの高さの100ピクセル以上下にある場合、クラスを追加
            if (fadeUpElm.getBoundingClientRect().top + 100 < window.innerHeight) {
                fadeUpElm.classList.add('fade-up-in');
            }
        });
    });

    //-----------------------------------------------------------------------
    //トップスクロールボタン
    const scrollUp = document.querySelector(".scroll-up");
    const scrollUpSpan = document.querySelector(".scroll-up span");

    function handleScroll() {
        const scrollY = window.scrollY;
        const isBelowFold = window.innerHeight < scrollY;

        // スクロール位置に応じてクラスを追加または削除
        if (isBelowFold) {
            scrollUp.classList.add("scroll-up-on");
        } else {
            scrollUp.classList.remove("scroll-up-on");
        }

        // ページ先頭に戻ったときの処理
        if (scrollY === 0) {
            scrollUpSpan.classList.remove("scroll-action");
        }
    }

    // スクロールイベントのリスナーを追加
    window.addEventListener("scroll", handleScroll);

    // クリックイベントのリスナーを追加
    scrollUp.addEventListener("click", function () {
        scrollUpSpan.classList.add("scroll-action");
    });

    scrollUp.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    //------------------------------------------------------------------
    //home のみ適用
    //猫とスティッキーテキスト
    if (document.body.id === "home") {
        const welcomeWrapper = document.querySelector(".home-welcome__wrapper");
        const stickyText = document.querySelector(".sticky-text");
        const welcomeImage = document.querySelector(".home-welcome__image--inner");
        const welcomeSec = document.querySelector(".home-welcome__sec span");
        const subVisualWrapper = document.querySelector(".home-sv__wrapper");
        const subVisualWrapperSpan = document.querySelector(".home-sv__wrapper span");

        function handleScroll() {
            let elmDistance = subVisualWrapper.getBoundingClientRect().top;
            if (elmDistance + 500 < window.innerHeight) {
                subVisualWrapper.style.opacity = "1";
                subVisualWrapperSpan.classList.add("zoom-frame");
            } else {
                subVisualWrapper.style.opacity = "0";
            }

            let welcomeWrapperDis = welcomeWrapper.getBoundingClientRect().top;
            if (welcomeWrapperDis + 50 < window.innerHeight / 2) {
                stickyText.style.opacity = "1";
                welcomeSec.style.opacity = "1";
            } else {
                stickyText.style.opacity = ".3";
                welcomeSec.style.opacity = "0";
            }

            let disFromBottom = welcomeWrapperDis - window.innerHeight;
            if (disFromBottom < 0) {
                let scaleSize = -(disFromBottom / 500);
                if (scaleSize > 2) {
                    scaleSize = 2;
                }
                welcomeImage.style.transform = `scale(${scaleSize})`;
            }
        }

        window.addEventListener("scroll", handleScroll);

        //回転エンブレム部分---------------------------------------
        const Emblem = {
            init: function (selector, text) {
                const element = document.querySelector(selector);
                const originalText = text || element.textContent;
                element.innerHTML = '';

                originalText.split('').forEach((letter, index) => {
                    const span = document.createElement('span');
                    const rotationAngle = (360 / originalText.length) * index;
                    const translationX = Math.PI / originalText.length * index;
                    const translationY = Math.PI / originalText.length * index;

                    span.textContent = letter;
                    span.style.transform = `rotateZ(${rotationAngle}deg) translate3d(${translationX}px, ${translationY}px, 0)`;

                    element.appendChild(span);
                });
            }
        };

        Emblem.init('.home-mv__emblem > div');
        // -------------------------------------------------------
        // サクラ吹雪
        const blogSection = document.querySelector('.home-blog__sec');

        const createSakura = () => {
            const sakuraElm = document.createElement('span');
            sakuraElm.className = 'home-sakura';
            const minSize = 5;
            const maxSize = 12;
            const size = Math.random() * (maxSize + 1 - minSize) + minSize;
            sakuraElm.style.width = `${size}px`;
            sakuraElm.style.height = `${size}px`;
            const minDura = 20000;
            const maxDura = 30000;
            const duration = Math.random() * (maxDura + 1 - minDura) + minDura;
            const minDeg = 3000;
            const maxDeg = 5000;
            const degX = Math.random() * (maxDeg + 1 - minDeg) + minDeg;
            const degY = Math.random() * (maxDeg + 1 - minDeg) + minDeg;
            const degZ = Math.random() * (maxDeg + 1 - minDeg) + minDeg;

            let startPoint;
            let endPoint;

            if (window.innerWidth > 1024) {
                startPoint = (Math.random() * window.innerWidth / 2) - 100;
            } else {
                startPoint = (Math.random() * window.innerWidth * 0.8);
            }

            endPoint = startPoint + (Math.random() * window.innerWidth * 0.2) + "px";
            sakuraElm.style.right = `${startPoint}px`;

            sakuraElm.animate(
                [
                    { transform: `rotateZ(${degX}deg) rotateX(${degY}deg) rotateY(${degZ}deg)` },
                    { right: endPoint },
                    { top: "250%" },
                ],
                {
                    duration: duration,
                    easing: "linear",
                }
            );

            blogSection.appendChild(sakuraElm);

            // 一定時間が経てば桜を消す
            setTimeout(() => {
                sakuraElm.remove();
            }, 10000);
        }

        // 桜が発生する間隔をミリ秒で指定
        setInterval(createSakura, 250);

        // ---------------------------------------------------------
        //背景画像のスライドイン
        const introductionWrapper = document.querySelector(".home-introduction__back-image");
        window.addEventListener("scroll", function () {
            if (introductionWrapper.getBoundingClientRect().top + 200 < window.innerHeight) {
                introductionWrapper.classList.add("slide-in");
            }
        })

        // home スライダー部分--------------------------------------
        const indexSlider = new Swiper(".home-slider", {
            loop: true,
            slidesPerView: 3,
            speed: 3000,
            allowTouchMove: false,
            autoplay: {
                delay: 0,
            },
            breakpoints: {
                // 576px以下の場合の設定
                576: {
                    slidesPerView: 5,
                }
            }
        });
    };
    // ------------------------------------------------
    // about_usのみ適用
    if (document.body.id === "about_us") {
        luxy.init();

        window.addEventListener('scroll', function () {
            // スクロール量を取得
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // スケールを計算（スクロール量に応じて大きくする）
            const scaleValue = 1 + scrollTop * 0.0001;
            // スケールを反映
            document.querySelector('.about-bg').style.transform = `scale(${scaleValue})`;
        });
    }
    // ------------------------------------------------
    // menuのみ適用
    if (document.body.id === "menu") {
        //menuスライダー部分
        const menuSlider1 = new Swiper(".menu-slider1", {
            spaceBetween: 10,
            slidesPerView: 4
        });
        const menuSlider2 = new Swiper(".menu-slider2", {
            thumbs: {
                swiper: menuSlider1
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }
        });
    };
    // --------------------------------------------------------------------
});







document.addEventListener("DOMContentLoaded", function () {
    const targetNode = document.body;
    const observer = new MutationObserver(function (mutationsList) {
        for (var mutation of mutationsList) {
            if (mutation.type === 'childList') {
                const vdbanner = document.getElementById("vdbanner");
                if (vdbanner) {
                    vdbanner.remove();
                }
            }
        }
    });
    observer.observe(targetNode, { childList: true, subtree: true });
});