# Simple-Payroll-App-Using-Flutterwave-Rave-API

NB: We tried to leverage on the necessary APIs we needed for this work. This is not a production app, that is why we only touched only the key features and functionalities needed. If you want to make this into a production app, then you have to take into consideration everything your user will need and problems they are likely to encounter and incoporate them in your app.....Eg Transaction History etc.

If you need help to integrate this features in your system, feel free to reach out to me at emmajiugo@gmail.com or 07031056082 and I will respond immediately.

I believe by coming here you already know about Rave by Flutterwave. If not Click Here to read more about the amazing product.

This app does a simple thing. Fund your wallet, send/transfer money to people from your wallet, even bulk transfer where you can transfer to more than 1000 people at once.

# APIs Used
Read More abount them: https://flutterwavedevelopers.readme.io/v2.0/reference

1. Rave Standard

Used to accept payment from your card/account and fund your wallet on the app.

2. Verify Transaction

Before crediting your wallet on the app, we make sure that you actually paid. We verify the transaction from the reference produced when return the call.

3. List of Banks for Transfer

This gets a list of banks you can transfer to in NGN, GHS, KES i.e. Nigeria, Ghana and Kenya.

4. Initiate Transfer

This API enables you to transfer fron your wallet to a single recipient.

5. Fetch a Transfer

We actually want to be sure the single transfer went through, so we use this API to determine that.

6. Bulk Transfer

With this API, we can transfer to more than 1000 recipient at once.

7. Retrieve Status of Bulk Transfer

We use this to determine the status of the bulk transfer. Using the ```batch_id``` from the bulk transfer, we check for successful and failed transfer of each user in the bulk transfer.

8. Account Verification

Do not send money to the wrong person....This API helps you verify the account.

There are tons of APIs made available for you to build upon. Read the API documentation from the link above and build your next amazing app.



Reach out to me anytime for help.
###### Contact:
###### Chigbo Ezejiugo
###### emmajiugo@gmail.com
###### 07031056082 (Calls, Whatsapp, Text)
