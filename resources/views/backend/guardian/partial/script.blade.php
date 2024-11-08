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
    $("#section_id").change(function () {
        var sectionId = $(this).val();
        var url = "{{ route('get-student-sectionId-wise') }}";
        if (sectionId != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    section_Id: sectionId
                },
                success: function (data) {
                    //For Section...
                    $("#student_id").empty();
                    $("#student_id").append('<option value="" selected disabled>Select Student *</option>');

                    $.each(data, function(key,value){
                        $("#student_id").append('<option value="'+value.id+'">'+value.student_name+'</option>');
                    });

                }

            });
        }
    });

</script>