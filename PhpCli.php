<?php
	namespace Cz;
	
	class PhpCli
	{
		const REQUIRED = 0,
			OPTIONAL = 1;
		
		
		/** @var	array	default params ["paramName" => "value"] */
		protected $defaults = array();
		
		/** @var	array	params from command line ["paramName" => "value"] */
		public $params = array();
		
		
		public function setDefaults(array $params)
		{
			$this->defaults = $params;
		}
		
		
#		public function param($name, $value = null, $flags = self::REQUIRED)
#		{
#			
#		}
#		
		
		public function getParam($name, $default = null)
		{
			
		}
		
		
		public function getInput()
		{
			
		}
		
		
		public function log($message)
		{
			$this->msg($message);
		}
		
		
		public function msg($message)
		{
			
		}
		
		
		public function error($message)
		{
			
		}
		
		
		public function run()
		{
			$this->params = $this->defaults;
			#$this->parseParams();
			
			
		}
		
		
		public function terminate($msg = null, $errorCode = 0)	// TODO: end() or terminate();??
		{
			if($msg)
			{
				$this->msg($msg);
			}
			
			exit((int)$errorCode);
		}
		
		
		public function loadParams($allowedOptions/*??nebo jako vlastnost objektu*/)
		{
			
		}
	}
	
