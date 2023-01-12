export default {
  
  methods: {

    handleValidationErrors(data) {
      let errors = [];
      for (let key in data.errors) {
        errors[data.errors[key][0]['field']] = data.errors[key][0]['error'];
      }
      this.errors = errors;
      this.$store.commit('isLoading', false); 
    },

    removeValidationError(field) {
      this.errors[field] = null;
    }
  },
};
