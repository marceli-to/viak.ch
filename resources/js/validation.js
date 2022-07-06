(function () {

  const classes = {
    valid: 'is-valid',
    invalid: 'is-invalid',
  };

  const init = function() {
    const els = document.querySelectorAll('input[required]');
    for (let i = 0; i < els.length; i++) {
      els[i].addEventListener("blur", validate, false);
      els[i].addEventListener("focus", clear, false);
    };
  };

  const validate = function(el){
    if (el.target.type == 'email') {
      let filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if (!filter.test(el.target.value)) {
        el.target.classList.add(classes.invalid);
        return;
      }
      el.target.classList.add(classes.valid);
      return;
    }
    else if (el.target.type == 'password') {
      if (el.target.value.length < 6) {
        el.target.classList.add(classes.invalid);
        return;
      }
      el.target.classList.add(classes.valid);
      return;
    }
    else {
      if (el.target.value.length == 0) {
        el.target.classList.add(classes.invalid);
        return;
      }
      el.target.classList.add(classes.valid);
      return;
    }
  };

  const clear = function(el) {
    el.target.classList.remove(classes.invalid);
    el.target.classList.remove(classes.valid);
  };

  window.onload = init;
  
})();