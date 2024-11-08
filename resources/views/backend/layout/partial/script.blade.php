<!-- BEGIN VENDOR JS-->
<script src="{{ asset('backend') }}/app-assets/js/vendors.min.js"></script>
<!-- BEGIN VENDOR JS-->

<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ asset('backend') }}/app-assets/vendors/select2/select2.full.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/vendors/noUiSlider/nouislider.js"></script>
<script src="{{ asset('backend') }}/app-assets/vendors/dropify/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/form-file-uploads.js"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN THEME  JS-->
<script src="{{ asset('backend') }}/app-assets/js/plugins.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/search.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/custom/custom-script.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/customizer.js"></script>
<!-- END THEME  JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('backend') }}/app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
<!-- BEGIN: Datatable JS-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js">
</script>
<!-- END: Datatable JS-->
<script src="{{ asset('backend') }}/app-assets/vendors/data-tables/js/dataTables.select.min.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/data-tables.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/dashboard-modern.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/form-validation.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/form-select2.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/page-account-settings.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/page-users.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/form-elements.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/advance-ui-modals.js"></script>
<script src="{{ asset('backend') }}/app-assets/js/scripts/app-invoice.js"></script>
<!-- END PAGE LEVEL JS-->

<script src="{{ asset('backend') }}/app-assets/js/scripts/form-editor.js"></script>
<script src="{{ asset('backend') }}/custom/js/custom.js"></script>
<script src="{{ asset('backend') }}/custom/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script src="{{asset('backend')}}/custom/js/tinymce.min.js"></script>

<script>
    var editor_config = {
            path_absolute : "/",
            selector: "#description",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
</script>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            scrollY: false,
            scrollX: true,
            lengthChange: true,
            ordering: true,
            searching: true,
        });
       
        $('#commonTable').DataTable({
            scrollY: true,
            scrollX: true,
            lengthChange: false,
            ordering: true,
            searching: false,
        });
    } );
</script>
<!--end::Javascript-->