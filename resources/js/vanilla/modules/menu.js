(function () {

  const classes = {
    visible: 'is-visible',
  };

  const selectors = {
    menu: '.js-menu',
    btnShow: '.js-menu-btn-show',
    btnHide: '.js-menu-btn-hide',
  };

  const init = () => {
    const btnShow = document.querySelector(selectors.btnShow);
    const btnHide = document.querySelector(selectors.btnHide);
    btnShow.addEventListener("click", toggle, false);
    btnHide.addEventListener("click", toggle, false);
  };

  const toggle = function(btn){
    const menu = document.querySelector(selectors.menu);
    menu.classList.toggle(classes.visible);
  };

  init();
  
})();