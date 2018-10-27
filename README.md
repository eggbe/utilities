## Introduction
This is the powerful library provides the set of utilities for different needs.       


## Requirements
* PHP >= 7.0.0
* [Able/Helpers](https://github.com/phpable/helpers)

## Install
Here's the simpler way to start using Eggbe/Utilities via [composer](http://getcomposer.org):

```bash
composer require eggbe/hash-store
```

## Components
* Aliaser

## Usage

### Aliaser
The Aliaser component provides the simple way for the class overloading by using a given list of aliases.
The list of aliases have to be assigned via constructor during the object creation:   

```php
$Aliaser = new \Eggbe\Utilities\Aliaser([
	'Api\Reference\Units' => 'App\Models\Units',
	'Api\Reference\*' => 'App\Models\Reference',
	'Api\Model\*' => 'App\Models\&',
	'Api\Document\[Markets,Invoices,Prices]' => 'App\Document\&',
]);
```

Each rules contains of two parts. The left part of rule represents the condition and the right part represents the replacement. 
Both parts could include some special characters.

The first rule means what we want to overload class ```Api\Reference\Units``` to ```App\Models\Units```. 
This is just the strict replacement so no any surprises here.  

The second rule means what we want to overload all classes started with the parent namespace ```Api\Reference\``` 
to a single class ```App\Models\Reference```. 

The third rule is similar to the previous and means what we want to overload all classes started with the parent namespace ```Api\Model\``` 
to a similar class started with ```App\Models\```. The amppersand character is necessary to indicate the inserting position. 
For example the class ```Api\Model\Test``` will be overloaded to ```App\Models\Test```.  

And the last rule means what we want to overload only three defined classes started with the parent namespace ```Api\Document\``` 
to a similar classes started with ```App\Document\```. In this case the replacement statement uses the ampersand character 
in the same way as the previous rule.

After configuring we can use Aliaser anywhere in the code:

```php
$Aliaser->alike('Api\Reference\Markets')
```
All returned values are cached so no any reason to store results in variables. 
Also please pay attention to the conditions order because Aliaser always returns the result of first successful comparison only.

## Authors
Made with love at [Eggbe](http://eggbe.com).


## Feedback 
We always welcome your feedback at [github@eggbe.com](mailto:github@eggbe.com).


## License
This package is released under the [MIT license](https://github.com/eggbe/utilities/blob/master/LICENSE).
