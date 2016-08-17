<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Car Rental API</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	pre {
		background-color: #ffffdd;
	}

	h4 {
		background-color: #e0e0e0;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

	<div id="container">
		<h1>Welcome to Car Rental API</h1>

		<div id="body">
			<p></p>

<h1>CRUD Car</h1>

<h4>/cars POST</h4>

Request Body

Type JSON(application/json)

<pre>
{
   "brand":"Honda",
   "type":"civic",
   "year":2011,
   "color":"Black",
   "plate":"D 1234 HND"
}</pre>

Response Body

Type JSON

<pre>
{
  "id": 1
}
</pre>

 <h4>/cars/{id} PUT</h4>

Request Body

Type JSON(application/json)

<pre>
 {
   "brand":"Honda",
   "type":"civic",
   "year":2011,
   "color:"Black",
   "plate":"D 1234 HND"
}
</pre>

<h4>/cars/{id} DELETE</h4>


<h4>/cars GET</h4>

Response Body

Type JSON

<pre>[
{
"brand":"Honda",
"type":"civic",
"year":2011,
"color:"Black",
"plate":"D 1234 HND"
},
{
"brand":"Toyota",
"type":"Yaris",
"year":2015,
"color:"Orange",
"plate":"B 1234 HND"
}
]</pre>



<h1>CRUD Client</h1>

<h4>/clients POST</h4>

Request Body

Type JSON(application/json)

<pre>
{
   "name": "Ahmad",
   "gender": "male"
}
</pre>

Response Body

Type JSON

<pre>
{
  "id": 1
}
</pre>


<h4>/clients/{id} PUT</h4>

Request Body

Type JSON(application/json)

<pre>
{
   "name": "Ahmad Nurwanto",
   "gender": "male"
}
</pre>


<h4>/clients/{id} DELETE</h4>


<h4>/clients GET</h4>

Response Body

Type JSON

<pre>[
    {
        "id": 1, 
        "name": "Ahmad Nurwanto",
        "gender": "male"
    },
    {
        "id": 2,
        "name": "Rizki",
        "gender": "male"
    },
    {
        "id": 3,
        "name": "Ihsan",
        "gender": "male"
    }
]</pre>





<h1>CRUD Rentals

<h4>/rentals POST</h4>

Request Body

Type JSON(application/json)

<pre>
{
  "car-id":1,
  "client-id":2,
  "date-from":"2016-08-15",
  "date-to":"2016-08-17"
}</pre>

Response Body

Type JSON

<pre>
{
  "id": 1
}</pre>


<h4>/rentals/{id} PUT</h4></h4>

Request Body

Type JSON(application/json)


<pre>
{
  "car-id":2,
  "client-id":2,
  "date-from":"2016-08-15",
  "date-to":"2016-08-17"
}</pre>


<h4>/rentals/{id} DELETE</h4>


<h4>/rentals GET</h4>

Response Body

Type JSON
<pre>
[
	{
		"name":"Ahmad",
		"brand":"Honda",
		"type":"Civic",
		"plate":"D 1234 HND",
		"date-from:"2016-08-17",
		"date-to:"2016-08-19"
	},
	{
		"name":"Rizki",
		"brand":"Toyota",
		"type":"Yaris",
		"plate":"D 4444 TYT",
		"date-from:"2016-08-17",
		"date-to:"2016-08-19"
	}
]
</pre>

<h1>Client Rental History</h1>


<h4>/histories/client/{id} GET</h4>

Response Body

Type JSON

<pre>
{
  "id": "1",
  "name": "Alimin",
  "gender": "female",
  "histories": [
    {
      "brand": "Honda",
      "type": "Jazz",
      "plate": "D 1234 H",
      "date-from": "2016-08-15",
      "date-to": "2016-08-17"
    }
  ]
}</pre>

<h1>Car Rental History within specified month</h1>

<h4>/histories/car/{id}?month={mm-yyyy}</h4>


Response Body

Type JSON

<pre>
{
  "id": "1",
  "brand": "Honda",
  "type": "Jazz",
  "plate": "D 1234 H",
  "histories": [
    {
      "rent-by": "Alimin",
      "date-from": "2016-08-15",
      "date-to": "2016-08-17"
    },
    {
      "rent-by": null,
      "date-from": "2016-08-18",
      "date-to": "2016-08-19"
    },
    {
      "rent-by": null,
      "date-from": "2016-08-19",
      "date-to": "2016-08-21"
    }
  ]
}
</pre>


<h1>Rented Car Information</h1>

<h4>cars/rented?date={dd-mm-yyyy}</h4>

Response Body

Type JSON

<pre>
{
  "date": "19-08-2016",
  "rented_cars": [
    {
      "brand": "Honda",
      "type": "Jazz",
      "plate": "D 1234 H"
    },
    {
      "brand": "Honda",
      "type": "civic",
      "plate": "D 1234 HND"
    }
  ]
}
</pre>


<h1>Available Car Information</h1>

<h4>cars/free?date={dd-mm-yyyy}</h4>

Response Body

Type JSON

<pre>
{
  "date": "16-08-2016",
  "free_cars": [
    {
      "brand": "Honda",
      "type": "civic",
      "plate": "D 1234 HND"
    }
  ]
}
</pre>
		</div>

	</body>
	</html>
