<div class="notification is-toast js-toast {{ $style == 'success' ? 'is-success' : 'is-error' }}">
  <div class="notification__inner">
    <div class="notification-message">
      {{$message}}
    </div>
  </div>
</div>
<script>
(function () {
  const toast = document.querySelector('.js-toast');
  toast.addEventListener("click", function(){
    toast.style.display = 'none';
  }, false);
})();
</script>