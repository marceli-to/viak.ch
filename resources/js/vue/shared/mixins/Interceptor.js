import NProgress from 'nprogress';

export default {
  
  mounted() {
    window.intercepted.$on('response:200', data => {
      this.success(data);
    });

    window.intercepted.$on('response:401', data => {
      this.unauthorized(data);
    });

    window.intercepted.$on('response:403', data => {
      this.forbiddenError(data);
    });

    window.intercepted.$on('response:404', data => {
      this.notFoundError(data);
    });

    window.intercepted.$on('response:405', data => {
      this.notAllowed(data);
    });

    window.intercepted.$on('response:413', data => {
      this.contentTooLarge(data);
    });

    window.intercepted.$on('response:418', data => {
      this.validationError(data);
    });

    window.intercepted.$on('response:419', data => {
      this.unauthorized(data);
    });

    window.intercepted.$on('response:422', data => {
      this.validationError(data);
    });

    window.intercepted.$on('response:500', data => {
      this.serverError(data);
    });

  },

  beforeDestroy(){
    window.intercepted.$off('response:200', this.listener);
    window.intercepted.$off('response:401', this.listener);
    window.intercepted.$off('response:403', this.listener);
    window.intercepted.$off('response:404', this.listener);
    window.intercepted.$off('response:405', this.listener);
    window.intercepted.$off('response:419', this.listener);
    window.intercepted.$off('response:422', this.listener);
    window.intercepted.$off('response:500', this.listener);
  },

  methods: {

    success() {
      NProgress.done();
      this.$store.commit('isLoading', false); 
    },

    validationError() {
      NProgress.done();
      this.$toast.open({
        'message': 'Bitte alle mit * markierten Felder prüfen!',
        'type': 'error'
      });   
    },

    serverError(data) {
      NProgress.done();
      this.$store.commit('isLoading', false);
      this.$toast.open({
        'message': `${data.status} ${data.code}<br>${data.body.message}`,
        'type': 'error',
        'duration': 0
      });  
    },

    contentTooLarge(data) {
      NProgress.done();
      this.$store.commit('isLoading', false);
      this.$toast.open({
        'message': `${data.status} ${data.code}<br>${data.body.message}`,
        'type': 'error',
        'duration': 0
      });
    },

    notFoundError(data) {
      NProgress.done();
      this.$store.commit('isLoading', false);
      this.$router.push({ name: 'not-found' });
    },

    notAllowed(data) {
      NProgress.done();
      this.$store.commit('isLoading', false);
      this.$toast.open({
        'message': `${data.status} ${data.code}<br>${data.body.message}`,
        'type': 'error',
        'duration': 0
      });
    },

    forbiddenError(data) {
      NProgress.done();
      this.$store.commit('isLoading', false);
      this.$router.push({ name: 'forbidden' });
    },

    unauthorized(data) {
      NProgress.done();
      this.$store.commit('isLoading', false);
      document.location.href = '/login';
    },
  },
};
