<?php
	/** Data URI CLI Generator - extracted from Nette Framework Source Code
	 * @author		Jan Pecha, <janpecha@email.cz>
	 * @version		2013-03-23-1
	 * @license		New BSD License
	 */
	
	if(($dir = getcwd()) !== false)
	{
		if(isset($_SERVER['argc']) && $_SERVER['argc'] > 1)	// is given file name(s)?
		{
			$sourceFilename = $dir . '/' . $_SERVER['argv'][1];
			$outputFilename = '';
			
			if(isset($_SERVER['argv'][2]))
			{
				$outputFilename = $dir . '/' . $_SERVER['argv'][2];
			}
			else
			{
				$pos = strrpos($sourceFilename, '.');
				
				if($pos !== FALSE)
				{
					$outputFilename = substr($sourceFilename, 0, $pos) . '.txt';
				}
				else
				{
					$outputFilename = "$sourceFilename.txt";
				}
			}
			
			file_put_contents($outputFilename, generateDataUri(file_get_contents($sourceFilename)));
			
			echo "Done.\n";
		}
		else
		{
			echo "\nData URI Generator (2012-11-13-1)\n*********************************\n\n",
				"Usage:\n",
				"\tdataurigen <input-file-name> [<output-file-name>]\n",
				"\n\tFor example:\n",
				"\t> dataurigen image.png image.txt",
				"\n\n";
		}
	}
	else
	{
		echo "[error] Nepodarilo se ziskat cestu k aktualnimu adresari (cwd).\n";
	}
	
	
	
	/**
	 * @link	http://api.nette.org/2.0/source-Templating.Helpers.php.html#266
	 * @param	string
	 * @return	string
	 */
	function generateDataUri($data)
	{
		if(!is_string($data))
		{
			throw new Exception('File error');
		}
		
		$type = mimeTypeFromString($data);
		return 'data:' . ($type ? "$type;" : '') . 'base64,' . base64_encode($data);
	}
	
	
	
	/**
	 * @link	http://api.nette.org/2.0.6/source-Utils.MimeTypeDetector.php.html#63
	 * @param	string
	 * @return	string
	 */
	function mimeTypeFromString($data)
	{
		if (extension_loaded('fileinfo') && preg_match('#^(\S+/[^\s;]+)#', finfo_buffer(finfo_open(FILEINFO_MIME), $data), $m)) {
			return $m[1];

		} elseif (strncmp($data, "\xff\xd8", 2) === 0) {
			return 'image/jpeg';

		} elseif (strncmp($data, "\x89PNG", 4) === 0) {
			return 'image/png';

		} elseif (strncmp($data, "GIF", 3) === 0) {
			return 'image/gif';

		} else {
			return 'application/octet-stream';
		}
	}

