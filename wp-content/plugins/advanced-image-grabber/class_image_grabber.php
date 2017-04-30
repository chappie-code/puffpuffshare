<?php
class Advanced_Image_Grabber{
	static $validImageFormat = array( "jpg","png","gif","tif" );
	//takes urls as an array (max 5) and return all valid image urls
	static public function getImageUrl($urls){
		if(count($urls)>5):
			return NULL;
		endif;
		$validImageFormat = array( "jpg","png","gif","tif" );
		$ch = curl_init();
		foreach($urls as $url):
			$url = trim($url);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);
    		$doc = new DOMDocument();
			// set error level
			$internalErrors = libxml_use_internal_errors(true);
    		$doc->loadHTML($data);
			// Restore error level
			libxml_use_internal_errors($internalErrors);
    		$imageTags = $doc->getElementsByTagName('img');
	    	foreach($imageTags as $tag) :
				$imageFormat = strtolower(substr($tag->getAttribute('src'),-3));
				if(in_array($imageFormat, self::$validImageFormat)): //Check for valid image file
					$imageUrlList[] = $tag->getAttribute('src');
				endif;
			endforeach;
		endforeach;
		curl_close($ch);
		return $imageUrlList; 
	} //EOF
	
	//takes an image url as argument and save is to media library // return Null on failure
	static public function imageUpload($imageUrl) {
		$file = array();
		$file['name'] = basename($imageUrl);
		$file['tmp_name'] = download_url($imageUrl);
		if (is_wp_error($file['tmp_name'])):
		@unlink($file['tmp_name']);
		return NULL;
		endif;
		$attachmentId = media_handle_sideload($file, 0);
		// create the thumbnails
		$attach_data = wp_generate_attachment_metadata( $attachmentId,  get_attached_file($attachmentId));
		wp_update_attachment_metadata( $attachmentId,  $attach_data );
		return $attachmentId;	
	}//EOF
}
?>