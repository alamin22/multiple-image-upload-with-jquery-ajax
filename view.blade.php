 
 <input type="file" name="student_images[]" id="student_images" class="uploadFile img" value="Upload Photo" style="width: 0px;height:0px;overflow: hidden;text-align: center;" enctype="multipart/form-data" multiple>
 
 
 function insertImage(){
        
         let student_index= $("input[name='student_index[]']").map(function(){return $(this).val();}).get();

        var formdata = new FormData();
			var files= $("input[name='student_images[]']").map(function(){return $(this).val();}).get();
			
            for(var i=0;i<files.length;i++){
                formdata.append("student_images", files[i]);  
            }
			$.each($("input[name='student_images[]']"), function(index, file) {
				formdata.append('student_images[]', $('input[type=file]')[index].files[0]);
				console.log($('input[type=file]')[index].files[0]);
			});
			
            $.ajax({
              url: "{{route('school.studentImagesStore')}}",
              type: "POST",
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              processData:false,
              contentType:false,
              data:formdata,
              /*datatype:"json",*/
			  cache: false,
              success:function(data){
                console.log(data);
              },
              erorr:function(error){
                console.log(error);
             }
        });

    }
