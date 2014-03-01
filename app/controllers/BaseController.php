<?php

class BaseController extends Controller {

  public function __construct()
  {
    if ( Confide::user() )
    {
      App::setLocale(Confide::user()->language);
      Config::set('app.timezone', Confide::user()->timezone);
    }    
  }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}