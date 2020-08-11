<template>
<div class="modal fade modalTop" id="request-error" data-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body text-center" >
             <font class="error500" v-text="trans('common.Error_500')"></font> <br>
             <font size="6px" v-text="trans('common.Internal_server_error')"></font>
            <div class="bttn-right btnBorder">
              <button type="button"
                class="btn btn-primary outline-btn"
                data-dismiss="modal" aria-label="Close">{{ trans('common.Ok')}}
              </button>
            </div>
         </div>
      </div>
   </div>
</div>
</template>
<script>
export default{
  computed: {
    error500() {
      return this.$store.state.exceptionModule.error500;
    },
  },
  watch: {
    error500(error) {
      if (error) {
        $('#request-error').modal('show');
      }
    },
  },
  created() {
    this.$store.commit('RESET_ERROR_500');
  },
};
</script>
