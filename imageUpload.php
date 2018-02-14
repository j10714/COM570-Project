<?php
	function image_Upload($fileDest, $file_name, $file_tmp, $file_size, $file_error) 
	{
		//extension
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));
		
		$allowed = array('jpg', 'png', 'jpeg');
		$dataRows=0;
		
		if(in_array($file_ext, $allowed))
		{
			if($file_error === 0)
			{
				if($file_size <= 5242880)
				{
					$file_destination = $fileDest.$file_name;
					//$file_destination = '/kunden/homepages/11/d703192015/htdocs/Project/Contractors/Developments/images/'. $file_name .'';
					if(move_uploaded_file($file_tmp, $file_destination))
					{
						$dataRows=1;
						//echo "<script>window.location.href ='/Project/index.php'</script>";
						return true;
					}
				}
			}
		}
		if ($dataRows <=0)
		{
			return false;
		}
	}
?>