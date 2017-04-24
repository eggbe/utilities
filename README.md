## Introduction
This is the powerful library provides the set of utilities for different needs.       


## Requirements
* PHP >= 7.0.0
* [Eggbe/Helpers](https://github.com/eggbe/helpers)

## Install
Here's a pretty simple way to start using Eggbe/Utilities via [composer](http://getcomposer.org):

```bash
composer require eggbe/hash-store
```

## Components
* AliasMaker

## Usage

### AliasMaker
The AliasMaker component provides the simple way for the class overriding by using a given list of aliases.
The list of aliases have to be assigned via constructor during the object creation:   

```php
$AliasMaker = new \Eggbe\Utilities\AliasMaker([
	'Api\Reference\Units' => 'App\Model\Units',
	'Api\Reference\*' => 'App\Model\Reference',
	'Api\Model\*' => 'App\Model\&',
	'Api\Document\[Markets,Invoices,Prices]' => 'App\Document\&',
]);
```

Each rules contains of two parts. The left part of rule represents the condition and the right part represents the replacement. 
Both parts could include some special characters.

The first rule means what we want to override class ```Api\Reference\Units``` to ```App\Model\Units```. 
This is the simple and strict rule so no any surprises here.  

The second rule means what we want to override all classes started with the parent namespace ```Api\Reference\``` 
to a single class ```App\Model\Reference```. 

The thirs rule is similar to the previous and means what we want to override all classes started with the parent namespace ```Api\Model\``` 
to a similar class started with ```App\Model\```. The amppersand character is necessary to indicate the inserting position. 

And the last rule means what we want to override three defined classes started with the parent namespace ```Api\Document\``` 
to a similar classes started with ```App\Document\```. 

After configuring we can use AliasMaker anywhere in the code:

```php
$AliasMaker->alike('Api\Reference\Markets')
```

All returned values are cached so we haven't any reason to store results in variables. Also please pay attention to the conditions order 
because AliasMaker always returns the first successful comparison.

## Authors
Made with love at [Eggbe](http://eggbe.com).


## Feedback 
We always welcome your feedback at [github@eggbe.com](mailto:github@eggbe.com).


## License
This package is released under the [MIT license](https://github.com/eggbe/hash-store/blob/master/LICENSE).
