---
currentSection: types
currentItem: type-checks
pageflow_prev_url: type-checks.html
pageflow_prev_text: Type Checks
pageflow_next_url: is_assignable.html
pageflow_next_text: is_assignable()
---

# is_array_list()

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`is_array_list()` - is every entry in the list a PHP array?

```php
bool is_array_list(mixed $list);
```

`is_array_list()` is a convenience wrapper around `IsArray::checkList()`. See [`IsArray::checkList()`](IsArray.checkList.html) for details.
