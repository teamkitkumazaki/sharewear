/* お問い合わせフォームのGAS連動とバリデーション */
function setMyForm(target){
  console.log('setMyForm');
  var ERROR_MESSAGE_CLASSNAME = 'errorMsg'; //エラー時のメッセージ要素のclass名
  var ERROR_INPUT_CLASSNAME = 'errorInput'; //エラー時のinput要素のclass名
  var errorCount = 0;
  var submitWrap = $('#submit');
  var confirmButton = $('#confirm');
  var submitButton = $('#submitButton');
  var contactBackButton = $('#contactBackButton');
  var items = []; //チェック対象となるテキスト入力要素を格納した配列

  //項目チェックする
  var checkAll = function(){
    errorCount = 0;

    //input,textareaのチェック
    for( var i=0; i<items.length; i++ ){
      if( items[i].prop('isSuccess') == false ){
        errorCount++;
      };
    };

    console.log('errorCount:' + errorCount);

    if( errorCount == 0 ){
    }else{
    };
  };

  //エラーメッセージの追加
  var addErrorMessage = function(selector, msg){
    removeErrorMessage(selector);
    selector.parent('div').append('<span class="error '+ERROR_MESSAGE_CLASSNAME+'">'+msg+'</span>');
    selector.addClass(ERROR_INPUT_CLASSNAME);
  };

  //エラーメッセージの削除
  var removeErrorMessage = function(selector){
    var msgSelector = selector.parent('div').find('.'+ERROR_MESSAGE_CLASSNAME);
    if( msgSelector.length != 0 ){
      msgSelector.remove();
      selector.removeClass(ERROR_INPUT_CLASSNAME);
    };
  };

  //input,textareaの未入力チェック
  var checkEmptyText = function(selector, msg){
    if( selector.val() == '' ||  selector.val() == null){
      addErrorMessage(selector, msg);
      selector.prop('isSuccess', false);
    }else{
      removeErrorMessage(selector);
      selector.prop('isSuccess', true);
    };
  };

  var emptyThrough = function(selector){
    if( selector.val() == '' ||  selector.val() == null){
      removeErrorMessage(selector);
      selector.prop('isSuccess', true);
    }
  };

  //radioの未入力チェック
  var checkRadioBox = function(selector, msg){
    if( selector.prop("checked")){
      removeErrorMessage(selector);
      selector.prop('isSuccess', true);
      submitWrap.removeClass('disabled');
    }else{
      addErrorMessage(selector, msg);
      selector.prop('isSuccess', false);
      submitWrap.addClass('disabled');
    };
  };

  //文字列のフォーマットチェック
  function checkFormatText(selector, _mode, msg){
    var value = selector.val();
    switch(_mode){
      //全角のみ
      case 0:
        if(value.match(/^[^ -~｡-ﾟ]*$/)){
          selector.prop('isSuccess', true);
          removeErrorMessage(selector);
        }else{
          selector.prop('isSuccess', false);
        };
        break;
      //ふりがなのみ
      case 1:
        if(value.match(/^[\u3040-\u309F]+$/)){
          selector.prop('isSuccess', true);
        }else{
          selector.prop('isSuccess', false);
        };
        break;
      //半角数字とハイフンのみ
      case 2:
      if(value.match(/^[0-9\-]+$/) || value.length < 1){
        selector.prop('isSuccess', true);
      }else{
        selector.prop('isSuccess', false);
      };
      break;
      //メールアドレスかどうか
      case 3:
        if(value.match(/^[a-zA-Z0-9!$&*.=^`|~#%'+\/?_{}-]+@([a-zA-Z0-9_-]+\.)+[a-zA-Z]{2,6}$/)){
          selector.prop('isSuccess', true);
        }else{
          selector.prop('isSuccess', false);
        };
        break;
    };
    if( selector.prop('isSuccess') == false ){
      addErrorMessage(selector, msg);
    }else{
      removeErrorMessage(selector);
    };
  };

  //初期設定
  var init = function(){
    target.find('input[type=button]').attr('disabled', true);
    //submitイベントの設定
    target.on({
      'submit': function(){
        checkAll();
      }
    });
    //input要素を配列に格納
    items = [
      target.find('input[name="username"]'), //0 氏名
      target.find('input[name="usermail"]'), //1 メールアドレス
      target.find('input[name="telnumber"]'), //2 電話番号
      target.find('select[name="category"]'), //3 お問い合わせ種別
      target.find('textarea[name="content"]'), //4 お問い合わせ内容
    ];

    //input要素のプロパティを設定
    $.each(items, function(index){
      items[index].prop('isSuccess', false);
    });

    //enterキーでsubmitしてしまうのを防止する
    target.find('input[type=text]').on({
      'keypress': function(e){
        if( (e.keyCode == 13) ) return false;
      }
    });
    //0 氏名
    items[0].on({
      'blur': function(){
        checkEmptyText( items[0], '※氏名を入力してください。' );
        checkAll();
      }
    });
    //2 メールアドレス
    items[1].on({
      'blur': function(){
        checkEmptyText( items[1], '※メールアドレスをご入力ください。' );
        if( items[1].prop('isSuccess') ) checkFormatText( items[1], 3, '※アドレスの形式をご確認ください' );
        checkAll();
      }
    });
    //2 電話番号
    items[2].on({
      'blur': function(){
        checkEmptyText( items[2], '※電話番号を入力してください。' );
        if( items[2].prop('isSuccess') ) checkFormatText( items[2], 2, '※電話番号は数字で入力してください。');
        checkAll();
      }
    });
    //3 お問い合わせ種別
    items[3].on({
      'change': function(){
        checkEmptyText( items[3], '※項目を選択してください' );
        checkAll();
      }
    });
    //4 お問い合わせ内容
    items[4].on({
      'blur': function(){
        checkEmptyText( items[4], '※お問い合わせ内容を入力してください' );
        checkAll();
      }
    });

    //5 プラポリへの同意
    $(target.find('input[name=privacy]')).on({
      'click': function(){
        var privacyState = $('input[name="privacy"]:checked').val();
        if(privacyState == 1){
          confirmButton.removeClass('disabled');
        }else{
          confirmButton.addClass('disabled');
        }
      }
    });
    confirmButton.on({
      'click': function(){
        checkEmptyText( items[0], '※氏名を入力してください。' );
        checkEmptyText( items[1], '※メールアドレスをご入力ください。' );
        checkEmptyText( items[2], '※電話番号を入力してください。' );
        checkEmptyText( items[3], '※項目を選択してください' );
        checkEmptyText( items[4], '※お問い合わせ内容を入力してください' );
        checkAll();
        if( errorCount == 0 ){
          contentCheck();
        }else{
          alert('入力内容に不備があります。入力内容を確認いただき、再度確認ボタンを押してください。');
          var scrollHeight = $('article').offset().top;
          $("html, body").animate({
            scrollTop: scrollHeight
          }, 300);
        };
      }
    })
    submitButton.on({
      'click': function(){
        processOrderContent();
      }
    })
  };

  function contentCheck(){
    var userName = target.find('input[name="username"]').val();
    var userMail = target.find('input[name="usermail"]').val();
    var telNumber = target.find('input[name="telnumber"]').val();
    var category = target.find('select[name="category"]').val();
    var content = target.find('textarea[name="content"]').val();
    $('#footerBg').animate({opacity: 0}, 1);
    $('article').animate({opacity:0}, 400, function(){
        $('#contactConfirm').css({'display': 'block'});
        $('#contactInput').css({'display': 'none'});
        $('#userNameInput').html(userName);
        $('#userMailInput').html(userMail);
        $('#phoneNumberInput').html(telNumber);
        $('#phoneNumberInput').html(telNumber);
        $('#categoryInput').html(category);
        $('#categoryInput').html(category);
        $('#contentInput').html(content);
        window.scroll({top: 0, behavior: 'instant'});
        setTimeout(function() {
          $("article").animate({opacity: 1}, 400, function(){
            $('#footerBg').animate({opacity: 1}, 1);
          });
        }, 50);
    });
    /*processOrderContent();*/
  }

  function processOrderContent(){
    $('#ajaxLoader').addClass('loading');
    var userName = target.find('input[name="username"]').val();
    var userMail = target.find('input[name="usermail"]').val();
    var telNumber = target.find('input[name="telnumber"]').val();
    var category = target.find('select[name="category"]').val();
    var content = target.find('textarea[name="content"]').val();
    submitButton.css({'pointer-events': 'none'});
    event.preventDefault();
    $.ajax({
      url: "https://docs.google.com/forms/u/0/d/e/1FAIpQLSd642j8qWj7XBteZps95TSunViGhPz2lcZkXIj_XsiNxJbqUQ/formResponse",
      data: {
        "entry.1986630100": userName,
        "entry.1547819249": userMail,
        "entry.584991094": telNumber,
        "entry.178746866": category,
        "entry.1276392590": content
      },
    type: "POST",
    dataType: "xml",
    statusCode: {
        0: function () {
          setTimeout(function() {
            $('#ajaxLoader').removeClass('loading');
            $('#submitButton').addClass('completed');
            $('#statusMessage').addClass('complete').html('<span class="text">メッセージは送信されました。<br>自動返信メールをご確認ください。</span>');
          }, 2000);
        },
        200: function () {
          alert('メッセージ送信に失敗しました。お手数ではございますが、時間を置いてもう一度お試しください。');
          setTimeout(function() {
            location.href = 'https://' + location.hostname + '/';
          }, 500);
        }
      }
  });
}

  init();

};

if (document.getElementById('contact')) {
  setMyForm($('#formWrap'));
}
