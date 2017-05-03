# ProcessWire Weather

## OpenWeatherMap PHP API

ProcessWire module to retrieve, parse and display weather data from OpenWeatherMap.org.

- @see: [OpenWeatherMap](https://www.openweathermap.org/)
- @see: [OpenWeatherMap-PHP-Api](https://github.com/cmfcmf/OpenWeatherMap-PHP-Api)

## API Key

Get an API Key from [home.openweathermap.org](https://home.openweathermap.org/).

Set this key in module settings.

## Units

Temperature is available in Fahrenheit, Celsius and Kelvin units.

- @see: [OpenWeatherMap Units](http://openweathermap.org/current#data)
- Temperature in Kelvin is used by default
- For temperature in Fahrenheit use `imperial`
- For temperature in Celsius use `metric`

You can set this value in module settings as well.

## Multilingual support

Translation is only applied for the "description" field.  
OpenWeatherMap supports the following languages:

- Arabic - ar, Bulgarian - bg, Catalan - ca, Czech - cz, German - de, Greek - el, English - en, Persian (Farsi) - fa, Finnish - fi, French - fr, Galician - gl, Croatian - hr, Hungarian - hu, Italian - it, Japanese - ja, Korean - kr, Latvian - la, Lithuanian - lt, Macedonian - mk, Dutch - nl, Polish - pl, Portuguese - pt, Romanian - ro, Russian - ru, Swedish - se, Slovak - sk, Slovenian - sl, Spanish - es, Turkish - tr, Ukrainian - ua, Vietnamese - vi, Chinese Simplified - zh_cn, Chinese Traditional - zh_tw.
- @see: [OpenWeatherMap Multilingual support](http://openweathermap.org/current#multi)

## Example

![Example Output](https://raw.githubusercontent.com/justb3a/processwire-owmweather/master/screen.png)

```php
$weather = $modules->get('Weather')->getWeather('Berlin');
```

If you do not pass any language code, the language is determined using the user's language.  
If it equals 'default' or doesn't match any supported language code, **"en"** will be used.

You could also pass the desired language as a second argument:

```php
$weather = $modules->get('Weather')->getWeather('Berlin', 'it');
```

- @see: [Example API response](https://openweathermap.org/weather-data)

```twig
<section>
  <h3>{{ __('Weather')}}</h3>
  <h4>{{weather.city.name}} - {{weather.weather.description}}</h4>

  <div class="event__weather">
    <div class="event__weather--temperature">
      {% if file_exists(config.paths.assets ~ 'img/weather/' ~ weather.weather.icon ~ '.png') %}
        <img src="{{config.urls.assets}}img/weather/{{weather.weather.icon}}.png" alt="{{weather.weather.description}}" />
      {% else %}
        <img src="https:{{weather.weather.getIconUrl()}}" alt="{{weather.weather.description}}"/>  <br />
      {% endif %}

      <dl>
        <dt>{{ __('Temperature') }} {{ __('now') }}</dt>
        <dd class="event__weather--temperature--now">
          {% spaceless %}
            <span>{{weather.temperature.now.getValue()|number_format}}</span>
            <small>{{weather.temperature.now.getUnit()}}</small>
          {% endspaceless %}
        </dd>

        <dt>{{ __('Temperature') }} {{ __('min') }}</dt>
        <dd class="event__weather--temperature--min">
          {% spaceless %}
            {% include 'partials/_svg.twig' with {name: 'arrow-min'} %}
            <span>{{weather.temperature.min.getValue()|number_format}}</span>
            <small>{{weather.temperature.min.getUnit()}}</small>
          {% endspaceless %}
        </dd>

        <dt>{{ __('Temperature') }} {{ __('max') }}</dt>
        <dd class="event__weather--temperature--max">
          {% spaceless %}
            {% include 'partials/_svg.twig' with {name: 'arrow-max'} %}
            <span>{{weather.temperature.max.getValue()|number_format}}</span>
            <small>{{weather.temperature.max.getUnit()}}</small>
          {% endspaceless %}
        </dd>
      </dl>
    </div>

    <dl>
      <dt>{{ __('Humidity') }}</dt>
      <dd>{{weather.humidity}}</dd>

      <dt>{{ __('Air Pressure') }}</dt>
      <dd>{{weather.pressure}}</dd>

      <dt>{{ __('Sunrise') }}</dt>
      <dd>{{ weather.sun.rise.format("U")|date('H:i') }} {{ __('o\'clock')}}</dd>

      <dt>{{ __('Sunset') }}</dt>
      <dd>{{ weather.sun.set.format("U")|date('H:i') }} {{ __('o\'clock')}}</dd>
    </dl>
  </div>
</section>
```
