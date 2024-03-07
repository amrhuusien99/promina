<?php
	use Illuminate\Support\Facades\File;

	define('PAGINATION_COUNT', 10);
	define('PAGINATION_COUNT_FRONT', 15);
	define('PAGINATION_COUNT_40', 40);

	function uploadIamge($photo, $folder){
		$destinationPath = 'admin/assets/images/' . $folder . '/'; // upload path
        $fileName = time() . $photo->hashName();  
		$photo_move = $photo->move(public_path($destinationPath), $fileName);
		return $destinationPath . $fileName;
	}

	function uploadIamges($photos, $folder){
		$images = [];
		foreach ($photos as $photo){
			$destinationPath = 'admin/assets/images/' . $folder . '/'; // upload path
			$fileName = time() . $photo->hashName();  
			$photo_move = $photo->move(public_path($destinationPath), $fileName);
			$images[] = $destinationPath . $fileName;
		}
		$files = implode(",", $images);
		return $files;
	}

	function uploadIamgesForRelation($photos, $folder){
		$images = [];
		$destinationPath = 'admin/assets/images/' . $folder . '/'; // upload path
		foreach ($photos as $photo){
			$fileName = time() . $photo->hashName();  
			$photo_move = $photo->move(public_path($destinationPath), $fileName);
			$images[] = [
				'img' => $destinationPath . $fileName
			];
		}
		return $images;
	}

	function responseJson($status, $msg, $data = null)
	{
		$response = [
			'status' => $status,
			'msg' => $msg,
			'data' => $data
		];
		return response()->json($response);
	}
