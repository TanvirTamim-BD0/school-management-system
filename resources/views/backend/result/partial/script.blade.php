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
                    
                    //For Subject...
                    $("#subject_id").empty();
                    $("#subject_id").append('<option value="" selected disabled>Select Subject *</option>');
                    
                    $.each(data.subjectData, function(key,value){
                        $("#subject_id").append('<option value="'+value.id+'">'+value.subject_name+'</option>');
                    });
                }

            });
        }
    });
    
    //To fetch all the subject with sectionId...
    $("#subject_id").change(function () {
        var classId = $("#class_id").val();
        var sectionId = $("#section_id").val();
        var subjectId = $(this).val();
        if(sectionId != ''){
             var url = "{{ route('class-and-subject-wise-exam-and-student') }}";
            if (subjectId != '') {
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
                        section_id: sectionId,
                        subject_id: subjectId,
                    },
                    success: function (data) {
                        //For Exam...
                        $("#exam_id").empty();
                        $("#exam_id").append('<option value="" selected disabled>Select Exam *</option>');

                        $.each(data.examData, function(key,value){
                            $("#exam_id").append('<option value="'+value.id+'">'+value.exam_name+'</option>');
                        });

                        //For Student...
                        $("#student_id").empty();
                        $("#student_id").append('<option value="" selected disabled>Select Student *</option>');
                        
                        $.each(data.studentData, function(key,value){
                        $("#student_id").append('<option value="'+value.id+'">'+value.student_name+'</option>');
                        });
                    }

                });
            }
        }else{
            $("#subject_id").val('');
            toastr.error('First select section.!');
        }
       
    });
</script>