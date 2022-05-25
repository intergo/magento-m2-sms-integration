
## SMSto SMS Integration Magento 2 Module

The SMSto SMS Integration is an integration with the Magento e-commerce platform. This Integration enables Magento store admins to configure automated SMS notifications to the administrator and customers for important order status updates, and also allows sending bulk SMS messages to customers. The Integration is free, but a SMSto account is required to send messages. Signup with our service is free as well, and you pay only for the SMS messages. The Integration offers great flexibility, in sending individual SMS or bulk SMS messages to various groups.

No contracts, no commitments, pay only for what you use. In case of high volume SMS API usage, our sales team is prepared to give out additional discounts.

## Integration Compatibility

* Magento Community Edition: 2.4

## Features


* Easy options to check the balance, login to SMSto, get support and buy credits.<br/>
* Allows flexibility in enabling/disabling the Integration as well as setting individual triggers.<br/>
* When a new order is placed<br/>
* When the order is paid (invoice created)<br/>
* When a new shipment is created<br/>
* when order is canceled<br/>
* when order is refunded (Credit Memo)<br/>
* when order is on hold<br/>
* when order is on unhold<br/>
* Allows you to send/schedule individual SMS messages<br/>
* Allows you to send bulk SMS to customers.<br/>
* Allows you to send individual SMS to customer<br/>
* Options to send notifications to admin for all the triggers.<br/>
* Provide a complete list of sent messages history with the details and the status of the message.
* Supports Unicode SMS messages.
</p>
<br/>

## Install

* Go to Magento2 root folder

* Enter following command to install module:

```bash
composer require smsto/module-sms
```


* Enter following commands to enable module:

```bash
php bin/magento module:enable Smsto_Sms --clear-static-content
php bin/magento setup:upgrade
php bin/magento setup:di:compile
```

## Support

For general support or questions about your SMSto account, you can reach out to  [our website](https://support.sms.to/).
