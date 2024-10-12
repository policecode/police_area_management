<?php

namespace App\Http\Helpers;

use App\Enums\OptionAutoload;
use App\Models\Option;

class SettingHelpers
{
  private $_options = [];
  static private $_instance = NULL;
  private function __construct() {
    $listOptions = Option::getByAutoLoad(OptionAutoload::YES['key'])->get();
    $tmpArr = [];
    foreach ($listOptions as $key => $item) {
      $tmpArr[$item->option_key] = $item->option_value;
    }
    $this->_options = $tmpArr;
  }
  static function getInstance()
  {
    if (self::$_instance == NULL) {
      self::$_instance = new SettingHelpers();
    }
    return self::$_instance;
  }

  public function setOption($option_key) {
    if ($option_key && empty($this->_options[$option_key])) {
      $result = Option::getByOptionKey($option_key)->first();
      $this->_options[$option_key] = $result?$result->option_value:'';
    }
  }

  public function get($option_arr_key) {
    if (count($option_arr_key)>0) {
      $results = Option::getByOptionKey($option_arr_key)->get();
      $tmpArr = [];
      for ($i=0; $i < count($option_arr_key); $i++) { 
        $value = '';
        foreach ($results as $key => $item) {
          if ($item->option_key == $option_arr_key[$i]) {
            $value = $item->option_value;
            break;
          }
        }
        $this->_options[$option_arr_key[$i]] = $value;
        $tmpArr[$option_arr_key[$i]] = $value;
      }
      return $tmpArr;
    }

    return [];
  }

  public function getOptionValue($option_key) {
    $this->setOption($option_key);
    return $this->_options[$option_key];
  }

  public function getOptionImage($option_key) {
    $this->setOption($option_key);
    if ($this->_options[$option_key]) {
      return route('index') . '/' .$this->_options[$option_key];
    }
    return false;
  }

  public function getOptionArray($option_key) {
    
  }

}
