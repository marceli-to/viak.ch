export default {

  data() {
    return {
      coords: {},
      cropW: null,
      cropH: null,
      cropImage: null,

      defaults: {
        w: 400,
        h: 300,
        x: 0,
        y: 0
      },

      isCropping: false,
      isLoading: false,
    };
  },

  methods: {

    change({ coordinates, canvas }) {
      this.coords.h = coordinates.height;
      this.coords.w = coordinates.width;
      this.coords.y = coordinates.top;
      this.coords.x = coordinates.left;
      this.cropW = Math.floor(coordinates.width);
      this.cropH = Math.floor(coordinates.height);
    },

    updateImage(image) {
      image.coords_w = this.coords.w;
      image.coords_h = this.coords.h;
      image.coords_x = this.coords.x;
      image.coords_y = this.coords.y;
      this.$emit('updateImage', image);
      this.hideCropper();
    },

    defaultPosition() {
      let x = this.currentImage.coords_x || this.defaults.x;
      let y = this.currentImage.coords_y || this.defaults.y;
      return {
        left: x,
        top: y
      };
    },

    defaultSize() {
      let w = this.currentImage.coords_w || this.defaults.w;
      let h = this.currentImage.coords_h || this.defaults.h;
      return {
        width: w,
        height: h
      };
    },
    
    showCropper(image) {
      this.isLoading = true;
      this.isCropping = true;
      this.currentImage = image;
      this.axios.get(this.getSource(image, "original")).then(response => {
        this.cropImage = response.config.url;
        this.isLoading = false;
      });
    },

    hideCropper() {
      this.isCropping = false;
      this.currentImage = {
        caption: null,
        description: null,
        orientation: null
      };
      this.cropImage = null;
    }
  }
};