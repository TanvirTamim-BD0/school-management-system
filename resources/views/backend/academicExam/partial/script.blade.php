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
                    $("#section_id").append('<option value="">Select Section *</option>');
                    
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

</script>