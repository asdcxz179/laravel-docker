<?php

namespace Byg\Admin\Helpers\Universal;
/**
 * 
 */
class Universal
{
	static function version($file){
		if(file_exists(public_path($file))){
			return $file.'?v='.filemtime(public_path($file));
		}else{
			return $file;
		}
	}

	static function permissionEnable() {
		return (class_exists('Byg\Permission\PermissionServiceProvider') && config('admin.permission'));
	}
}