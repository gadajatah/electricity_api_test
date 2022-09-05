

# API for Electricity (PLN Postpaid) Paymentship

- [Database Structure](https://drive.google.com/file/d/1oLeJCyBYKHypSlQW4-UI_yaKINvOlm2h/view?usp=sharing)

Please, make API for these following task:

 1. API for get User Balance
	**Path URL** : ``/user-balance``
	**Method** : ``GET`` 
	**Response:**
	```json
	{
		"uuid": "" ,
		"name": "Ryan Dwianto",
		"balance": "1000000.00",
		"balanceLastUpdated" "2022-07-01 15:00:00"
	}
   ![Screenshot_20220905_083939](https://user-images.githubusercontent.com/59241871/188344918-5818e49c-f2f1-48ed-9bf9-d7caa351e416.png)
    ```

	
 2. API for get Billing / Inquiry
	**Path URL** : ``/inquiry``
	**Method** : ``POST`` 
	**Request:**
	```json
	{
		"customerId" : ""
	}
	``` 
	**Response:**
	```json
	{
		"customerId": "",
		"monthUnpaid": "Aug",
		"amount": ""
	}
	```
	**Requirements**:
	```

	- Field customerId is string
	- Value of customerId is user_uuid
	- Field customerId is required and must uuid (ref: https://www.nicesnippets.com/blog/laravel-validation-uuid-example)
	- Get only unpaid bills
	- Response Value of refNumber must be generated dynamically
	  (Means: Value is different each time API hitted)
	- Save inquiry to table Inquiry
	```
    ![Screenshot_20220905_084140](https://user-images.githubusercontent.com/59241871/188345140-b2693fd8-be3c-4a9f-917b-63423632d3b8.png)
    
	
 3. API for Create Payment Transaction
	**Path URL** : ``/transaction``
	**Method** : ``POST``  
	**Request:**
	```json
	{
	    "refNumber" : ""
    }
	``` 
	**Response:**
	```json
	{
		"customerId": "",
		"transactionId": "",
		"message": "Pending"
	}
	```
	**Requirements**:
	```
	- Field refNumber is String and Required
	- Transaction is created base on refNumber that send from request
	- if requested refNumber does not exist on Inqury table
		- Return some message on the response with status code 412
	- If requested refNumber is exist
		- Save transaction to transaction with status "Pending"
		- Reduce User Balance with amount from table Inquiry
		- Return transaction status with status code 201
	```
    ![Screenshot_20220905_084022](https://user-images.githubusercontent.com/59241871/188345276-4b5f3667-fd6d-4066-a273-d9bde202e0a7.png)
    
	
 4. API for Get Payment Transaction
	**Path URL** : ``/transaction/{transactionId}``
	**Method** : ``GET`` 
	**Response:**
	```json
	{
		"transactionId": "",
		"status": "Pending",
		"monthPaid": "Aug",
		"amountPaid": "2000.00",
		"paidAt": "YYYY-MM-DD hh:mm:ss"
	}
	```
    ![Screenshot_20220905_083720](https://user-images.githubusercontent.com/59241871/188345379-c73f39ac-e8a8-4837-94f8-047d49a6304c.png)
