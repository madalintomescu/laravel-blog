<template>
  <div class="col">
    <div class="callout my-3 p-3 bg-white rounded box-shadow" :class="borderColor">
      <small class="text-muted display-block">{{ title }}</small>
      <strong class="h4">{{ value }}</strong>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    value: {
      type: String,
      required: true
    },
    color: {
      type: String,
      required: false,
      default: 'grey'
    }
  },
  data: function() {
    return {
      borderColor: 'border-left-' + this.color
    }
  }
};
</script>

<style>
.border-left-red {border-left-color: #f44336;}
.border-left-pink {border-left-color: #e91e63;}
.border-left-purple {border-left-color: #9C27B0;}
.border-left-blue {border-left-color: #2196f3;}
.border-left-green {border-left-color: #4caf50;}
.border-left-yellow {border-left-color: #ffeb3b;}
.border-left-orange {border-left-color: #ff9800;}
.border-left-brown {border-left-color: #795548;}
.border-left-grey {border-left-color: #9E9E9E;}
</style>
