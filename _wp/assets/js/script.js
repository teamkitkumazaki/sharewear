document.addEventListener('DOMContentLoaded', () => {
  console.log('layout.js');

  // ================================
  // タブレットレイアウトをPCと統一
  // ================================
  const metaDiscre = document.head.children;
  const metaLength = metaDiscre.length;

  if (window.outerWidth > 700 && window.outerWidth < 1250) {
    for (let i = 0; i < metaLength; i++) {
      const proper = metaDiscre[i].getAttribute('name');
      if (proper === 'viewport') {
        const dis = metaDiscre[i];
        dis.setAttribute('content', 'width=1440');
      }
    }
  }

  // ================================
  // トップに戻るボタン + スクロール + ウィンドウサイズ系の対策処理
  function scrollAnimationSet(target) {
    const scButtonWrap = document.querySelector('#scrollTopWrap');
    const spRecruitMenu = document.querySelector('#spRecruitMenu');
    const position = document.documentElement;
    let wHeight = window.innerHeight;
    let preSetWidth = window.innerWidth;
    let scrollCount = 0;

    // jQuery .offset().top の代替関数
    function getOffsetTop(el) {
      const rect = el.getBoundingClientRect();
      return rect.top + window.pageYOffset;
    }

    function setHeightProperty() {
      wHeight = window.innerHeight;

      position.style.setProperty('--wHeight', window.innerHeight);
      position.style.setProperty('--wHeightPx', window.innerHeight + 'px');
      position.style.setProperty('--scroll', window.scrollY);

      requestAnimationFrame(setHeightProperty);

      if(window.scrollY > window.innerHeight){
        spRecruitMenu.classList.add('display');
      }else{
        spRecruitMenu.classList.remove('display');
      }

      // jQuery $(".effect").each()
      document.querySelectorAll('.effect').forEach(function(el) {
        const imgPos = getOffsetTop(el);
        const scroll = window.pageYOffset;
        const windowHeight = window.innerHeight;

        if (scroll > imgPos - windowHeight + windowHeight / 7) {
          el.classList.remove('effect');

          setTimeout(function() {
            el.classList.add('effect2');
          }, 500);
        }
      });
    }

    function setProperties() {
      setHeightProperty();
    }

    function init() {
      function scrollTop() {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      }

      let timer = false;

      setProperties();

      position.style.setProperty('--wHeightFixedPx', window.innerHeight + 'px');
      position.style.setProperty('--wHeightFixed', window.innerHeight + 'px');

      setProperties();
    }

    init();
  }

  // 元コードの scrollAnimationSet($('article')) に対応
  scrollAnimationSet(document.querySelector('article'));


  function indexKvAnimation() {
  var kvImgWrap = document.querySelector('#kvImgWrap');
  var kvImgTxt = kvImgWrap.querySelector('.txt');
  var kvImgTriangle = kvImgWrap.querySelector('.triangle');
  var kvImgPeople = kvImgWrap.querySelector('.people');
  var kvImgTxt2 = kvImgWrap.querySelector('.txt2');
  var kvImgTriangle2 = kvImgWrap.querySelector('.triangle2');
  var kvImgPeople2 = kvImgWrap.querySelector('.people2');
  var header = document.querySelector('header');

  function init() {
    setTimeout(function () {

      // txt と triangle を表示
      kvImgTxt.classList.add('display');
      kvImgTriangle.classList.add('display');
      kvImgTxt2.classList.add('display');
      kvImgTriangle2.classList.add('display');

      setTimeout(function () {

        // people を表示
        kvImgPeople.classList.add('display');
        kvImgPeople2.classList.add('display');

        setTimeout(function () {

          // wrap 全体を表示 ＋ header から index を外す
          kvImgWrap.classList.add('display');
          kvImgTriangle.classList.remove('display');
          kvImgTriangle2.classList.remove('display');
          if (header) header.classList.remove('index');

        }, 1500);

      }, 1500);

    }, 500);
  }

  init();
}

// 元コードの条件: #index がある時だけ実行
if (document.getElementById('index')) {
  indexKvAnimation();
}

  // ================================
  // ハンバーガーメニュー開閉
  // ================================
  function humMenuToggle() {
    const humButton = document.getElementById('humButton');
    const humMenu = document.getElementById('hummenu');
    let menuState = 0;
    let currentScrollY = 0;

    function humMenuShift() {
      const body = document.body;
      if (menuState === 0) {
        currentScrollY = window.scrollY;
        body.style.position = 'fixed';
        body.style.top = `-${currentScrollY}px`;
        body.classList.add('fixed');
        humMenu.classList.add('open');
        humButton.classList.add('hum_open');
        menuState = 1;
      } else {
        body.classList.remove('fixed');
        body.style.position = '';
        body.style.top = '';
        humMenu.classList.remove('open');
        humButton.classList.remove('hum_open');
        window.scrollTo(0, currentScrollY);
        menuState = 0;
      }
    }

    function init() {
      if (humButton) {
        humButton.addEventListener('click', humMenuShift);
      }
    }

    init();
  }

  humMenuToggle();



  function faqToggle(target) {
    const toggleItems = Array.from(target.querySelectorAll('.toggle_item'));
    const toggleButtons = [];
    const toggleContents = [];
    const toggleStates = [];
    const toggleTitleTxt = [];
    const toggleContentsTxt = [];

    let windowW = window.innerWidth;

    // -------------------------------
    // トグル開閉処理
    // -------------------------------
    function toggleMove(index) {
      const button = toggleButtons[index];
      const content = toggleContents[index];
      const item = toggleItems[index];

      if (toggleStates[index] === 0) {
        item.classList.add('active');
        const buttonHeight = button.offsetHeight;
        const contentHeight = content.offsetHeight;
        item.style.height = buttonHeight + contentHeight + 'px';
        toggleStates[index] = 1;
      } else {
        item.classList.remove('active');
        const buttonHeight = button.offsetHeight;
        item.style.height = buttonHeight + 2 + 'px';
        toggleStates[index] = 0;
      }
    }

    // -------------------------------
    // 高さを初期化
    // -------------------------------
    function setToggleHeight() {
      toggleItems.forEach((item, index) => {
        const button = item.querySelector('.toggle_button');
        const content = item.querySelector('.toggle_contents');
        const height = button.offsetHeight + 2;
        item.style.height = height + 'px';
        toggleStates[index] = 0;
      });
    }

    // -------------------------------
    // ウィンドウサイズ監視
    // -------------------------------
    function windowChecker() {
      const currentWindow = window.innerWidth;
      if (currentWindow !== windowW) {
        setToggleHeight();
        windowW = currentWindow;
      }
      requestAnimationFrame(windowChecker);
    }

    // -------------------------------
    // 🚀 初期化処理
    // -------------------------------
    function init() {
      toggleItems.forEach((item, index) => {
        const button = item.querySelector('.toggle_button');
        const content = item.querySelector('.toggle_contents');

        toggleButtons[index] = button;
        toggleContents[index] = content;
        toggleStates[index] = 0;

        item.style.height = button.offsetHeight + 2 + 'px';

        toggleTitleTxt[index] = button.textContent;
        toggleContentsTxt[index] = content.textContent;

        button.addEventListener('click', () => toggleMove(index));
      });


      windowChecker();

    }

    init();
  }

  // -----------------------------------
  // 実行トリガー
  // -----------------------------------
  const faqFlex = document.getElementById('faqWrap');
  if (faqFlex) {
    faqToggle(document.querySelector('article'));
  }

});
