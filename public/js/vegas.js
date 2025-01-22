$(window).on('load', function() {
  const ua = navigator.userAgent;
  if(ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0){
    slideSp();
  }else if(ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0){
    slideSp();
  }else{
    slidePc();
  }

  function slidePc() {
    setInterval(function () {
      $('#mainimg').vegas({
        slides: [
          { src: './images/IMG_1.jpg' },	//1枚目の写真指定
          { src: './images/IMG_2.jpg' },	//2枚目の写真指定
          { src: './images/IMG_3.jpg' },	//3枚目の写真指定
          { src: './images/IMG_4.jpg' },	//3枚目の写真指定
          { src: './images/IMG_5.jpg' },	//3枚目の写真指定
          { src: './images/IMG_6.jpg' },	//3枚目の写真指定
          { src: './images/IMG_7.jpg' },	//3枚目の写真指定
        ],
        overlay: true,//写真上にドットを重ねる。不要ならこの１行を削除して下さい。
        transition: 'blur',   //https://vegas.jaysalvat.com/documentation/transitions/から好みのtransitionを選んで置き換えられます。
        animation: 'kenburns',//https://vegas.jaysalvat.com/documentation/transitions/から好みのanimationを選んで置き換えられます。
        delay: 7000,    //次の画像を表示するまでの時間
        animationDuration: 6000,	//アニメーション間の引き継ぎタイミング。ズームアウトが完了する秒数？
      });
    }, 1000);//3秒遅れてスライドショーがスタート
  }

  function slideSp() {
    setInterval(function () {
      $('#mainimg').vegas({
        slides: [
          { src: './images/sp/IMG_01.jpg' },	//1枚目の写真指定
          { src: './images/sp/IMG_07.jpg' },	//2枚目の写真指定
          { src: './images/sp/IMG_03_1.jpg' },	//3枚目の写真指定
          { src: './images/sp/IMG_03_2.jpg' },	//3枚目の写真指定
          // { src: './images/sp/IMG_03_3.jpg' },	//3枚目の写真指定
          // { src: './images/sp/IMG_08.jpg' },	//2枚目の写真指定
          { src: './images/sp/IMG_09.jpg' },	//2枚目の写真指定
          // { src: './images/sp/IMG_10.jpg' },	//2枚目の写真指定
          { src: './images/sp/IMG_11.jpg' },	//2枚目の写真指定
        ],
        overlay: true,//写真上にドットを重ねる。不要ならこの１行を削除して下さい。
        transition: 'blur',   //https://vegas.jaysalvat.com/documentation/transitions/から好みのtransitionを選んで置き換えられます。
        animation: 'kenburns',//https://vegas.jaysalvat.com/documentation/transitions/から好みのanimationを選んで置き換えられます。
        delay: 5000,    //次の画像を表示するまでの時間
        // animationDuration: 20000,	//アニメーション間の引き継ぎタイミング。
      });
    }, 1000);//3秒遅れてスライドショーがスタート
  }
});
