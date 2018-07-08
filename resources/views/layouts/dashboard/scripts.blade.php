<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

<script>
 // Workaround to add active class to parent of links that are not in sidebar
 var url = window.location.href;
 $(function () {
  $('[data-toggle="tooltip"]').tooltip();

// V2
if (!$(".sidebar-nav a[href='"+url+"']").length) {
  var i;
  var z = 1;
  for (i = 0; i < url.split('/').length; i++) {
    if ($(".sidebar-nav a[href='"+url+"']").length) {
      $("a[href='"+url+"']").addClass('active');
      $("a[href='"+url+"']").parent().addClass('open').parent().parent().addClass('open');
      break;
    } else {
      url = url.split('/');
      url.pop();
      url = url.join('/');
    }
  }
}
});
</script>
