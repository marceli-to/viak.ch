export default {

  data() {
    return {
      hasSort: false,
      sortBy: '',
      sortDirection: 'asc'
    };
  },

  methods: {
    sort(s){
      if (s === this.sortBy) {
        this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
      }
      this.hasSort = true;
      this.sortBy = s;
    }
  },
  computed: {
    sortedData(){
      return _.orderBy(this.data, this.sortBy, this.sortDirection);
    }
  },
};