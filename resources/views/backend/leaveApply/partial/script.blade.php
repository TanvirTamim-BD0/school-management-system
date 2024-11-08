<script>
    //To fetch all the user with roleId...
    $("#role_id").change(function () {
        var roleId = $(this).val();
        var url = "{{ route('role-wise-get-user') }}";
        if (roleId != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    role_id: roleId
                },
                success: function (data) {
                    console.log(data);
                    //For user...
                    $("#leave_application_to").empty();
                    $("#leave_application_to").append('<option value="" selected disabled>Select User</option>');

                    $.each(data, function(key,value){

                        $("#leave_application_to").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }

            });
        }
    });
</script>