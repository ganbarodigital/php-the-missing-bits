---
currentSection: traces
currentItem: StackFrame
pageflow_next_url: index.html
pageflow_next_text: Stack Trace Functions and Classes
---

# StackFrame

<div class="callout warning">
Not yet in a tagged release
</div>

## Description

`StackFrame` is a value object. It holds details about a single entry in a PHP stack trace.

## Public Interface

`StackFrame` has the following public interface:

```php
// StackFrame lives in this namespace
namespace GanbaroDigital\MissingBits\TraceInspectors;

/**
 * StackFrame holds details about a single entry in a PHP stack trace
 */
class StackFrame
{
    /**
     * constructor
     *
     * @param string|null $class
     *        which class has been executed?
     * @param string|null $function
     *        which function or method has been executed?
     * @param string|null $callType
     *        how was $function called?
     * @param string|null $file
     *        which file was the calling code in?
     * @param int|null $line
     *        which line in $file was the calling code on?
     * @param array $stack
     *        what was the call stack at the time?
     */
    public function __construct($class, $function, $callType, $file, $line, $stack = []);

    /**
     * which class has been executed?
     *
     * @return string|null
     */
    public function getClass();

    /**
     * which function or method has been executed?
     *
     * @return string|null
     */
    public function getFunction();

    /**
     * which method has been executed?
     *
     * @return string|null
     */
    public function getMethod();

    /**
     * how was the function|method called?
     *
     * @return string|null
     */
    public function getCallType();

    /**
     * which file was the executed code defined in?
     *
     * @return string|null
     */
    public function getFilename();

    /**
     * which line in $this->getFile() was the executed code defined on?
     *
     * @return int|null
     */
    public function getLine();

    /**
     * what were the contents of the call stack at the time?
     *
     * an empty array means that we weren't asked to save the call stack
     * (probably to save memory - the call stack can be large)
     *
     * @return array
     */
    public function getStack();

    // =========================================================================
    //
    // HELPERS
    //
    // -------------------------------------------------------------------------

    /**
     * return our contents as a sensible, printable string
     *
     * @return string
     */
    public function getExecutedCodeSummary();

    /**
     * return our contents as a sensible, printable string
     *
     * @return string
     */
    public function __toString();
}
```

## Works With

`GetArrayTypes` is supported on these versions of PHP:

PHP Version | Works?
------------|-------
5.5 | Yes
5.6 | Yes
7.0 | Yes
HHVM | Yes
