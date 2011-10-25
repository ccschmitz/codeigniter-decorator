<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Decorator {
	
	private $_decorators_directory_name = 'decorators';
	
	private $_ci;
	private $_decorators_directory;

	public function __construct()
	{
		$this->_ci =& get_instance();

		$this->_decorators_directory = rtrim(APPPATH, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$this->_decorators_directory_name.DIRECTORY_SEPARATOR;

		log_message('debug', 'Decorator class initialized');
	}

	public function decorate($class = NULL, $method = NULL, $params = array())
	{
		// try to guess the class
		if ( ! $class)
		{
			$class = $this->_ci->router->class.'_decorator';
		}
		else
		{
			// add the file extension if they didn't already
			if ( ! strpos($class, '_decorator'))
			{
				$class .= '_decorator';
			}
		}

		// try to guess the method
		if ( ! $method)
		{
			$method = $this->_ci->router->method;
		}

		// make sure params is an array
		if ( ! is_array($params))
		{
			$params = array($params);
		}

		// set the full file path to be loaded
		$file = $this->_decorators_directory.$class.'.php';

		// see if a decorator exists
		if (file_exists($file))
		{
			// require the decorator
			require($file);

			// get the decorated data
			$decorator = new $class();
			return call_user_func_array(array($decorator, $method), $params);
		}
		else
		{
			show_error('Decorator <em>'.$this->_decorators_directory.$class.'</em> could not be found.');
		}
	}
}