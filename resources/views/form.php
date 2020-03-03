<html lang="en" class=" scrollbar-y phablet"><head>
<meta charset="UTF-8">
<link rel="apple-touch-icon" type="image/png" href="https://static.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">
<meta name="apple-mobile-web-app-title" content="CodePen">
<link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
<title>แบบสำรวจก่อนพัฒนาจริง แอพถามพระ</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  padding: 25px;
  background-color: #f4f1bb;
  color: #808080;
  	text-align: center;	
}

/*-=-=-=-=-=-=-=-=-=-=-=- */
/* Column Grids */
/*-=-=-=-=-=-=-=-=-=-=-=- */

.col_half { width: 49%; }
.col_third { width: 32%; }
.col_fourth { width: 23.5%; }
.col_fifth { width: 18.4%; }
.col_sixth { width: 15%; }
.col_three_fourth { width: 74.5%;}
.col_twothird{ width: 66%;}
.col_half,
.col_third,
.col_twothird,
.col_fourth,
.col_three_fourth,
.col_fifth{
	position: relative;
	display:inline;
	display: inline-block;
	margin-right: 2%;
	margin-bottom: 20px;
}
.end { margin-right: 0 !important; }
/* Column Grids End */

.wrapper { width: 980px; margin: 30px auto; position: relative;}
.counter { background-color: #fff994; padding: 20px 0; border-radius: 5px;margin-bottom: 20px;}
.count-title { font-size: 40px; font-weight: normal;  margin-top: 10px; margin-bottom: 0; text-align: center; }
.count-text { font-size: 13px; font-weight: normal;  margin-top: 10px; margin-bottom: 0; text-align: center; }
.fa-2x { margin: 0 auto; float: none; display: table; color: #4ad1e5; }
</style>
<script>
  window.console = window.console || function(t) {};
</script>
<script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
</head>
<body translate="no">
<h1>มาร่วมสถาปนา แอพถามพระ</h1>
<h3>จะพัฒนาจริงเมื่อมีผลโหวตครบ 1,000 โหวต</h3>

<div class="counter col_fourth">
<i class="fa fa-lightbulb-o fa-2x"></i>
<h2 class="timer count-title count-number" data-to="11900" data-speed="1500">11,900 {{ $count }}</h2>
<p class="count-text ">การโหวต</p>
</div>

<a href="https://jaipun.com/prototype" style="
    cursor: pointer;
    position: relative;
    text-align: center;
    display: block;
    width: 230px;
    height: 58px;
    text-decoration: none;
    font-size: 25px;
    font-weight: 600;
    overflow: hidden;
    margin: auto;
    color:#fff;
    padding: 20px 0px 0 0;
    border-radius: 20px;
    background: #007eff !important;
    ">ร่วมสถานปนา!!</a>

<img style="-webkit-user-select: none;margin: auto;cursor: zoom-in;margin-top: 40px;" src="https://sv1.picz.in.th/images/2020/03/04/xJEgun.png" width="529" height="529">
<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script id="rendered-js">
(function ($) {
  $.fn.countTo = function (options) {
    options = options || {};

    return $(this).each(function () {
      // set options for current element
      var settings = $.extend({}, $.fn.countTo.defaults, {
        from: $(this).data('from'),
        to: $(this).data('to'),
        speed: $(this).data('speed'),
        refreshInterval: $(this).data('refresh-interval'),
        decimals: $(this).data('decimals') },
      options);

      // how many times to update the value, and how much to increment the value on each update
      var loops = Math.ceil(settings.speed / settings.refreshInterval),
      increment = (settings.to - settings.from) / loops;

      // references & variables that will change with each update
      var self = this,
      $self = $(this),
      loopCount = 0,
      value = settings.from,
      data = $self.data('countTo') || {};

      $self.data('countTo', data);

      // if an existing interval can be found, clear it first
      if (data.interval) {
        clearInterval(data.interval);
      }
      data.interval = setInterval(updateTimer, settings.refreshInterval);

      // initialize the element with the starting value
      render(value);

      function updateTimer() {
        value += increment;
        loopCount++;

        render(value);

        if (typeof settings.onUpdate == 'function') {
          settings.onUpdate.call(self, value);
        }

        if (loopCount >= loops) {
          // remove the interval
          $self.removeData('countTo');
          clearInterval(data.interval);
          value = settings.to;

          if (typeof settings.onComplete == 'function') {
            settings.onComplete.call(self, value);
          }
        }
      }

      function render(value) {
        var formattedValue = settings.formatter.call(self, value, settings);
        $self.html(formattedValue);
      }
    });
  };

  $.fn.countTo.defaults = {
    from: 0, // the number the element should start at
    to: 0, // the number the element should end at
    speed: 1000, // how long it should take to count between the target numbers
    refreshInterval: 100, // how often the element should be updated
    decimals: 0, // the number of decimal places to show
    formatter: formatter, // handler for formatting the value before rendering
    onUpdate: null, // callback method for every time the element is updated
    onComplete: null // callback method for when the element finishes updating
  };

  function formatter(value, settings) {
    return value.toFixed(settings.decimals);
  }
})(jQuery);

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
    formatter: function (value, options) {
      return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
    } });


  // start all the timers
  $('.timer').each(count);

  function count(options) {
    var $this = $(this);
    options = $.extend({}, options || {}, $this.data('countToOptions') || {});
    $this.countTo(options);
  }
});
//# sourceURL=pen.js
    </script>


</body></html>