<?php
	/**
	 * @author		Jan Pecha, <janpecha@email.cz>
	 * @license		New BSD License
	 */

	if(($dir = getcwd()) !== false)
	{
		include __DIR__ . '/nette.min.php';
		$args = NULL;

		if(isset($_SERVER['argc']) && $_SERVER['argc'] > 1)	// php convert2mp3 mp4 flv
		{
			$args = $_SERVER['argv'];
			array_shift($args);
		} else {
			$args = array('mp4', 'flv');
		}

		$errors = array();
		$masks = array();

		foreach($args as $arg)
		{
			if(checkExt($arg))
			{
				$masks[] = "*.$arg";
			}
			else
			{
				$errors[] = $arg;
			}
		}

		if(count($errors))
		{
			foreach($errors as $ext)
			{
				echo "[error] Pripona '$ext' je divna, zkus to opravit nebo smazat (pripona muze obsahovat pouze a-Z a 0-9 a nesmi byt 'mp3')\n";
			}

			exit;
		}

		$numOfFiles = 0;
		$errors = array();

		foreach (\Nette\Utils\Finder::findFiles($masks)->in($dir) as $file)	// neprohledava podadresare
		{
			if(($pos = strrpos($file, '.')) !== false)
			{
				$nFile = substr($file, 0, $pos) . '.mp3';
				#echo "$nFile\n";
				passthru("avconv -i \"$file\" \"$nFile\"");
				echo "-------------------------------------------\n";
			}
			else
			{
				$errors[] = $file;
			}

			#echo "$file\n";
			$numOfFiles++;
		}

		echo "Zpracovano $numOfFiles souboru\n";

		if(count($errors))
		{
			echo "Nasledujici soubory nebyly zpracovany:\n";

			foreach($errors as $file)
			{
				echo "$file\n";
			}
		}

		#echo "$numOfFiles\n";
	}
	else
	{
		echo "[error] Nepodarilo se ziskat cestu k adresari\n";
	}


	function checkExt($ext)
	{
		$allowedChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		if($ext == 'mp3')
		{
			return false;
		}

		$len = strlen($ext);

		for($i = 0; $i < $len; $i++)
		{
			if(strpos($allowedChars, $ext[$i]) === false)
			{
				return false;
			}
		}

		return true;
	}
