<script>
    //To fetch all the section & subject with classId...
    $("#class_id").change(function () {
        var classId = $(this).val();
        var url = "{{ route('class-wise-section') }}";
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
                    $("#section_id").empty();
                    $("#section_id").append('<option value="" selected disabled>Select Section *</option>');

                    $.each(data, function(key,value){
                        $("#section_id").append('<option value="'+value.id+'">'+value.section_name+'</option>');
                    });
                }

            });
        }
    });
    
    //To fetch all the student with sectionId...
    $("#section_id").change(function () {
        var classId = $("#class_id").val();
        var sectionId = $(this).val();
        var url = "{{ route('class-and-section-wise-student') }}";
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
                    class_id: classId,
                    section_id: sectionId
                },
                success: function (data) {
                    //For Section...
                    $("#student_id").empty();
                    $("#student_id").append('<option value="" selected disabled>Select Student *</option>');

                    $.each(data, function(key,value){
                        $("#student_id").append('<option value="'+value.id+'">'+value.student_name+'</option>');
                    });

                    $("#student_id").select2();
                }

            });
        }
    });
</script>