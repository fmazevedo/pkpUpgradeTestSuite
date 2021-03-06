<?php

/**
 * FileManager.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package file
 *
 * Class defining basic operations for file management.
 *
 * $Id: FileManager.inc.php,v 1.27 2005/06/30 21:09:00 alec Exp $
 */


// Default permissions for new directories, if none configured
define('DEFAULT_DIR_PERM', 0755);

class FileManager {

	/**
	 * Constructor.
	 * Empty constructor.
	 */
	function FileManager() {	
	}
	
	/**
	 * Return true if an uploaded file exists.
	 * @param $fileName string the name of the file used in the POST form
	 * @return boolean
	 */
	function uploadedFileExists($fileName) {
		if (isset($_FILES[$fileName]['tmp_name']) && is_uploaded_file($_FILES[$fileName]['tmp_name'])) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Return the (temporary) path to an uploaded file.
	 * @param $fileName string the name of the file used in the POST form
	 * @return string (boolean false if no such file)
	 */
	function getUploadedFilePath($fileName) {
		if (isset($_FILES[$fileName]['tmp_name']) && is_uploaded_file($_FILES[$fileName]['tmp_name'])) {
			return $_FILES[$fileName]['tmp_name'];
		} else {
			return false;
		}
	}
	
	/**
	 * Return the user-specific (not temporary) filename of an uploaded file.
	 * @param $fileName string the name of the file used in the POST form
	 * @return string (boolean false if no such file)
	 */
	function getUploadedFileName($fileName) {
		if (isset($_FILES[$fileName]['name'])) {
			return $_FILES[$fileName]['name'];
		} else {
			return false;
		}
	}
	
	/**
	 * Return the type of an uploaded file.
	 * @param $fileName string the name of the file used in the POST form
	 * @return string
	 */
	function getUploadedFileType($fileName) {
		if (isset($_FILES[$fileName])) {
			if (function_exists('mime_content_type')) {
				$type = mime_content_type($_FILES[$fileName]['tmp_name']);
				if (!empty($type)) return $type;
			}
			return $_FILES[$fileName]['type'];
		} else {
			return false;
		}
	}
		
	/**
	 * Upload a file.
	 * @param $fileName string the name of the file used in the POST form
	 * @param $dest string the path where the file is to be saved
	 * @return boolean returns true if successful
	 */
	function uploadFile($fileName, $destFileName) {
		$destDir = dirname($destFileName);
		if (!$this->fileExists($destDir, 'dir')) {
			// Try to create the destination directory
			$this->mkdirtree($destDir);
		}

		return move_uploaded_file($_FILES[$fileName]['tmp_name'], $destFileName);
	}

	/**
	 * Write a file.
	 * @param $dest string the path where the file is to be saved
	 * @param $contents string the contents to write to the file
	 * @return boolean returns true if successful
	 */
	function writeFile($dest, &$contents) {
		$success = true;
		$destDir = dirname($dest);
		if (!$this->fileExists($destDir, 'dir')) {
			// Try to create the destination directory
			$this->mkdirtree($destDir);
		}
		if (($f = fopen($dest, 'wb'))===false) $success = false;
		if ($success && fwrite($f, $contents)===false) $success = false;
		@fclose($f);

		return $success;
	}

	/**
	 * Copy a file.
	 * @param $source string the source URL for the file
	 * @param $dest string the path where the file is to be saved
	 * @return boolean returns true if successful
	 */
	function copyFile($source, $dest) {
		$success = true;
		$destDir = dirname($dest);
		if (!$this->fileExists($destDir, 'dir')) {
			// Try to create the destination directory
			$this->mkdirtree($destDir);
		}
		return copy($source, $dest);
	}

	/**
	 * Read a file's contents.
	 * @param $filePath string the location of the file to be read
	 * @param $output boolean output the file's contents instead of returning a string
	 * @return boolean
	 */
	function &readFile($filePath, $output = false) {
		if (is_readable($filePath)) {
			$f = fopen($filePath, 'r');
			$data = '';
			while (!feof($f)) {
				$data .= fread($f, 4096);
				if ($output) {
					echo $data;
					$data = '';
				}
			}
			fclose($f);
			
			if ($output) {
				return true;
			} else {
				return $data;
			}
			
		} else {
			return false;
		}
	}
	
	/**
	 * Download a file.
	 * Outputs HTTP headers and file content for download
	 * @param $filePath string the location of the file to be sent
	 * @param $type string the MIME type of the file, optional
	 * @param $inline print file as inline instead of attachment, optional
	 * @return boolean
	 */
	function downloadFile($filePath, $type = null, $inline = false) {
		if (is_readable($filePath)) {
			if ($type == null) {
				if (function_exists('mime_content_type')) {
					$type = mime_content_type($filePath);
				} else {
					$type = 'application/octet-stream';
				}
			}
			
			header("Content-Type: $type");
			header("Content-Length: ".filesize($filePath));
			header("Content-Disposition: " . ($inline ? 'inline' : 'attachment') . "; filename=\"" .basename($filePath)."\"");
			header("Cache-Control: private"); // Workarounds for IE weirdness
			header("Pragma: public");

			import('file.FileManager');
			FileManager::readFile($filePath, true);
			
			return true;
			
		} else {
			return false;
		}
	}
	
	/**
	 * View a file inline (variant of downloadFile).
	 * @see FileManager::downloadFile
	 */
	function viewFile($filePath, $type = null) {
		$this->downloadFile($filePath, $type, true);
	}
	
	/**
	 * Delete a file.
	 * @param $filePath string the location of the file to be deleted
	 * @return boolean returns true if successful
	 */
	function deleteFile($filePath) {
		if ($this->fileExists($filePath)) {
			return unlink($filePath);
		} else {
			return false;
		}
	}
	
	/**
	 * Create a new directory.
	 * @param $dirPath string the full path of the directory to be created
	 * @param $perms string the permissions level of the directory, optional, default dir_perm
	 * @return boolean returns true if successful
	 */
	function mkdir($dirPath, $perms = null) {
		if ($perms == null) {
			$perms = Config::getVar('security','dir_perm');
			if ($perms == null) {
				$perms = DEFAULT_DIR_PERM;
			}
		}
		return mkdir($dirPath, $perms);
	}
	
	/**
	 * Remove a directory.
	 * @param $dirPath string the full path of the directory to be delete
	 * @return boolean returns true if successful
	 */
	function rmdir($dirPath) {
		return rmdir($dirPath);
	}
	
	/**
	 * Delete all contents including directory (equivalent to "rm -r")
	 * @param $file string the full path of the directory to be removed
	 */
	function rmtree($file) {
		if (file_exists($file)) {
			if (is_dir($file)) {
				$handle = opendir($file); 
				import('file.FileManager');
				while (($filename = readdir($handle)) !== false) {
					if ($filename != '.' && $filename != '..') {
						FileManager::rmtree($file . '/' . $filename);
					}
				}
				closedir($handle);
				rmdir($file);
				
			} else {
				unlink($file);
			}
		}
	}
	
	/**
	 * Create a new directory, including all intermediate directories if required (equivalent to "mkdir -p")
	 * @param $dirPath string the full path of the directory to be created
	 * @param $perms string the permissions level of the directory, optional, default dir_perm
	 * @return boolean returns true if successful
	 */
	function mkdirtree($dirPath, $perms = null) {
		$success = true;
		
		$dirParts = explode('/', $dirPath);
		$currPath = '';

		for ($i = 0, $count = count($dirParts); ($i < $count) && $success; $i++) {
			$currPath .= $dirParts[$i];
			
			if ($currPath != '' && !file_exists($currPath)) {
				$success = $this->mkdir($currPath, $perms);
			}
			
			$currPath .= '/';
		}
		
		return $success;
	}
	
	/**
	 * Check if a file path is valid;
	 * @param $filePath string the file/directory to check
	 * @param $type string (file|dir) the type of path
	 */
	function fileExists($filePath, $type = 'file') {
		switch ($type) {
			case 'file':
				return file_exists($filePath);
			case 'dir':
				return file_exists($filePath) && is_dir($filePath);
			default:
				return false;
		}
	}
	
	/**
	 * Returns file extension associated with the given image type,
	 * or false if the type does not belong to a recognized image type.
	 * @param $type string
	 */
	function getImageExtension($type) {
		switch ($type) {
			case 'image/gif':
				return '.gif';
			case 'image/jpeg':
			case 'image/pjpeg':
				return'.jpg';
			case 'image/png':
			case 'image/x-png':
				return '.jpg';
			default:
				return false;
		}
	}

	/**
	 * Parse file extension from file name.
	 * @param string a valid file name
	 * @return string extension
	 */
	function getExtension($fileName) {
		$extension = '';
		$fileParts = explode('.', $fileName);
		if (is_array($fileParts)) {
			$extension = $fileParts[count($fileParts) - 1];
		}
		return $extension;
	}
	
	/**
	 * Return pretty file size string (in B, KB, MB, or GB units).
	 * @param $size int file size in bytes
	 * @return string
	 */
	function getNiceFileSize($size) {
		static $niceFileSizeUnits = array('B', 'KB', 'MB', 'GB');
		for($i = 0; $i < 4 && $size > 1024; $i++) {
			$size >>= 10;
		}
		return $size . $niceFileSizeUnits[$i];
	}
	
}

?>
