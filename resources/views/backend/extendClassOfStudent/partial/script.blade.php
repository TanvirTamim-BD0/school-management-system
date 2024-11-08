<script>
    //To fetch all the section & subject with classId...
    $("#class_id").change(function () {
        var classId = $(this).val();
        var url = "{{ route('get-all-section-and-subject-with-class-id') }}";
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
                    //For Section...
                    $("#section_id").empty();
                    $("#section_id").append('<option value="" selected disabled>Select Section *</option>');

                    $.each(data.sectionData, function(key,value){
                        $("#section_id").append('<option value="'+value.id+'">'+value.section_name+'</option>');
                    });

                }

            });
        }
    });
    
    //To fetch all the section & subject with classId...
    $("#to_class_id").change(function () {
        var classId = $(this).val();
        var url = "{{ route('get-all-section-and-subject-with-class-id') }}";
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
                    //For Section...
                    $("#to_section_id").empty();
                    $("#to_section_id").append('<option value="" selected disabled>Select Section</option>');
                    $("#to_section_id").append('<option value="Out Of The Section">Out Of The Section</option>');

                    $.each(data.sectionData, function(key,value){
                        $("#to_section_id").append('<option value="'+value.id+'">'+value.section_name+'</option>');
                    });


                }

            });
        }
    });
</script>