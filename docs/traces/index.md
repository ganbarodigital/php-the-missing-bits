---
currentSection: traces
currentItem: home
pageflow_next_url: HowThePhpStackFrameWorks.html
pageflow_next_text: How The PHP Stack Frame Works
---

# Stack Trace Functions and Classes

## Introduction

Here's a list of what we find is missing from PHP's built-in support for working with stack traces.

Btw, the PHP stack trace is a little odd to work with. We've written up [a full explanation](HowThePhpStackFrameWorks.html) of what's strange about it.

## Available Classes

Function | Purpose
---------|--------
[`FilterBacktrace`](FilterBacktrace.html) | find the first stack trace entry, filtering out given classes and namespaces
[`GetCaller`](GetCaller.html) | work out who has called a piece of code
[`StackFrame`](StackFrame.html) | value object, holds details of a single stack frame
