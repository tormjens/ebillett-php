# eBillett PHP

A simple class for getting eBillett entries in PHP.

## Examples

The syntax for the class is quite simple:

### Create a new instance
    $ebillett = new eBillett(1234);

### Get all entries
    $entries = $ebillett->get();

### Get a single entry by show ID
    $entry = $ebillett->get(54321);

### Or get it in one single line
    $entry = (new eBillett(1234))->get(54321);

