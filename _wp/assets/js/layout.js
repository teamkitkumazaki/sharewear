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

      $(".effect").each(function() {
        var imgPos = $(this).offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll > imgPos - windowHeight + windowHeight / 7) {
          $(this).removeClass('effect');
          setTimeout(function() {
            $(this).removeClass('effect2');
          }, 1000);
        };
      });
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
        $('#humButton').addClass('hum_open');
        menuState = 1;
      } else {
        $('body').removeClass('fixed');
        $('body').attr('style', '');
        $('html, body').prop({scrollTop: current_scrollY});
        $('#hummenu').removeClass('open');
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

    }

    init()

  };

  humMenuToggle();


});
