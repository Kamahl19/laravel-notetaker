<?php

class BaseController extends Controller {

  public function __construct()
  {
    if ( Confide::user() )
    {
      if ( Confide::user()->language )
      {
        App::setLocale(Confide::user()->language);
      }
      
      if ( Confide::user()->timezone )
      {
        Config::set('app.timezone', Confide::user()->timezone);
      }
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