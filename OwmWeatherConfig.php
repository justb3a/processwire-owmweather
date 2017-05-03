<?php namespace ProcessWire;

/**
* Class OwmWeatherConfig
*/
class OwmWeatherConfig extends ModuleConfig {

  /**
   * array Default config values
   */
  public function getDefaults() {
    return array(
      'apikey' => null,
      'units' => ''
    );
  }

  /**
   * Retrieves the list of config input fields
   * Implementation of the ConfigurableModule interface
   *
   * @return InputfieldWrapper
   */
  public function getInputfields() {
    // get inputfields
    $inputfields = parent::getInputfields();

    // apikey
    $field = $this->modules->get('InputfieldText');
    $field->attr('name', 'apikey');
    $field->label = $this->_('OpenWeatherMap API Key');
    $field->description = $this->_('Get an API Key from [home.openweathermap.org](https://home.openweathermap.org/).');
    $field->required = 1;
    $inputfields->add($field);

    // units
    $field = $this->modules->get('InputfieldSelect');
    $field->attr('name', 'units');
    $field->label = $this->_('Units format');
    $field->description = $this->_('Can be `standard`, `metric` or `imperial`.');
    $notes = '`standard`: ' . $this->_('Temperature in Kelvin is used by default.') . PHP_EOL;
    $notes .= '`imperial`: ' . $this->_('For temperature in Fahrenheit use imperial.') . PHP_EOL;
    $notes .= '`metric`: ' . $this->_('For temperature in Celsius use metric.') . PHP_EOL;
    $notes .= '[Read more!](http://openweathermap.org/current#data)';
    $field->notes = $notes;
    $field->addOption('', $this->_('standard'));
    $field->addOption('imperial', $this->_('imperial'));
    $field->addOption('metric', $this->_('metric'));

    $inputfields->add($field);

    return $inputfields;
  }

}
