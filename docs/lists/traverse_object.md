---
currentSection: lists
currentItem: list-iterators
pageflow_prev_url: traverse_list.html
pageflow_prev_text: traverse_list()
pageflow_next_url: TraverseArray.using.html
pageflow_next_text: TraverseArray::using()
---

# traverse_object()

<div class="callout info" markdown="1">
Since v1.8.0
</div>

## Description

`traverse_object()` - global function that's a convenience wrapper around `TraverseObject::using()`

```php
void traverse_object(object $list, string $listName, callable $callable);
```

See [`TraverseObject::using()`](TraverseObject.using.html) for details.
