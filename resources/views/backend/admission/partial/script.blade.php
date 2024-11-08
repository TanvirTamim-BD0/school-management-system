<script src="{{ asset('backend') }}/app-assets/vendors/dropify/js/dropify.min.js"></script>
  <script src="{{ asset('backend') }}/app-assets/js/scripts/form-file-uploads.js"></script>

<script>
    //To fetch all the section & subject with classId...
    $("#class_id").change(function () {
        var classId = $(this).val();
        var url = "{{ route('class-wise-fees') }}";
        if (classId != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    class_Id: classId
                },
                success: function (data) {
                     $("#fees").val(data.fees_amount);
                }

            });
        }
    });
</script>