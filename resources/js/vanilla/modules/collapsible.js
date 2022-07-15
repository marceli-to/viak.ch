(function () {

  const classes = {
    expanded: 'is-expanded',
  };

  const selectors = {
    body:  		'body',
    wrapper:	'.js-clpsbl', 
    content:	'.js-clpsbl-body',
    btn:		  '.js-clpsbl-btn',
  };

  const init = () => {
    const btns = document.querySelectorAll(selectors.btn);
    const btnsArray = [].slice.call(btns);
    btnsArray.forEach(function (btn) {
      btn.addEventListener("click", function(){
        toggle(this);
      }, false);
    });
  };

  const toggle = (btn) => {
    const wrapper = btn.closest(selectors.wrapper);
    wrapper.classList.toggle(classes.expanded);
    const content = wrapper.querySelector(selectors.content);
    content.style.display = content.style.display == 'none' ? 'block' : 'none';
  };

  init();
  
})();

