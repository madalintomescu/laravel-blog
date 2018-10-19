<template>
  <select :name="this.name" :id="this.id" class="form-control" :multiple="this.multiple" :model="this.vModel">
    <slot></slot>
  </select>
</template>

<script>
import select2 from 'select2';

export default {
  props: ['name', 'id', 'multiple', 'vModel'],
  mounted: function () {
    var vm = this;

    $(this.$el).select2().trigger('change').on('change', function () {
      let values = [];

      // Insert into array the value when is selected
      $(this).find(':selected').each(function(i, item) {
        values.push(item.textContent);
      });

      vm.$emit('input', values);
    });
  },
  destroyed: function () {
    $(this.$el).off().select2('destroy');
  }
};
</script>

<style>
.select2-selection.select2-selection--multiple {
  line-height: 1.5 !important;
  color: #495057 !important;
  background-color: #fff !important;
  background-clip: padding-box !important;
  border: 1px solid #ced4da !important;
  border-radius: 0.25rem !important;
}
</style>
