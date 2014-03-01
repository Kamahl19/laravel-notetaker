<?php

class Functions {

  public static function language_list()
  {
    $languages[''] = '';
    $languages['en'] = 'English';
    $languages['sk'] = 'Slovenčina';
    
    return $languages;
  }

  public static function timezone_list()
  {
    static $timezones = null;

    if ($timezones === null)
    {
      $timezones = [];
      $offsets = [];
      $now = new DateTime();

      foreach (DateTimeZone::listIdentifiers() as $timezone)
      {
        $now->setTimezone(new DateTimeZone($timezone));
        $offsets[] = $offset = $now->getOffset();
        $timezones[$timezone] = '(' . self::format_GMT_offset($offset) . ') ' . self::format_timezone_name($timezone);
      }

      array_multisort($offsets, $timezones);
    }

    return array('' => '') + $timezones;
  }
  
  private static function format_GMT_offset($offset)
  {
    $hours = intval($offset / 3600);
    $minutes = abs(intval($offset % 3600 / 60));
    return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
  }
  
  private static function format_timezone_name($name)
  {
    $name = str_replace('/', ', ', $name);
    $name = str_replace('_', ' ', $name);
    $name = str_replace('St ', 'St. ', $name);
    return $name;
  }
  
  /**
	 * Check if folder is empty.
	 *
	 * @param  string  $path
	 * @return boolean
	 */
  public static function is_dir_empty($path)
  {
    if ( !is_readable($path) )
    {
      return false;
    } 
    
    $handle = opendir($path);
    
    while (false !== ($entry = readdir($handle)))
    {
      if ($entry != "." && $entry != "..") {
        return false;
      }
    }
    
    return true;
  }

}