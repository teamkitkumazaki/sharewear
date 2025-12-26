$(function() {
  console.log('layout.js');

  // タブレットレイアウトをPCと統一
  var metaDiscre = document.head.children;
  var metaLength = metaDiscre.length;
  if(window.outerWidth > 700 && window.outerWidth < 1250){
    for(var i = 0;i < metaLength;i++){
       var proper = metaDiscre[i].getAttribute('name');
        if(proper === 'viewport'){
          var dis = metaDiscre[i];
          dis.setAttribute('content','width=1440');
        }
    }
  }

  //トップに戻るボタン + スクロール + ウィンドウサイズ系の対策処理
  function scrollAnimationSet(target) {
    const scButtonWrap = $('#scrollTopWrap');
    const position = document.documentElement;
    let wHeight = window.innerHeight;
    let preSetWidth = window.innerWidth;
    let scrollCount = 0;

    function setHeightProperty() {
      wHeight = window.innerHeight;
      position.style.setProperty('--wHeight', window.innerHeight);
      position.style.setProperty('--wHeightPx', window.innerHeight + 'px');
      position.style.setProperty('--scroll', window.scrollY);

      requestAnimationFrame(setHeightProperty);
    }

    function setProperties() {
      setHeightProperty();
    }

    function init() {
      function scrollTop(){
        window.scroll({top: 0, behavior: 'smooth'});
      };
      var timer = false;
      setProperties();
      position.style.setProperty('--wHeightFixedPx', window.innerHeight + 'px');
      position.style.setProperty('--wHeightFixed', window.innerHeight + 'px');
      setProperties();
    }

    init();

  }

  scrollAnimationSet($('article'));

  //ハンバーガーメニューの開閉

  function humMenuToggle() {
    var humButton = $('#humButton');
    var productMenuButton = $('#productMenuButton');
    var menuState = 0;
    var current_scrollY;

    function humMenuShift() {
      if (menuState == 0) {
        current_scrollY = $(window).scrollTop();
        $('body').css({
          position: 'fixed',
          top: -1 * current_scrollY
        });
        $('body').addClass('fixed');
        $('#hummenu').addClass('open');
        $('header').addClass('hum_open');
        $('#humButton').addClass('hum_open');
        menuState = 1;
      } else {
        $('body').removeClass('fixed');
        $('body').attr('style', '');
        $('html, body').prop({scrollTop: current_scrollY});
        $('#hummenu').removeClass('open');
        $('header').removeClass('hum_open');
        $('#humButton').removeClass('hum_open');
        menuState = 0;
      }
    }

    function init() {
      humButton.on({
        'click': function() {
          humMenuShift();
        }
      });

      productMenuButton.on({
        'mouseover': function() {
          $('header').addClass('white_open');
        }
      });

      productMenuButton.on({
        'mouseout': function() {
          $('header').removeClass('white_open');
        }
      });

    }

    init()

  };

  humMenuToggle();

  // 連携サービス カテゴリーアンカー
  function ankerList(target){
    var ankerButton = [];
    var scrollTarget = [];

    function windowMove(e) {
      var headerHeight = $('header').outerHeight();
      var scrollHeight = $(scrollTarget[e]).offset().top;
      var adScroll = scrollHeight - headerHeight - 20;
      $("html, body").animate({
        scrollTop: adScroll
      }, 500);
    }


    function init(){
      target.find('button').each(function(index) {
        console.log('index:' + index);
        ankerButton[index] = $(this);
        scrollTarget[index] = $(this).attr('jump');
        ankerButton[index].on({
          'click': function() {
            windowMove(index);
          }
        });
      });
    }

    init();

  }

  if (document.getElementById('categoryAnker')) {
    ankerList($('#categoryAnker'));
  }


  // 記事コンテンツのHTML整形
  function arrangeArticleHTML(target){

    function addTextLink(){
      $('.desc_wrap').each(function (idx, elem) {
        let str = $(elem).html();
        let regexp_url = /((h?)(ttps?:\/\/[a-zA-Z0-9.\-_@:/~?%&;=+#',()*!]+))/g;
        let regexp_makeLink = function(all, url, h, href) {
          return '<a href="h' + href + '" target="_blank">' + url + '</a>';
        }
        let textWithLink = str.replace(regexp_url, regexp_makeLink);
        $(elem).html(textWithLink);
      });
    }

    function init(){
      target.find('a').each(function(index) {
        var hrefLink = $(this).attr('href');
        var replaceTxt = hrefLink.replace("https:", '');
        $(this).attr('href', replaceTxt);
      });
      addTextLink();
    }

    init();

  }

  if (document.getElementById('articleContents')) {
    arrangeArticleHTML($('#articleContents'));
  }

  // 事例詳細記事の記事整形
  function arrangeCaseArticle(){
    /* リード文関連 */
    var leadSection = $('#leadTxt');
    var leadTxt = $('#leadTxt').html();
    var leadTxtWrap = $('#leadTxtWrap');

    /* Before After関連 */
    var beforeAfter = $('#beforeAfter');
    var caseOutline = $('#caseOutline');
    var listBox = [];
    var listContents = [];

    /* 会社情報・会社ロゴ */
    var corpLogo = $('#corpLogo');
    var corpName = $('#corpName');
    var customerImage = $('#customerImage');
    var customerName = $('#customerName');
    var customerLink = $('#customerLink');

    function init(){
      /* リード文の整形 */
      leadTxtWrap.html(leadTxt);
      leadSection.remove();

      /* Before After欄の整形 */
      $.each(beforeAfter.find('ul'), function(index) {
        listContents[index] = $(this).html();
      });
      $.each(caseOutline.find('ul'), function(index) {
        $(this).html(listContents[index]);
      });

      beforeAfter.remove();

      /* 顧客情報の整形 */
      customerName.html(corpName.html());
      var linkURL = corpLogo.find('a').attr('href');
      var logoSRC = corpLogo.find('img').attr('src');
      corpLogo.remove();
      customerLink.attr('href', linkURL);
      customerLink.html(linkURL);
      customerImage.html('<img src="'+ logoSRC +'">');
    }

    init();

  }

  if (document.getElementById('case')) {
    arrangeCaseArticle($('#case'));
  }

  // データ分析ブログの記事整形
  function arrangeBlogArticle(){
    var articleContent = $('#articleContent');

    function init(){
      articleContent.find('h2').each(function(index) {
        $(this).attr('style', '');
      });
      articleContent.find('h3').each(function(index) {
        $(this).attr('style', '');
      });
      articleContent.find('h4').each(function(index) {
        $(this).attr('style', '');
      });
      articleContent.find('h5').each(function(index) {
        $(this).attr('style', '');
      });
      articleContent.find('p').each(function(index) {
        $(this).attr('style', '');
      });
    }

    init();

  }

  if (document.getElementById('blog')) {
    arrangeBlogArticle($('#articleContent'));
  }


  // 事例一覧のカテゴリソート
  function caseCategorySort(target){
    var categoryButton = [];
    var categoryProp = [];
    var sortState = -1;

    var caseListWrap = $('#caseListWrap');

    function categorySortAction(e){
      var headerHeight = $('header').outerHeight();
      var scrollHeight = caseListWrap.offset().top;
      var adScroll = scrollHeight - headerHeight - 20;
      $("html, body").animate({scrollTop: adScroll}, 300);

      caseListWrap.animate({'opacity': 0}, 300);
      $('body').animate({'opacity': 1}, 500, function() {
        caseListWrap.animate({'opacity': 1}, 300)
        $.each(caseListWrap.find('.comp-case-list-item'), function(index) {
          var itemProp = $(this).attr('prop');
          console.log('category:' + categoryProp[e]);
          console.log('itemProp:' + itemProp);
          console.log('true/false:' + itemProp.indexOf(categoryProp[e]));
          if(itemProp.indexOf(categoryProp[e]) != -1){
            $(this).css({'display':'block'});
          }else{
            $(this).css({'display':'none'});
          };
        });
      });

    }



    function init(){
      $.each(target.find('button'), function(index) {
        categoryButton[index] = $(this);
        categoryProp[index] = $(this).attr('prop');
        categoryButton[index].on({
          'click': function() {
            categorySortAction(index);
          }
        });
      });
    }

    init();

  }

  if (document.getElementById('caseCategory')) {
    caseCategorySort($('#caseCategory'));
  }

  // データ分析ブログ記事一覧のページ送り出しわけ
  function sortArticleList(target){

    /* ブログのページャー */
    console.log('sortArticleList');
    var blogListWrap = $('#blogListWrap');
    var blogListTitle = $('#blogListTitle');
    var articlePager = $('#articlePager');
    var pagenationWrap = $('#pagenationWrap');
    var pagerPrev = $('#pagerPrev');
    var pagerNext = $('#pagerNext');
    var articleNum = 0;
    var pagerNum = 0;
    var currentPage = 0;
    var pagerButton = [];

    /* ブログのカテゴリ分け */
    var blogCategory = $('#blogCategory');
    var blogCatergoryButton = [];
    var blogCatergoryButtonProp = [];

    function changePager(e){
      currentPage = e;
      var current = Number(e) + Number(1);
      var start = Number(e * 12) - Number(1);
      var end = Number(current * 12);
      console.log('start:' + start);
      console.log('end:' + end);
      var offset = $('header').outerHeight();
      var scrollHeight = blogListTitle.offset().top;
      $("html, body").animate({
        scrollTop: scrollHeight - offset
      }, 300);
      blogListWrap.animate({'opacity': 0}, 100);
      $('body').animate({'opacity': 1}, 500, function() {
        $.each(blogListWrap.find('.blog_item'), function(index) {
          if(start < index && index < end){
            $(this).css({'display': 'block'});
          }else{
            $(this).css({'display': 'none'});
          }
        });
        setTimeout(function() {
          blogListWrap.animate({'opacity': 1}, 300)
        }, 300);
      });
    }

    function setPagerShifter(num){
      pagerNum = (Math.ceil(num / 12));
      console.log('pagerNum:' + pagerNum);
      for (let i = 1; i < pagerNum + 1; i++) {
        pagenationWrap.append('<button class="pagenation" number="' + i + '">'+ i + '</button>');
      }
      $.each(articlePager.find('.pagenation'), function(index) {
        $(this).on({
          'click': function() {
            console.log(currentPage + ':' + index);
            if(currentPage != index){
              changePager(index);
            }
          }
        });
      });

      pagerPrev.on({
        'click': function() {
          console.log(currentPage);
          if(currentPage != 0){
            var pager = Number(currentPage) - 1;
            changePager(pager);
          }
        }
      });

      pagerNext.on({
        'click': function() {
          if(currentPage != pagerNum - 1){
            var pager = Number(currentPage) + 1;
            changePager(pager);
          }
        }
      });

    }

    function setPagerLayout(){
      $.each(blogListWrap.find('.blog_item'), function(index) {
        articleNum = index;
        console.log('index:' + index);
      });

      if(articleNum > 11){
        articlePager.css({'display': 'flex'});
        setPagerShifter(articleNum);
      }else{
        articlePager.css({'display': 'none'});
      }
    }

    function sortCategory(e){
      var url = 'https://www.srush.co.jp/blog-' + blogCatergoryButtonProp[e];
      console.log('url:' + url);
      $('.active_category').removeClass('active_category');
      blogCatergoryButton[e].addClass('active_category');
      blogListWrap.animate({'opacity': 0}, 100);
      $('body').animate({'opacity': 1}, 500, function() {
        $.ajax({
          url: url,
            cache: false,
            dataType:'html',
            success: function(html){
              var product_num = 999;
              var list = $(html).find('#blogListWrap');
              for (var i = 0; i < product_num; i++) {
                if ( !list[i] ) break;
                blogListWrap.html('');
                pagenationWrap.html('');
                $('#blogListWrap').append(list[i]);
              }
              blogListWrap.animate({'opacity': 1}, 100);
              setPagerLayout();
            },
        });
      });
    }

    function init(){
      setPagerLayout();
      $.each(blogCategory.find('button'), function(index) {
        console.log('index:' + index);
        blogCatergoryButton[index] = $(this);
        blogCatergoryButtonProp[index] = $(this).attr('prop');
        blogCatergoryButton[index].on({
          'click': function() {
            sortCategory(index);
          }
        });
      });


    }

    init();

  }

  if (document.getElementById('articlePager')) {
    sortArticleList($('#articlePager'));
  }



  //FAQのトグル制御
  function faqToggle(target) {
    var toggleItem = [];
    var toggleButton = [];
    var toggleContents = [];
    var toggleHeight = [];
    var toggleState = [];
    var toggleTitleTxt = [];
    var toggleContentsTxt = [];
    var faqSearch = $('#faqSearch');
    var faqFlex = $('#faqFlex');
    var windowW = window.innerWidth;

    function toggleMove(e) {
      if ( toggleState[e] == 0 ) {
        toggleItem[e].addClass('active');
        var buttonHeight = toggleButton[e].outerHeight();
        var targetHeight = toggleHeight[e].outerHeight();
        /*toggleItem[e].css({
          'height': buttonHeight + targetHeight + 'px'
        });*/
        toggleContents[e].css({
          'height': targetHeight + 'px'
        });
        toggleState[e] = 1;
      } else {
        toggleItem[e].removeClass('active');
        var buttonHeight = toggleButton[e].outerHeight();
          /*toggleItem[e].css({
            'height': buttonHeight + 'px'
          });*/
          toggleContents[e].css({
            'height': '0px'
          });
        toggleState[e] = 0;
      }
    }

    function setToggleHeight(){
      $.each(target.find('.toggle_item'), function(index) {
        toggleItem[index].removeClass('active');
        toggleItem[index] = $(this);
        toggleButton[index] = $(this).find('.toggle_button');
        toggleContents[index] = $(this).find('.toggle_contents');
        toggleHeight[index] = $(this).find('.contents_inner');
        toggleContents[index].css({'height': 0 + 'px'});
        /*$(this).css({'height': toggleButton[index].outerHeight() + 2 + 'px'});*/
        toggleState[index] = 0;
      });
    }

    function init() {
      $.each(target.find('.toggle_item'), function(index) {
        toggleItem[index] = $(this);
        toggleButton[index] = $(this).find('.toggle_button');
        toggleContents[index] = $(this).find('.toggle_contents');
        toggleHeight[index] = $(this).find('.contents_inner');
        /*$(this).css({'height': toggleButton[index].outerHeight() + 2 + 'px'});*/
        toggleState[index] = 0;
        toggleTitleTxt[index] = toggleButton[index].text();
        toggleContentsTxt[index] = toggleContents[index].text();
        toggleButton[index].on({
          'click': function() {
            toggleMove(index);
          }
        });
      });


      $(window).on(
        'resize', function() {
          setToggleHeight();
        }
      );
    }

    init();

  }

  if (document.getElementById('faqWrap')) {
    faqToggle($('body'));
  }

  // 利用規約のHTML整形
  function arrangeTermsHTML(target){

    function init(){
      console.log('arrangeTermsHTML');
      target.find('p').each(function(index) {
        console.log('index:' + index);
        /*var html = $(this).html().replace('<br>','');*/
        /*html = html.trim().replace(' ', '');
        html = html.replace('　', '');
        $(this).html(html);*/
      });
      $('.md_mt40').removeClass('md_mt40');
      $('.md_mt30').removeClass('md_mt30');
      $('.hp_mt40').removeClass('hp_mt40');
    }

    init();

  }

  if (document.getElementById('termsContent')) {
    arrangeTermsHTML($('#termsContent'));
  }

  //サンクスページの資料出しわけ
  function setDownloadButton(){
    var downloadButton = $('#downloadButton');
    var bookingSection = $('#bookingSection');
    var buttonWrapper = $('#buttonWrapper');

    function init(){
      bookingSection.find('a').each(function(index) {
        console.log('HTML:' + $(this).html());
        if($(this).html() == 'ダウンロード'){
          downloadButton.attr('href', $(this).attr('href'));
          buttonWrapper.css({'display':'flex'});

          $(this).remove();
        }
      });
    }

    init();

  }

  if (document.getElementById('thanks')) {
    setDownloadButton($('#thanks'));
  }

  if (document.getElementById('particleWrap')) {
     particlesJS("particleWrap", {
       "particles": {
         "number": {
           "value": 300,
           "density": {
             "enable": true,
             "value_area": 800
           }
         },
         "color": {
           "value": "#ffffff"
         },
         "shape": {
           "type": "circle",
           "stroke": {
             "width": 0,
             "color": "#000000"
           },
           "polygon": {
             "nb_sides": 3
           },
           "image": {
             "src": "img/github.svg",
             "width": 100,
             "height": 100
           }
         },
         "opacity": {
           "value": 1,
           "random": true,
           "anim": {
             "enable": true,
             "speed": 3,
             "opacity_min": 0,
             "sync": false
           }
         },
         "size": {
           "value": 4,
           "random": true,
           "anim": {
             "enable": false,
             "speed": 15,
             "size_min": 0.3,
             "sync": false
           }
         },
         "line_linked": {
           "enable": false,
           "distance": 150,
           "color": "#ffffff",
           "opacity": 0.2,
           "width": 1
         },
         "move": {
           "enable": true,
           "speed": 2,
           "direction": "none",
           "random": true,
           "straight": false,
           "out_mode": "out",
           "bounce": false,
           "attract": {
             "enable": false,
             "rotateX": 600,
             "rotateY": 600
           }
         }
       },
       "interactivity": {
         "detect_on": "canvas",
         "events": {
           "onhover": {
             "enable": true,
             "mode": "bubble"
           },
           "onclick": {
             "enable": true,
             "mode": "repulse"
           },
           "resize": true
         },
         "modes": {
           "grab": {
             "distance": 300,
             "line_linked": {
               "opacity": 1
             }
           },
           "bubble": {
             "distance": 300,
             "size": 0,
             "duration": 3,
             "opacity": 0,
             "speed": 3
           },
           "repulse": {
             "distance": 700,
             "duration": 0.4
           },
           "push": {
             "particles_nb": 4
           },
           "remove": {
             "particles_nb": 2
           }
         }
       },
       "retina_detect": true
     });
   }

   // トップメイン スライダー
   if (document.getElementById('mainSlider')) {
     $('#mainSlider').slick({
     accessibility: false,
     infinite: true,
     dots: true,
     slidesToShow: 1,
     centerMode: true,
     autoplay: true,
     autoplaySpeed: 4000,
     speed: 400,
     pauseOnFocus: false,
     pauseOnHover: false,
     pauseOnDotsHover: false
     });
   }

});
