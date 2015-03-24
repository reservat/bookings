# bookings

Bookings API

## Code Style

PSR-2

## Response

All responses must come through either the ApiSuccess or ApiError classes. This is to ensure we have a standard response presented the to API Consumer.

You can build a response as such:

```
    $data = new \StdClass();

    $data->field = 'test';
    $data->data = 'Test Data';

    \Bookings\Core\ApiSuccess::build([$data])->serve($res);
```

## Dates

All dates in the system **MUST** use the \Bookings\Core\DateTime class.
We are using the ISO8601 date format, There is a handy extra function added by our datetime class as such:

```
	$date = new \Bookings\Core\DateTime();
	$date->apiFormat(); // returns current date and time is ISO8601
``` 

