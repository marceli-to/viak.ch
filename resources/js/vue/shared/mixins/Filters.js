Vue.filter('truncate', function (text, length, suffix) {
  if (text){
    let t = text.replace(/(<([^>]+)>)/ig,"");
    if (t.length > length) {
      return t.substring(0, length) + suffix;
    }
    else {
      return t;
    }
  }
});

Vue.filter('currency', function(value) {
  if (value > 0) {
    return  new Intl.NumberFormat('de-CH', {minimumFractionDigits: 2}).format(value);
  }
  return '–';
});

Vue.filter('padStart', function(value) {
  return String(value).padStart(2, '0');
});

Vue.filter('nl2br', function(str, replaceMode) {
  if (str == null) return;
  var breakTag = '<br>';
  var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
});

Vue.filter('fileSize', function(bytes,decimalPoint) {
  if(bytes == 0) return '0 Bytes';
  var k = 1000, dm = decimalPoint || 2, sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'], i = Math.floor(Math.log(bytes) / Math.log(k));
  return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
});