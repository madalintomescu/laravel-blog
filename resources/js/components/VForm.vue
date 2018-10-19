<script>
// Require VeeValidate unique rule for backend validation
require('./veevalidate/uniqueRule.js');

export default {
  props: {
    route: {
      type: String,
      required: true
    },
    successMessage: {
      type: String,
      required: false
    }
  },
  data: function() {
    return {
      inputs: {},
      loading: false
    };
  },
  methods: {
    processForm() {
      this.loading = true;

      this.$validator.validate().then(result => {
        if (!result) {
          this.loading = false;
          return false;
        }
        this.postForm();
      });
    },
    postForm() {
      axios.post(this.route, this.inputs).then(result => {
        this.loading = false;
        this.inputs = {};

        if (this.successMessage) {
          alertify.notify(this.successMessage, 'success', 5);
        }
      }).catch(error => {
        alertify.notify('Error submitting form!', 'error', 5);
        this.loading = false;
      });
    }
  }
};
</script>
