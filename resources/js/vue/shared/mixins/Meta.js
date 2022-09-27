export default {

  data() {
    return {  
      pageTitleSuffix: ' • Visualisierungs-Akademie Schweiz GmbH', 
      pageTitle: document.querySelector('title'),
      siteTitle: document.querySelector('.site-header__title h1'),
    };
  },

  methods: {
    setTitle(value) {
      this.siteTitle.textContent = value;
      this.pageTitle.textContent = value + this.pageTitleSuffix;
    }
  }

};