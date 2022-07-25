export default {

  methods: {

    moneyFormat(amount) {
      return amount.toFixed(2);
    },

    shorten(str, length = 10, suffix = "...") {
      return str.substring(0, length) + suffix;
    },

    randomString() {
      return Math.random().toString(36).slice(2);
    },
    
    getImageSrc(image, template, size = 1600) {
      let coords = '0,0,0,0';
      if (image.coords_w && image.coords_h) {
        coords = `${image.coords_w},${image.coords_h},${image.coords_x},${image.coords_y}`;
      }
      return `/img/${template}/${image.name}/${size}/${coords}/3x2`;
    },

    nl2br(str, replaceMode) {
      if (str == null) return;
      var breakTag = '<br>';
      var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
      return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
    }
  }
};