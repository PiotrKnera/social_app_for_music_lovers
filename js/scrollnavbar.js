var x = window.matchMedia("(min-width: 768px)");

var menu_open = 0;

window.onscroll = function() {scrollFunction(x)};

function scrollFunction(x) {

  if(window.scroll_nav == true){
    if (x.matches) {
      if (document.body.scrollTop > 35 || document.documentElement.scrollTop > 35) {
        document.getElementById("navbar").style.top = "0";
      } else {
          document.getElementById("navbar").style.top = "-65px";
      }
    }else{
      if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
        document.getElementById("navbar").style.top = "0";
      }else {
        if(window.menu_open == 0){
          document.getElementById("navbar").style.top = "-65px";
        }
      }
    }
  }else{
    document.getElementById("navbar").style.top = "0";
  }

}

// hiding menu after clicking an option
$('.navbar-nav>li>a').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});

$('.navbar-brand').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});

$('.dropdown-item').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});

function menu_opened(){
  if(window.menu_open == 0){
    window.menu_open = 1;
  }else{
    window.menu_open = 0;
  }
}
