---
currentSection: lists
currentItem: list-iterators
pageflow_prev_url: traverse_array.html
pageflow_prev_text: traverse_array()
pageflow_next_url: traverse_object.html
pageflow_next_text: traverse_object()
---

# traverse_list()

<div class="callout info" markdown="1">
Since v1.8.0
</div>

## Description

`traverse_list()` - global function that's a convenience wrapper around `TraverseList::using()`

```php
void traverse_list(mixed $list, string $listName, callable $callable);
```

See [`TraverseList::using()`](TraverseList.using.html) for details.
