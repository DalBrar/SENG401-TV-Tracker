# Lab 01 - Web Programming

## Client-Side Programming: HTML
### Questions 1)

#### 1) What does HTML stand for?
		Hyper Text Markup Language
		
#### 2) What are the two major nodes of an HTML file (inside <html> </html> node)?
		`head` and `body`
		
#### 3) What are the steps of HTML growth (Version and Year)?
		1. HTML 1.0 in 1993
		2. HTML 2.0 in 1995
		3. HTML 3.2 in 1997 (Jan)
		4. HTML 4.0 in 1997 (Dec)
		5. HTML 4.0.01 in 1999
		6. HTML 5.0 in 2014
		7. HTML 5.1 in 2016
		8. HTML 5.2 in 2017

#### 4) How many headings does HTML support?
		6 using `<h#>` where # is a value from 1 to 6
		
#### 5) What are HTML text formatting elements and how they affect a piece of text?
		`<b>` - Bold text
		`<strong>` - Important text
		`<i>` - Italic text
		`<em>` - Emphasized text
		`<mark>` - Marked text
		`<small>` - Small text
		`<del>` - Deleted text
		`<ins>` - Inserted text
		`<sub>` - Subscript text
		`<sup>` - Superscript text
		
#### 6) How do you comment a line in HTML?
		Surround your comment with comment beginning and end tags:
		`<!--` for comment beginning
		`-->` for comment end

#### 7) What are the main ways to define a color in HTML? (provide examples)
		To define a color you should use css to define the color of the element.
		The color itself can then be defined using the following methods:
		- RGB: `rgb(#1, #2, #3)`
			where #1/#2/#3 are numerical values of the colors Red, Green, and Blue respectively from 0 to 255
		- HEX: `#rrggbb`
			where rr/gg/bb are hexadecimal values of the colors Red, Green, Blue respectively.
		- HSL: `hsl(h, s, l)`
			Where:
				`h` is a value of Hue from 0 to 360.
				`s` is saturation value from 0% to 100%
				`l` is lightness value from 0% to 100%
		- RGB: `rgba( r, g, b, a)`
			Similar to RGB with with the added `a` for the alpha value from 0.0 to 1.0
		- HSLA: `hsla(h, s, l, a)`
			Similar to HSL with the added `a` for the alpha value from 0.0 to 1.0

#### 8) Write a piece of code for a link that opens the following site in a new tab:
		`<a href="www.w3schools.com" alt="W3Schools" target="_blank">www.w3schools.com</a>`
		
#### 9) What are the tags for ordered list and unordered list?
		`<ol></ol>` for ordered lists
		`<ul></ul>` for undordered lists
		and `<li></li>` for list elements.
		
#### 10) What is the use of class attribute? What is the difference between class and id?
		`class` used to define equal styles for elements with the same class
		`id` specifies a unique id and style for an element
		
#### 11) What is Responsive Web Design?
		It is about using HTML and CSS to automatically resize, hide, shrink, or enlarge a website to make it look good on all viewports (dektops, tablets, and phones).
		
#### 12) What is a URL?
		URL stands for `Uniform Resource Locator` and is used as the addresses of objects on the web
		
#### 13) What are the main Form->Input Types in HTML?
		`text` - defines a one-line text input field.
		`password` - defines a password field.
		`submit` - defines a button for submitting form data to a form-handler.
		`reset` - defines a reset button that will reset all form values to their default values.
		`radio` - defines a radio button that lets a user select ONLY ONE of a limited number of choices.
		`checkbox` - defines a checkbox that lets a user select ZERO or MORE options of a limited number of choices.
		`button` - defines a button.

#### 14) What is the difference between “GET” and “POST” in HTML forms? Which one is suitable for sending sensitive data?
		`GET`
			- default method when submitting form data.
			- the submitted data will be appended to the page address field and visible to the user.
			- page address field has a limit of ~3000 characters thus longer data will be lost.
		`POST`
			- suitable for sending sensitive data.
			- does not display the submitted data in the page address field.
			- has no size limitations and can be used to transfer large amounts of data.
