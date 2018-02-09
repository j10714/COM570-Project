<?php
	include ("dbConnect.php");

		if(isset($_FILES['file'])) 
	{   
        $file = $_FILES['file'];
        
		//file properties
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];
        
        //add to database
        $name = $_POST["name"];
		$motw = 0;
			
		$dbQuery=$db->prepare("insert into memes values (null,:name,:filename,:motw)");
		$dbParams=array('name'=>$name, 'filename'=>$file_name, 'motw'=>$motw);
		$dbQuery->execute($dbParams);

		//extension
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));

		$allowed = array('jpg', 'png', 'jpeg');

		if(in_array($file_ext, $allowed))
		{
			if($file_error === 0)
			{
				if($file_size <= 5242880)
				{
					$file_destination = '/kunden/homepages/11/d703192015/htdocs/Project/images/'. $file_name .'';
					//$file_destination = '/kunden/homepages/20/d664340320/htdocs/memes.dylankeys.com/memes/'. $file_name .'';
					if(move_uploaded_file($file_tmp, $file_destination))
                    {
                        header("Location: index.php?upload=1");
                    }
				}
			}
		}
	}
?>
