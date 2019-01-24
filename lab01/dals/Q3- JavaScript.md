# Lab 01 - Web Programming
## Client-Side Programming: JavaScript	
### Questions 3)

#### 1) List arithmetic operations in JavaScript and their description.
		Operator | Description
		`+` | Addition
		`-` | Subtraction
		`*` | Multiplication
		`**` | Exponentiation
		`/` | Division
		`%` | Modulus
		`++` | Increment
		`--` | Decrement

#### 2) List assignment operators in JavaScript and their description.
		Operator | Example | Same As
		`=` | x = y | x = y
		`+=` | x += y | x = x + y
		`-=` | x -= y | x = x - y
		`*=` | x *= y | x = x * y
		`/=` | x /= y | x = x / y
		`%=` | x %= y | x = x % y
		`<<=` | x <<= y | x = x << y
		`>>=` | x >>= y | x = x >> y
		`>>>=` | x >>>= y | x = x >>> y
		`&=` | x &= y | x = x & y
		`^=` | x ^= y | x = x ^ y
		`|=` | x \|= y | x = x \| y
		`**=` | x **= y | x = x ** y

3#### ). List comparison operators in JavaScript and their description.
		Operator | Description
		`==` | equal to
		`===` | equal value and equal type
		`!=` | not equal
		`!==` | not equal value OR not equal type
		`>` | greater than
		`<` | less than
		`>=` | greater than or equal to
		`<=` | less than or equal to

#### 4) List logical operators in JavaScript and their description.
		Operator | Description
		`&&` | and
		`||` | or
		`!` | not

#### 5) List all the data types in JavaScript.
		- numbers
		- strings
		- boolean
		- arrays
		- objects
		- function
		- null
		- undefined

#### 6) List conditional statements in JavaScript.
		- if
		- else
		- else if
		- switch

#### 7) List loop statements in JavaScript.
		- for
		- while

#### 8) What is the output of “typeof” function in JavaScript?
		Outputs the data type of the variable being passed

#### 9) List HTML keyboard events and mouse events that JavaScript can handle.
		**Keyboard events:**
		- onkeydown
		- keydown
		- keypress
		- keyup
		- altKey
		- charCode
		**Mouse events:**
		- onclick
		- onmouseover
		- onmouseout
		- mousedown
		- mouseenter
		- mouseleave
		- mousemove
		- mouseout
		- mouseup
		- wheel

#### 10) What are the different ways of inserting JavaScript code in your HTML?
		- In HTML `<head>` or `<body>` using `<script></script>` tags.
			**Note:** Placing scripts at the bottom of the `<body>` element improves the display speed, because script compilation slows down the display.
		- In an external `js` file.

#### 11) What is the difference between an Array and an Object?
		- Non-primitive types are objects (unless they are undefined variables)
		- Arrays are objects that store multiple values in a single variable.

#### 12) What does JSON stand for?
		JavaScript Object Notation

#### 13) What is the syntax to convert JSON text to JavaScript Object?
		- Data is in name/value pairs
		- Data is separated by commas
		- Curly braces hold objects
		- Square brackets hold arrays
		**To convert a JSON file into a JS object:**
		1) Create a JS string containing the JSON syntax
		2) Use JS built-in function `JSON.parse(varName)` to convert the string into a JS object.

#### 14) Create an Object in JavaScript with the following attributes and methods:
	a. Name: Calgary
	b. Latitude: 51.0486
	c. Longitude: - 114.0708
	d. Population: 1,096,833
			`var city = {Name:"Calgary", Latitude:51.0486, Longitude:-114.0708, Population:1096833, Area:825.29, Density:this.Population/this.Area};`
