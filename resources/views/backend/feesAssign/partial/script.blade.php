<script>
    //To fetch all the section & subject with classId...
    $("#class_id").change(function () {
        var classId = $(this).val();
        var url = "{{ route('class-wise-fees-type') }}";
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
                    class_id: classId
                },
                success: function (data) {
                    //For Section...
                    $("#fees_type_id").empty();
                    $("#fees_type_id").append('<option value="" selected disabled>Select Fees Type *</option>');

                    $.each(data, function(key,value){
                        $("#fees_type_id").append('<option value="'+value.id+'">'+value.fees_type+'</option>');
                    });
                }

            });
        }
    });
</script>