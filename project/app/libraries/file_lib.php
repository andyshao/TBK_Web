<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php

/**

* 操纵文件类

*/

class File_lib {

	var $mime_image=array(
		'swf' => "flash.gif",
		'gif' => "gif.gif",
		'png' => "gif.gif",
		'html' => "html.gif",
		'htm' => "html.gif",
		'jpg' => "jpg.gif",
		'jpeg' => "jpg.gif",
		'jpe' => "jpg.gif",
		'pdf' => "pdf.gif",
		'ppt' => "ppt.gif",
		'txt' => "txt.gif",
		'doc' => "doc.gif",
		'xls' => "xls.gif",
		'csv' => "xls.gif",
		'zip' => "zip.gif",
		'rar' => "zip.gif",
		'gz' => "zip.gif",
		'flv' => "video.gif",
		'mp3' => "video.gif",
		'mp4' => "video.gif",
		'rm' => "video.gif",
		'wmv' => "video.gif",
		'wav' => "video.gif",
		'avi' => "video.gif",
		'notype' => "notype.gif"
	);

    /**

     * 建立文件夹

     *

     * @param    string $aimUrl

     * @return    viod

     */

    function createDir($aimUrl) {

        $aimUrl = str_replace('', '/', $aimUrl);

        $aimDir = '';

        $arr = explode('/', $aimUrl);

        foreach ($arr as $str) {

            $aimDir .= $str . '/';

            if (!file_exists($aimDir)) {

                mkdir($aimDir);

            }

        }
		return TRUE;
    }

    /**

     * 建立文件

     *

     * @param    string    $aimUrl 

     * @param    boolean    $overWrite 该参数控制是否覆盖原文件

     * @return    boolean

     */

    function createFile($aimUrl, $overWrite = false) {

        if (file_exists($aimUrl) && $overWrite == false) {

            return false;

        } elseif (file_exists($aimUrl) && $overWrite == true) {

            $this->unlinkFile($aimUrl);

        }

        $aimDir = dirname($aimUrl);

        $this->createDir($aimDir);

        touch($aimUrl);

        return true;

    }
	
	/**

     * 获取所有文件夹

     *

     * @param    string    $source_dir 
	 
     * @return    array

     */
	function get_all_dir($source_dir)
	{
		//递归时把数组定义成静态的好处是，在递归过程中不会重复定义，而覆盖前面的值
		static $_dirdata = array();
		if ($fp = @opendir($source_dir))
		{
			while (FALSE !== ($file = readdir($fp)))
			{
				if (@is_dir($source_dir.$file) && strncmp($file, '.', 1) !== 0)
				{
					 $_dirdata[]=$source_dir.$file."/";
					 $this->get_all_dir($source_dir.$file);
				}
			}
			return $_dirdata;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**

     * 获取文件夹下面的文件列表

     *

     * @param    string    $source_dir 
	 
	 * @param    boolean    $_recursion 是否递归

     * @return    二维array

     */
	function get_dir_file_info($source_dir)
	{
		$_filedata = array();
		$relative_path = $source_dir;

		if ($fp = @opendir($source_dir))
		{

			while (FALSE !== ($file = readdir($fp)))
			{
				if (@is_dir($source_dir.$file) && strncmp($file, '.', 1) !== 0)
				{
					 $_filedata[$file]['folder_path']=$source_dir.$file."/";
					 $_filedata[$file]['folder_name']=$file;
				}
				elseif (strncmp($file, '.', 1) !== 0)
				{
					$_filedata[$file] = $this->get_file_info($source_dir.$file);
					$_filedata[$file]['relative_path'] = $relative_path;
				}
			}
			return $_filedata;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**

     * 获取单个文件信息

     *

     * @param    string    $file

     * @param    array    $returned_values 获取文件信息选项

     * @return    array

     */
	function get_file_info($file, $returned_values = array('name', 'server_path', 'size', 'date','mime'))
	{

		if ( ! file_exists($file))
		{
			return FALSE;
		}

		if (is_string($returned_values))
		{
			$returned_values = explode(',', $returned_values);
		}
		
		$ext=$this->get_extension($file);
		$fileinfo['file_icon']=isset($this->mime_image[$ext])?$this->mime_image[$ext]:$this->mime_image['notype'];
		foreach ($returned_values as $key)
		{
			switch ($key)
			{
				case 'name':
					$fileinfo['name'] = substr(strrchr($file, "/"), 1);
					break;
				case 'server_path':
					$fileinfo['server_path'] = $file;
					break;
				case 'size':
					$fileinfo['size'] = filesize($file);
					break;
				case 'date':
					$fileinfo['date'] = filectime($file);
					break;
				case 'readable':
					$fileinfo['readable'] = is_readable($file);
					break;
				case 'mime':
					$fileinfo['mime'] = $this->get_mimes_types($ext);
					break;	
				case 'writable':
					// There are known problems using is_weritable on IIS.  It may not be reliable - consider fileperms()
					$fileinfo['writable'] = is_writable($file);
					break;
				case 'executable':
					$fileinfo['executable'] = is_executable($file);
					break;
				case 'fileperms':
					$fileinfo['fileperms'] = fileperms($file);
					break;
			}
		}

		return $fileinfo;
	}
	
	/**

     * 获取文件后缀

     *

     * @param    string    $filename
	 
     * @return    string

     */
	
	function get_extension($filename)
	{
		$x = explode('.', $filename);
		return end($x);
	}
	
	/**

     * 获取文件mime类型
	 
     * @param    string    $suffix 文件后缀
	 
     * @return    string

     */
	function get_mimes_types($suffix)
	{
		@require(APPPATH.'config/mimes'.EXT);
		if(isset($mimes[$suffix]))
		{
			if(is_array($mimes[$suffix]))
			{
				$cnt_type=$mimes[$suffix][0];
			}
			else
			{
				$cnt_type=$mimes[$suffix];
			}
		}
		else
		{
			$cnt_type="未知文件类型";
		}
		unset($mimes);
		return $cnt_type;
	}

    /**

     * 移动文件夹

     *

     * @param    string    $oldDir

     * @param    string    $aimDir

     * @param    boolean    $overWrite 该参数控制是否覆盖原文件

     * @return    boolean

     */

    function moveDir($oldDir, $aimDir, $overWrite = false) {

        $aimDir = str_replace('', '/', $aimDir);

        $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir . '/';

        $oldDir = str_replace('', '/', $oldDir);

        $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir . '/';

        if (!is_dir($oldDir)) {

            return false;

        }

        if (!file_exists($aimDir)) {

            $this->createDir($aimDir);

        }

        @$dirHandle = opendir($oldDir);

        if (!$dirHandle) {

            return false;

        }

        while(false !== ($file = readdir($dirHandle))) {

            if ($file == '.' || $file == '..') {

                continue;

            }

            if (!is_dir($oldDir.$file)) {

                $this->moveFile($oldDir . $file, $aimDir . $file, $overWrite);

            } else {

                $this->moveDir($oldDir . $file, $aimDir . $file, $overWrite);

            }

        }

        closedir($dirHandle);

        return rmdir($oldDir);

    }

    /**

     * 移动文件

     *

     * @param    string    $fileUrl

     * @param    string    $aimUrl

     * @param    boolean    $overWrite 该参数控制是否覆盖原文件

     * @return    boolean

     */

    function moveFile($fileUrl, $aimUrl, $overWrite = false) {

        if (!file_exists($fileUrl)) {

            return false;

        }

        if (file_exists($aimUrl) && $overWrite = false) {

            return false;

        } elseif (file_exists($aimUrl) && $overWrite = true) {

            $this->unlinkFile($aimUrl);

        }

        $aimDir = dirname($aimUrl);

        $this->createDir($aimDir);

        rename($fileUrl, $aimUrl);

        return true;

    }

    /**

     * 删除文件夹

     *

     * @param    string    $aimDir

     * @return    boolean

     */

    function unlinkDir($aimDir) {

        $aimDir = str_replace('', '/', $aimDir);

        $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir.'/';

        if (!is_dir($aimDir)) {

            return false;

        }

        $dirHandle = opendir($aimDir);

        while(false !== ($file = readdir($dirHandle))) {

            if ($file == '.' || $file == '..') {

                continue;

            }

            if (!is_dir($aimDir.$file)) {

                $this->unlinkFile($aimDir . $file);

            } else {

                $this->unlinkDir($aimDir . $file);

            }

        }

        closedir($dirHandle);

        return rmdir($aimDir);

    }

    /**

     * 删除文件

     *

     * @param    string    $aimUrl

     * @return    boolean

     */

    function unlinkFile($aimUrl) {

        if (file_exists($aimUrl)) {

            unlink($aimUrl);

            return true;

        } else {

            return false;

        }

    }

    /**

     * 复制文件夹

     *

     * @param    string    $oldDir

     * @param    string    $aimDir

     * @param    boolean    $overWrite 该参数控制是否覆盖原文件

     * @return    boolean

     */

    function copyDir($oldDir, $aimDir, $overWrite = false) {

        $aimDir = str_replace('', '/', $aimDir);

        $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir.'/';

        $oldDir = str_replace('', '/', $oldDir);

        $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir.'/';

        if (!is_dir($oldDir)) {

            return false;

        }

        if (!file_exists($aimDir)) {

            $this->createDir($aimDir);

        }

        $dirHandle = opendir($oldDir);

        while(false !== ($file = readdir($dirHandle))) {

            if ($file == '.' || $file == '..') {

                continue;

            }

            if (!is_dir($oldDir . $file)) {

                $this->copyFile($oldDir . $file, $aimDir . $file, $overWrite);

            } else {

                $this->copyDir($oldDir . $file, $aimDir . $file, $overWrite);

            }

        }

        return closedir($dirHandle);

    }

    /**

     * 复制文件

     *

     * @param    string    $fileUrl

     * @param    string    $aimUrl

     * @param    boolean    $overWrite 该参数控制是否覆盖原文件

     * @return    boolean

     */

    function copyFile($fileUrl, $aimUrl, $overWrite = false) {

        if (!file_exists($fileUrl)) {

            return false;

        }

        if (file_exists($aimUrl) && $overWrite == false) {

            return false;

        } elseif (file_exists($aimUrl) && $overWrite == true) {

            $this->unlinkFile($aimUrl);

        }

        $aimDir = dirname($aimUrl);

        $this->createDir($aimDir);

        copy($fileUrl, $aimUrl);

        return true;

    }

}
?>
