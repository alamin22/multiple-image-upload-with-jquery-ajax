public function studentImagesStore(Request $request){
	    try{
			if($request->hasFile('student_images'))
			{
				$student_index=$request->student_index;
	    		$id_explode=explode(",",$student_index);
	    		$images=$request->file('student_images');
	    		
				foreach ($images as $file){
				$fileName= rand(1, 999).time().$file->getClientOriginalName();
				$location=public_path('/images/student');
				$file->move($location,$fileName);
				}
				$data=StudentInfo::where('student_info_id','=',$id_explode)
						->update(['student_info_image'=>$fileName]);
		        	
				return response()->json(array('status'=>'Success', 'Message' => 'Files Received'));
			}
			else
			{
				return response()->json(array('status'=>'error', 'Message' => 'Request Not contain any file.'));
			}
	    	
    	}catch(Exception $e){
    		return response()->json(array('status'=>'error','error'=>$e->getMessage()));
	    	}
    }
