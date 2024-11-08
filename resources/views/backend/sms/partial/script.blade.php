<script>

    //To fetch all the users with roleId...
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
                    //For user...
                    $("#to_account_id").empty();
                    $("#to_account_id").append('<option value="" disabled>Select User *</option>');
                    
                    $.each(data, function(key,value){
                        $("#to_account_id").append('<option value="'+value.id+'">'+value.name+'/'+value.mobile+'</option>');
                    });
                }

            });
        }
    });
</script>