---
currentSection: types
currentItem: type-checks
pageflow_prev_url: is_assignable.html
pageflow_prev_text: is_assignable()
pageflow_next_url: is_listy_object.html
pageflow_next_text: is_listy_object()
---

# is_list()

<div class="callout info" markdown="1">
Since v1.9.0
</div>

## Description

`is_list` - do we have a valid PHP list?

```php
bool is_list(mixed $list);
```

`is_list()` is a convenience wrapper around `IsList::check()`. See [`IsList::check()`](IsList.check.html) for details.
