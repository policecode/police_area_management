<?php

namespace App\Http\Helpers;

use App\Enums\OptionAutoload;
use App\Models\Option;

class SettingHelpers
{
  private $_options = [];
  private $_key_to_array_value = ['affiliate_in_chapter'];
  static private $_instance = NULL;
  private function __construct() {
    $listOptions = Option::getByAutoLoad(OptionAutoload::YES['key'])->get();
    $tmpArr = [];
    foreach ($listOptions as $key => $item) {
      $tmpArr[$item->option_key] = $this->renderToValue($item->option_key, $item->option_value);
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

  private function renderToValue($option_key, $option_value) {
    if (in_array($option_key, $this->_key_to_array_value)) {
      if (empty($option_value)) {
        return [];
      }
      return json_decode($option_value, true);
    }
    return $option_value;
  }

  public function setOption($option_key) {
    if ($option_key && empty($this->_options[$option_key])) {
      $result = Option::getByOptionKey($option_key)->first();
      $this->_options[$option_key] = $this->renderToValue($option_key, $result ? $result->option_value : '');
    }
  }

  public function get($option_arr_key) {
    
    if (count($option_arr_key)>0) {
      $tmpArr = [];
      $tmpAfterClearArr = [];
      for ($i=0; $i < count($option_arr_key); $i++) {
        if (empty($this->_options[$option_arr_key[$i]])) {
          $tmpAfterClearArr[] = $option_arr_key[$i];
        } else {
          $tmpArr[$option_arr_key[$i]] = $this->_options[$option_arr_key[$i]];
        }
      }
      if (count($tmpAfterClearArr)>0) {
      $results = Option::getByOptionKey($tmpAfterClearArr)->get();
        for ($i=0; $i < count($tmpAfterClearArr); $i++) { 
          $value = '';
          foreach ($results as $key => $item) {
            if ($item->option_key == $tmpAfterClearArr[$i]) {
              $value = $this->renderToValue($item->option_key, $item->option_value);
              break;
            }
          }
          $this->_options[$tmpAfterClearArr[$i]] = $value;
          $tmpArr[$tmpAfterClearArr[$i]] = $value;
        }
      }
      return $tmpArr;
    }

    return [];
  }

  public function getOptionValue($option_key) {
    $this->setOption($option_key);
    if ($this->_options[$option_key] == 1) {
      return NULL;
    }
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

  public function templateOptionDB() {
    $affiliate_in_chapter = [
      [
        'link' => '',
        'desc' => '',
        'banner' => ''
      ]
    ];

    Option::insertOrIgnore(
      ['option_key' => 'affiliate_in_chapter', 'option_value' => json_encode($affiliate_in_chapter), 'autoload' => OptionAutoload::YES['key']]
    );
  }

}
