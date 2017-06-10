# traverse_object()

{% include ".i/since/1.8.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`traverse_object()` - global function that's a convenience wrapper around `TraverseObject::using()`

```php
void traverse_object(object $list, string $listName, callable $callable);
```

See [`TraverseObject::using()`](TraverseObject.using.html) for details.
