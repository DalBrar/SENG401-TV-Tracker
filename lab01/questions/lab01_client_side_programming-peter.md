# Lab 01: Client Side Programming

## HTML

### Questions 1

1. What does HTML stand for?
    - Hyper Text Markup Language
2. What are the two major nodes of an HTML file?
    - `head` and `body`
3. What are the steps of HTML growth?
    - From w3Schools
      - HTML - 1991
      - HTML 2.0 - 1995
      - HTML 3.2 - 1997
      - HTML 4.0.1 - 1999
      - XHTML - 2000
      - HTML5 - 2014
4. How many headings does HTML support?
    - HTML supports 6 headings `<h1>` to `<h6>`
5. What are HTML text formatting elements and how they affect a piece of text?
    - `<b>` - Bold text
    - `<strong>` - Important text
    - `<i>` - Italic text
    - `<em>` - Emphasized text
    - `<mark>` - Marked text
    - `<small>` - Small text
    - `<del>` - Deleted text
    - `<ins>` - Inserted text
    - `<sub>` - Subscript text
    - `<sup>` - Superscript text
6. How do you comment a line in HTML?
    - Enclose the comment in a comment tag
    - `<!-- this is a comment in a comment tag -->`
7. What are the main ways to define a colour in HTML?
    - By the name of the colour
      - `<h1 style="color:Tomato;">I am using a colour name</h1>`
    - By value
        - RGB
          - `<h1 style="color:rgb(255, 99, 71);">I am using an RGB value</h1>`
        - Hex
          - `<h1 style="color:#ff6347;">I am using a Hex value</h1>`
        - HSL
          - `<h1 style="color:hsl(9, 100%, 64%);">I am using an HSL value</h1>`
        - RGBA
          - `<h1 style="color:rgba(255, 99, 71, 1);">I am using an RGBA value</h1>`
        - HSLA
          - `<h1 style="color:hsla(9, 100%, 64%, 1);">I am using an HSLA value</h1>`
8. Write a piece of code that opens the following link in a new tab: [w3schools.com](https://www.w3schools.com/)?
    - `<a href="https://www.w3schools.com/" target="_blank">I am a link to w3schools</a>`
9. What are the tags for ordered list and unordered list?
    - Unordered list: `<ul>`
    - Ordered list: `<ol>`
10. What is the use of class attribute? What is the difference between class and id?
    - The `class` attribute is used to define a common style between elements that use that class name
    - An `id` specifies a unique identifier for an element
11. What is responsive web design?
    - Using HTML and CSS to automatically resize, hide, shrink, or enlarge a webpage to make it look good and display properly on all window sizes or devices.
    - Need to include the following metadata in every web page:
      - `<meta name="viewport" content="width=device-width, initial-scale=1.0">`
12. What is a URL?
    - A Uniform Resource Locator (URL) is used to provide an address for a resource on the web.
13. What are the main form -> input types in HTML?
    - Text Input
      - `<input type="text">`
    - Radio Button Input
      - `<input type="radio">`
    - Submit Input
      - `<input type="submit">`
    - Select Input
      - `<input type="select">`
    - Button Input
      - `<input type="button">`
    - Password Input
      - `<input type="password">`
    - Checkbox Input
      - `<input type="checkbox">`
    - Reset Input
      - `<input type="reset">`
14. What is the difference between "GET" and "POST" in HTML forms? Which one is more suitable for sending sensitive data?
    - `GET` is used by default when submitting form data. The form data of a GET request will be visible in the address field. The address field has a character limit so long requests will result in lost data.
    - `POST` is used when submitting personal or sensitive information. The form data is not visible in the address field. No size limitations and can be used to transfer large amounts of data.

### Questions 2

1. What does CSS stand for?
    - Cascading Style Sheets
2. What are the three ways of inserting a style sheet?
    - Inserting an external style sheet
    - Inserting an internal style sheet
      - Use the `<style>` tag inside the `<head>` section
    - Using an inline style sheet
3. What is the syntax to link to an external style sheet?
    - `<link rel="stylesheet" type="text/css" href="mystyle.css">`

### Questions 3

1. List arithmetic operators in JavaScript and their descriptions

    |Operator|Description   |
    |--------|--------------|
    |+       |Addition      |
    |-       |Subtraction   |
    |*       |Multiplication|
    |**      |Exponentiation|
    |/       |Division      |
    |%       |Modulus       |
    |++      |Increment     |
    |--      |Decrement     |
2. List assignment operators in Javascript and their descriptions

    |Operator|Equivalent To|
    |--------|-------------|
    |=       |x = y        |
    |+=      |x = x + y    |
    |-=      |x = x - y    |
    |*=      |x = x * y    |
    |/=      |x = x / y    |
    |%=      |x = x % y    |
    |<<=     |x = x << y   |
    |>>=     |x = x >> y   |
    |>>>=    |x = x >>> y  |
    |<<<=    |x = x <<< y  |
    |&=      |x = x & y    |
    |^=      |x = x ^ y    |
    ||=      |x = x | y    |
    |**=     |x = x ** y   |
3. List comparison operators in JavaScript and their descriptions

    |Operator|Description                      |
    |--------|---------------------------------|
    |==      |equal to                         |
    |===     |equal value and equal type       |
    |!=      |not equal                        |
    |!==     |not equal value or not equal type|
    |>       |greater than                     |
    |<       |less than                        |
    |>=      |greater than or equal to         |
    |<=      |less than or equal to            |
    |?       |ternary operator                 |
4. List logical operators in JavaScript and their description

    |Operator    |Description|
    |------------|-----------|
    |&&          |logical and|
    |&#124;&#124;|logical or |
    |!           |logical not|
5. List all the datatypes in Javascript
    - string
    - number
    - boolean
    - object
    - function
    - undefined
6. List conditional statements in JavaScript
    - `if`
    - `else`
    - `else if`
    - `switch`
7. List loop statements in JavaScript
    - `for`
    - `for/in`
    - `while`
    - `do/while`
8. What is the output of `typeof` function in JavaScript?
    - The datatype of a JavaScript variable or an expression
9. List HTML keyboard events and mouse events that JavaScript can handle
    - `onclick`
    - `onmouseover`
    - `onmouseout`
    - `mousedown`
    - `mouseup`
    - `mousemove`
    - `mouseenter`
    - `mouseleave`
    - `mouseout`
    - `mouseover`
    - `wheel`
    - `onkeydown`
    - `onkeyup`
    - `keypress`
    - `altkey`
    - `charcode`
10. What are the different ways of inserting JavaScript code in your HTML?
    - In the body, head, or from an external file.
    - JavaScript must be inserted using the `<script>` tag
11. What is the difference between an Array and an Object?
    - All values in JavaScript other than the primitive data types are an `Object` other than undefined objects.
    - An `Array` is a kind of `Object` that can hold more than one value of the same type in a single variable
12. What does JSON stand for?
    - JavaScript Object Notation
13. What is the syntax to convert JSON text to JavaScript Object?
    - `var obj = JSON.parse(text);`
14. Create an Object in JavaScript with the following attributes and methods:
    - ```javascript
      var city = {
        name      : "Calgary",
        latitude  : 51.0486,
        longitude : -114.0708,
        population: 1096833,
        area      : 825.29,
        Density   : function() {
          return this.population / this.area;
        }
      };
      ```
