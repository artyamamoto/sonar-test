var JwPopup = {
    // 背景のdiv
    "divBg" : null,

    // 画像のdiv
    "divImages" : [],

    // 初期化処理
    "init" : function() {
        var popupDivCount = 0;

        // ポップアップエリアの背景を作成（白&半透明）
        this.divBg = $('<div class="jw-popup-bg"></div>');
        $('body').append(this.divBg);

        // 一つ前のAタグ
        var prevA = null;

        // a rel="popup" に対して処理を行う
        $("a[rel='popup']").each(function() {
            // 連続したポップアップの判定
            var isNext = false;
            if($(this.previousSibling).attr('id') == 'jw-popup-' + (popupDivCount - 1)) {
                isNext = true;

                var prev = $('div.jw-popup-link', JwPopup.divImages[popupDivCount - 1].div);
                prev.append('<a href="javascript:JwPopup.open(' + "'" + popupDivCount + "'" + ')" class="jw-popup-next">Next</a>');
            }

            // リンクをpopup関数に変更
            var link = $(this).attr('href');
            $(this).attr('href', 'javascript:JwPopup.open("' + popupDivCount + '")');
            $(this).attr('id', 'jw-popup-' + popupDivCount);

            // 画像表示用divを作成
            var imgTag = $('<img src="' + link + '" class="jw-popup-image" />');
            var aTag = $('<a href="javascript:JwPopup.close(true)"></a>').append(imgTag);

            var popup = $('<div class="jw-popup"></div>');
            popup.append(aTag);
            popup.append('<div class="jw-popup-link"></div>');
            $('body').append(popup);

            if(isNext) {
                $('div.jw-popup-link', popup).append('<a href="javascript:JwPopup.open(' + "'" + (popupDivCount - 1) + "'" + ')" class="jw-popup-prev">Prev</a>');
            }

            var w = 0;
            if($(this).data('width')) {
                w = $(this).data('width');
            }
            JwPopup.divImages[popupDivCount] = {"div" : popup, "width" : w, "resized" : false};

            // 連続している場合はリンクを非表示
            if(isNext) {
                $(this).hide();
            }

            prevA = this;
            popupDivCount++;
        });
    },

    // ポップアップを開く
    "open" : function(id) {
        JwPopup.close(false);

        this.divBg.show();
        this.divImages[id].div.fadeIn();

        if(this.divImages[id].resized) {
            return;
        }

        // 画像の元サイズ
        var imgNaturalWidth  = $('img', this.divImages[id].div).attr('naturalWidth');
        var imgNaturalHeight = $('img', this.divImages[id].div).attr('naturalHeight');

        // ドキュメントのサイズ
        var documentWidth  = $(document).attr('width');
        var documentHeight = $(document).attr('height');

        // ウィンドウのサイズ
        var windowWidth  = $(window).attr('innerWidth');
        var windowHeight = $(window).attr('innerHeight');
        var scrollTop = $(document).scrollTop();

        // 画像の幅・高さを計算
        if(this.divImages[id].width == 0) {
            // 幅の割合が未指定の場合は、縦横のサイズで自動判別
            if(imgNaturalWidth > imgNaturalHeight) {
                this.divImages[id].width = 80;
            } else {
                this.divImages[id].width = 60;
            }
        }
        var imgWidth = documentWidth * this.divImages[id].width / 100;
        var imgHeight = imgNaturalHeight * imgWidth / imgNaturalWidth;

        // 画像の幅・高さを設定
        $('img.jw-popup-image', this.divImages[id].div).css('width', imgWidth + 'px');
        $('img.jw-popup-image', this.divImages[id].div).css('height', imgHeight + 'px');

        // ページャの幅を設定
        $('div.jw-popup-link', this.divImages[id].div).css('width', imgWidth + 'px');

        // 背景の高さを設定
        $(this.divBg).css('height', documentHeight + 'px');

        // divの高さを設定
        $(this.divImages[id].div).css('height', (imgHeight + 50) + 'px');

        // 画像の位置を調整する
        if(imgWidth < windowWidth) {
            var margin = (windowWidth - imgWidth) / 2;
            this.divImages[id].div.css('margin-left', margin);
        }
        var margin = (windowHeight - 40 - imgHeight) / 2 + scrollTop;
        if(margin > 0) {
            this.divImages[id].div.css('margin-top', margin);
        }

        this.divImages[id].resized = true;
    },

    // ポップアップを閉じる
    "close" : function(isFadeOut) {
        $(this.divImages).each(function(){
            if($(this.div).css('display') == 'none') {
                return;
            }

            if(isFadeOut) {
                $(this.div).fadeOut('normal', function() {
                    JwPopup.divBg.hide();
                });
            } else {
                $(this.div).hide();
            }
        });
    }
};

