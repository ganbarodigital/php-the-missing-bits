---
currentSection: types
currentItem: type-checks
pageflow_prev_url: is_array_list.html
pageflow_prev_text: is_array_list()
pageflow_next_url: is_list.html
pageflow_next_text: is_list()
---

# is_assignable()

<div class="callout warning" markdown="1">
Not yet in a tagged release
</div>

## Description

`is_assignable()` - can a variable be used with PHP's object-assignment -> notation?

```php
bool is_assignable(mixed $fieldOrVar);
```

`is_assignable()` is a convenience wrapper around `IsAssignable::check()`. See [`IsAssignable::check()`](IsAssignable.check.html) for details.
