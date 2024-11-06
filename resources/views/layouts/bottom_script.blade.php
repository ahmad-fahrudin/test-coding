<!--begin::Javascript-->
<script>
    var hostUrl = "metronic/assets/";
</script>

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

<!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
<script src="{{ asset('metronic/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/plugins/custom/ckeditor/ckeditor-inline.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/plugins/custom/ckeditor/ckeditor-balloon.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/plugins/custom/ckeditor/ckeditor-balloon-block.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/plugins/custom/ckeditor/ckeditor-document.bundle.js') }}"></script>
