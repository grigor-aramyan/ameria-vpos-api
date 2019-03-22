Source code of currently running API for Ameria vPOS, written in PHP.

## Endpoints
1. get_payment_id,
2. get_payment_fields,
3. reverse_payment,

## Request/Response data and format
Every endpoint is expecting HTTP post request, with following required fields:
1. get_payment_id:
  * clientId, string - id of your store or website, given by Ameria,
  * username, string - username of your account in Ameria system,
  * password, string - password of your account in Ameria system,
  * orderId, integer - id of order for which your are processing this payment,
  * description, string - short description of order,
  * amount, decimal - amount, which should be paid,
  * backUri, string - URI to where Ameria system should redirect after completing payment

Successful response of this endpoint is the link, where user can complete the payment, so you should redirect browser to it. In case of error, empty string will be returned.

2. get_payment_fields:
  * clientId, string - your id, given by Ameria,
  * username, string - username of your account in Ameria system,
  * password, string - password of your account in Ameria system,
  * orderId, integer - id of order for which your are processing this payment,
  * amount, decimal - amount, which should be paid

This endpoint will return a lot of data about completed payment in JSON encoded format. Here's an example:
  ```
  {
    "merchantid", string - id of your store or website, given by Ameria
    "terminalid", string - sub-id of your store or website
    "datetime", string - date and time of payment
    "amount", decimal - amount of payment
    "cardnumber", string - partially enclosed cardnumber of buyer
    "clientname", string - name of buyer
    "orderid", integer - id of order this payment is for
    "stan", string - id of operation
    "authcode", string - authorization code of operation
    "mdorder", string - code of operation
    "trxnDetails", string - description of operation
  }
  ```

In case of error, same JSON encoded object will be returned, with 0s and empty strings as the values of appropriate fields.

3. reverse_payment:
  * clientId, string - your id, given by Ameria,
  * username, string - username of your account in Ameria system,
  * password, string - password of your account in Ameria system,
  * orderId, integer - id of order for which your are processing this payment,
  * amount, decimal - amount, which should be paid

Endpoint will return funds to buyer. This feature is active within 3 days after successful completion of payment. Both successful and error scenarios will return same JSON encoded object in response:
```
{
  "code", string - code of operation, '00' being successful reversal of payment
  "message", string - message accompanying the code
}
```
