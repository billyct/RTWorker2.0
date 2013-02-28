<?php

class FileUploader {
	
	function __construct() {
		
	}
	
	public function upload() {
		//图片的一些约束，还需修改
		$allowedExtensions = array("jpeg", "jpg", "png");
		$sizeLimit = 10 * 1024 * 1024;
		
		require_once __DIR__.'/qqFileUploader/qqFileUploader.php';
		require_once __DIR__.'/phpThumb/ThumbLib.inc.php';
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		
		//上传图片，以md5(uniqid())来生成图片名称
		$result = $uploader->handleUpload(PUBLICPATH.'/uploads/images');
		//定义大小图片图片的基于public的路径
		$path = '/uploads/images/'.$uploader->getUploadName();
		$path_thumb = '/uploads/image_thumbs/'.$uploader->getUploadFileName().'_thumb'.$uploader->getUploadExt();
		
		
		//定义小图片的大小并设置
		$thumb = PhpThumbFactory::create(PUBLICPATH.$path);
		$thumb_width = 64;
		$imageInfo = getimagesize(PUBLICPATH.$path);
		$imageInfo = ($imageInfo[0]>$imageInfo[1])?$imageInfo[0]:$imageInfo[1];
		if ($imageInfo > $thumb_width) {
			$thumb->resizePercent($thumb_width/$imageInfo*100);
		}
		$thumb->save(PUBLICPATH.$path_thumb);
		
		$result = array_merge($result, array(
// 				'path' => base_url($path),
// 				'path_thumb' => base_url($path_thumb),
				'path' => $path,
				'path_thumb' => $path_thumb,
		));
		
		return $result;
	}
	
}

?>