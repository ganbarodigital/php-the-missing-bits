---
currentSection: types
currentItem: type-checks
pageflow_prev_url: is_listy_object.html
pageflow_prev_text: is_listy_object()
pageflow_next_url: IsArray.check.html
pageflow_next_text: IsArray::check()
---

# is_stringy()

<div class="callout info" markdown="1">
Since v1.8.0
</div>

## Description

`is_stringy()` - can we use the variable as a string?

```php
boolean is_stringy(mixed $item);
```

`is_stringy()` is a convenience wrapper around `IsStringy::check()`. See [`IsStringy::check()`](IsStringy.check.html) for details.
