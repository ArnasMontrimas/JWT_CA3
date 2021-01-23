## About

#### Website Simulating a Server which provides Services to a Client, JWT is used as an api key.
For this project i created a Client and Server. On the client a user may register and login after doing so he needs to request an api_key which will be used to execute services on the Server. There are 2 types of api keys, First for Free users, free users may use 1 free serivce this services is limited to be only used 10 times every 24 hours when limit is reached users will have to wait or buy premium.

Premium users have 3 services available to them, the first is the free service without any limits, the second allows for a more accurate search with 1 input from user and the Second allows for 2 inputs from the user to preform the search.
Premium users may also extend their premium subscription which is 30 days when first purchased to add another 30 days when purchased again, when the 30 days expire Premium users will stay premium but will not be allowed to use premium services until purchasing premium for another 30 days.
Premium users are also warned if switching to free they will loose all the purchased days they have.

When an api key is request the server register the user on the server with their user id, usage count, type and valid time they have. After this an api key is generated with a secret stored on the server and sent back to the user where it is stored on the client. When the client request services the server validateds the api key and respons appropriately either with the data or invalid authorization message.

## Functionality
##### Client
* Register/Login
* Request api key (Free or Premium)
* Request to use Service1,Servie2 or Service3

##### Server
* Register
* Generate JWT
* Validated JWT
* Execute Services
* Limit Usage

## Website
[CLIENT-SERVER_JWT-API_KEY](http://jwt-ca3.herokuapp.com/controller/)
> Website might take a minute or two to load, because of cold starts
