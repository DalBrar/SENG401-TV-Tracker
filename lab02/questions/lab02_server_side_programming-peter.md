# Lab 02: Server Side Programming

## PHP, XML, and AJAX

### Questions

1. What is the difference between the `echo` and `print` commands?
    - `echo` has no return value, while `print` has a return value of `1`
2. What data types does PHP support?
    - PHP supports:
      - `String`
      - `Integer`
      - `Float` (floating point numbers - also called double)
      - `Boolean`
      - `Array`
      - `Object`
      - `NULL`
      - `Resource`
3. What is the syntax to define constants in PHP?
    - A constant is defined with the `define()` function.
    - `define(name, value, case-insensitive)`
4. List arithmetic operators in PHP and compare them with JavaScript.
    |Operator|Description   |Comparison with Javascript|
    |--------|--------------|--------------------------|
    |+       |Addition      |Same                      |
    |-       |Subtraction   |Same                      |
    |*       |Multiplication|Same                      |
    |**      |Exponentiation|Same                      |
    |/       |Division      |Same                      |
    |%       |Modulus       |Same                      |
5. List assignment operators in PHP and compare them with JavaScript.
    |Operator|Equivalent To|Comparison with Javascript|
    |--------|-------------|--------------------------|
    |=       |x = y        |Same                      |
    |+=      |x = x + y    |Same                      |
    |-=      |x = x - y    |Same                      |
    |*=      |x = x * y    |Same                      |
    |/=      |x = x / y    |Same                      |
    |%=      |x = x % y    |Same                      |
6. List Logical Operators in PHP and compare them with JavaScript.
    |Operator    |Description|Comparison with Javascript |
    |------------|-----------|---------------------------|
    |and         |logical and|Doesn't exist in Javascript|
    |or          |logical or |Doesn't exist in Javascript|
    |xor         |logical xor|Doesn't exist in Javascript|
    |&&          |logical and|Same                       |
    |&#124;&#124;|logical or |Same                       |
    |!           |logical not|Same                       |
7. List String Operators in PHP.
    |Operator|Description             |Example       |
    |--------|------------------------|--------------|
    |.       |Concatenation           |$txt1 . $txt2 |
    |.=      |Concatenation Assignment|$txt1 .= $txt2|
8. List Array Operators in PHP.
    |Operator|Description |Example|
    |--------|------------|-------|
    |+       |Union       |$x + $y
    |==      |Equality    |$x == $y
    |===     |Identity    |$x === $y
    |!=      |Inequality  |$x != $y
    |<>      |Inequality  |$x <> $y
    |!==     |Non-identity|$x !== $y
9. List all PHP Conditional Statements.
    - `if`
    - `if...else`
    - `if...elsif...else`
    - `switch`
10. Define the syntax for different `for loops` in PHP.
    ```php
    for (init counter; test counter; increment counter) {
    code to be executed;
    }

    foreach ($array as $value) {
    code to be executed;
    }
    ```
11. What are the array types in PHP?
    - Indexed Arrays
    - Associative Arrays
    - Multidimensional Arrays
12. What is the difference between tree-based XML Parsers and event-based XML Parsers?
    - Tree based parsers
      - Holds the entire document in Memory and transforms the XML document into a Tree structure.
    - Event based parsers
      - Read in one node at a time and allow you to interact with in real time.
