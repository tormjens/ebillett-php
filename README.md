# eBillett PHP

A simple class for getting eBillett entries in PHP.

## Installation

You can install eBillett PHP using both composer or a manual include. The class is namespaced under `eBillett`.

### Composer

#### Require using composer
    composer require tormorten/ebillett

#### Include the composer autoloader in your project
    require 'vendor/autoload.php';

### Manual include

#### Include the class file
    include 'src/eBillett.php';

## Examples

The syntax for the class is quite simple

### Create a new instance
    $ebillett = new \eBillett\eBillett(1234);

### Get all entries
    $entries = $ebillett->get();

### Get a single entry by show ID
    $entry = $ebillett->get(54321);

### Or get it in one single line
    $entry = (new \eBillett\eBillett(1234))->get(54321);

