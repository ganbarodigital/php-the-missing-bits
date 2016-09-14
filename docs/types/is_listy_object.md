---
currentSection: types
currentItem: type-checks
pageflow_prev_url: is_list.html
pageflow_prev_text: is_list()
pageflow_next_url: is_stringy.html
pageflow_next_text: is_stringy()
---

# is_listy_object()

<div class="callout info" markdown="1">
Since v1.9.0
</div>

## Description

`is_listy_object()` - do we have an object that's a valid PHP list?

```php
bool is_listy_object(mixed $list);
```

`is_listy_object()` is a convenience wrapper around `IsListyObject::check()`. See [`IsListyObject::check()`](IsListyObject.check.html) for details.
