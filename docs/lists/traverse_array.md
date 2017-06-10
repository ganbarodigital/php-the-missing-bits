# traverse_array()

{% include ".i/since/1.8.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`traverse_array()` - global function that's a convenience wrapper around `TraverseArray::using()`

```php
void traverse_array(array $list, string $listName, callable $callable);
```

See [`TraverseArray::using()`](TraverseArray.using.html) for details.
