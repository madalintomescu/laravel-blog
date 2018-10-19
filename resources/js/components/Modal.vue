<template>
  <div>
    <button data-toggle="modal" data-target="#formModal" class="btn btn-sm btn-primary">
      {{ buttonText }}
    </button>

    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="formModalLabel">
              {{ title }}
            </h5>
            <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <slot></slot>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['title', 'buttonText']
};
</script>
