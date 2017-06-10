# is_assignable()

{% include ".i/since/1.10.0.twig" %}
{% include ".i/supports/5.6-7.x-badges.twig" %}

## Description

`is_assignable()` - can a variable be used with PHP's object-assignment -> notation?

```php
bool is_assignable(mixed $fieldOrVar);
```

`is_assignable()` is a convenience wrapper around `IsAssignable::check()`. See [`IsAssignable::check()`](IsAssignable.check.html) for details.

{% include ".i/supports/5.6-7.x.twig" %}
