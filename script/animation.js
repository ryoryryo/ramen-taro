document.addEventListener('DOMContentLoaded', function () {
    if (document.body.id === "home") {

        gsap.registerPlugin(ScrollTrigger);

        // -----------------------------------------------------------
        // home-introductionグリッド
        // ------------------------------------------------------------
        const fadeUpOrderElements = gsap.utils.toArray(".fade-up-order");
        const homeIntroductionGrid = document.querySelector(".home-introduction__grid")
        // タイムラインを作成
        const timeline = gsap.timeline({
            scrollTrigger: {
                trigger: homeIntroductionGrid, // 最初の要素をトリガーに
                start: "top bottom",
                end: "bottom top",
                toggleActions: "play reset play reset", // 必要に応じて調整
                onEnter: () => timeline.play(), // 下からスクロール時に再生
                onEnterBack: () => timeline.play(), // 上からスクロール時に再生
                once: false, // 複数回発火を許可
            },
        });

        // staggerで順番にアニメーション
        timeline.fromTo(
            fadeUpOrderElements,
            {
                opacity: 0,
                y: 20,
            },
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                delay: .3,
                ease: "linear",
                stagger: 0.3, // 各要素の秒間隔
            }
        );

        // ------------------------------------------------------------
        // home-processアニメーション
        // ------------------------------------------------------------
        gsap.registerPlugin(ScrollTrigger);

        const pinAreas = document.querySelectorAll(".pin-area");

        pinAreas.forEach((pinArea) => {
            const processContent = pinArea.querySelector(".home-process__content");
            const processImage = pinArea.querySelector(".home-process__image");
            const heading = pinArea.querySelector(".home-process__heading");

            ScrollTrigger.create({
                trigger: pinArea,
                start: "top top", // pin-area の上端が画面中央にきたら開始
                end: "bottom bottom", // pin-area の下端が画面中央にきたら終了
                onEnter: () => {
                    heading.classList.add("is-active"); // 上端が中央にきたらクラス追加
                },
                onLeaveBack: () => {
                    heading.classList.remove("is-active"); // 上端が中央を離れたらクラス削除
                },
                onLeave: () => {
                    heading.classList.remove("is-active"); // 下端が中央を離れたらクラス削除
                },
                onEnterBack: () => {
                    heading.classList.add("is-active"); // 下端が中央に戻ったらクラス追加
                },
            });

            gsap.timeline({
                scrollTrigger: {
                    trigger: pinArea,
                    start: "top top", // pin-area の上端が画面の上端にきたら開始
                    end: "bottom top", // pin-area の下端が画面の上端にきたら終了
                    pin: true, // pin-area 内を固定
                    pinSpacing: false, // スペースを削除
                    scrub: true, // スクロールに応じてアニメーション進行
                    anticipatePin: 1,
                },
            })
                .to(processContent, {
                    scale: 1,
                    opacity: 1,
                    duration: 1.5,
                })
                .to(processContent, {
                    scale: 1,
                    opacity: 1,
                    duration: 3,
                })
                .to(
                    processContent,
                    {
                        scale: 1.8,
                        opacity: 0,
                        duration: 3,
                        x: -150,
                    },
                    ">-0.5" // 前のアニメーションと少し重ねる
                )
                .to(
                    processImage,
                    {
                        scale: 3,
                        opacity: 0,
                        duration: 3,
                        x: 50,
                    },
                    "<" // .home-process__image のアニメーションと同時に実行
                );
        });

        // ---------------------------------------------------------------------
        // 横スクロールテキスト
        // ---------------------------------------------------------------------
        const rowScrollInner = document.querySelector(".row-scroll-inner");
        const rowScrollText = document.querySelector(".row-scroll-text");
        const rowScrollContainer = document.querySelector(".row-scroll-container");

        gsap.to(rowScrollText, {
            x: () => -(rowScrollText.clientWidth - rowScrollInner.clientWidth),
            ease: 'none',
            scrollTrigger: {
                trigger: '.row-scroll-container',
                start: 'top top',
                end: () => `+=${rowScrollText.clientWidth - rowScrollInner.clientWidth}`,
                scrub: true,
                pin: true,
                invalidateOnRefresh: true,
                anticipatePin: 1,
                onEnter: () => {
                    // 背景色を黒に変更
                    rowScrollContainer.style.backgroundColor = "black";
                },
                onLeave: () => {
                    // 背景色を元に戻す
                    rowScrollContainer.style.backgroundColor = "transparent";
                },
                onEnterBack: () => {
                    // アニメーションエリアに戻ったら再び黒に変更
                    rowScrollContainer.style.backgroundColor = "black";
                },
                onLeaveBack: () => {
                    // エリアを逆方向に出たら元に戻す
                    rowScrollContainer.style.backgroundColor = "transparent";
                },
            },
        });

        window.addEventListener("load", () => {
            ScrollTrigger.refresh(); // ScrollTriggerをリフレッシュ
        });

    };

    if (document.body.id === "home" || document.body.id === "about_us") {
        // ---------------------------------------------------------------
        // fade-upアニメーション
        // ---------------------------------------------------------------
        gsap.utils.toArray(".fade-up").forEach((fadeUpElm) => {
            gsap.fromTo(
                fadeUpElm,
                {
                    opacity: 0,
                    y: 20, // 初期位置
                },
                {
                    opacity: 1,
                    y: 0, // 最終位置
                    duration: .5, // アニメーションの時間
                    ease: "linear",
                    scrollTrigger: {
                        trigger: fadeUpElm, // 各要素をトリガーにする
                        start: "top 80%",
                        toggleActions: "play none none none", // スクロール時に一度だけアニメーション
                    },
                }
            )
        });

    };


});