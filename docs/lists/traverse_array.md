---
currentSection: lists
currentItem: list-iterators
pageflow_prev_url: list-iterators.html
pageflow_prev_text: List Iterators
pageflow_next_url: traverse_list.html
pageflow_next_text: traverse_list()
---

# traverse_array()

<div class="callout info" markdown="1">
Since v1.8.0
</div>

## Description

`traverse_array()` - global function that's a convenience wrapper around `TraverseArray::using()`

```php
void traverse_array(array $list, string $listName, callable $callable);
```

See [`TraverseArray::using()`](TraverseArray.using.html) for details.
