# AllMySMS

A PHP Client library for accesing AllMySMS APIs. Used official documentation : https://www.allmysms.com/_documents/api/http/AllMySMS_DocTechnique_Api_HTTP.pdf

## Installation

This page contains information about installing the Library for PHP.

### Requirements

- PHP version 5.3.0 or greater (including PHP 7)

### Obtaining the client library

There are two options for obtaining the files for the client library.

#### Using Composer

You can install the library by adding it as a dependency to your composer.json.

```
  "require": {
    "quentinix/allmysms": "^1.0"
  }
```

#### Cloning from GitHub

The library is available on [GitHub](https://github.com/Quentinix/AllMySMS). You can clone it into a local repository with the git clone command.

```
git clone https://github.com/Quentinix/AllMySMS.git
```

### What to do with the files

After obtaining the files, ensure they are available to your code. If you're using Composer, this is handled for you automatically. If not, you will need to add the `autoload.php` file inside the client library.

```
require '/path/to/allmysms/folder/autoload.php';
```

## Usage

### Initialize client
```
<?php

$client = new \Quentinix\AllMySMS\Client();
$client->setLogin('MyLogin');
$client->setApiKey('MyApiKey');
// Or
$client = new \Quentinix\AllMySMS\Client('MyLogin', 'MyApiKey');

```

### For Send SMS

```
<?php

// ...

// SMS
$service = new Quentinix\AllMySMS\Service\Message\OutGoing($client);
$sms = new \Quentinix\ALlMySMS\Model\SMS();

// Required
$sms->addRecipient('0600000000');
$sms->setMessage('My message');

// Optional
$sms->setId('MyID');
$sms->setSender('MySociety');
$sms->setCampaign('MyCampaignName');
$sms->activeFlashMode(); 
$sms->activeEmailNotification();
$sms->setMasterAccountLogin('MasterLogin');
$sms->addRecipient('0600000000', ['PARAM_1' => 'David']);

$sms->setDate('+ 1 hour');
// or
$sms->setDate('2017-09-01 00:00:00');

// Send SMS (without optional configuration)
$response = $service->simpleSMS($sms);

// Send SMS (with optional configuration)
$response = $service->sendSMS($sms);

// If simulate 
$response = $service->simulateSMS($sms);

// To get SMS Length 
$smsLength = $sms->getLength();

// To get Message Length
$smsContentLength = $sms->getMessageLength();
```

### For Send MMS

```
<?php

// ...

// MMS
$service = new Quentinix\AllMySMS\Service\Message\OutGoing($client);
$mms = new \Quentinix\ALlMySMS\Model\MMS();
// Required
$sms->addRecipient('0600000000');
$mms->setMessage('MyMessage');
// or (and if message < 160 char)
$mms->setPictureUrl('http://.....');
// or 
$mms->setVideoUrl('http://.....');
// or 
$mms->setSoundUrl('http://.....');

// Optional
$sms->setId('MyID');
$mms->setCampaign('CampaignName');
$mms->setDate('+ 1 hour');
// or
$mms->setDate('2017-09-01 00:00:00');
$sms->activeEmailNotification();

// Send MMS
$response = $service->sendMMS($sms);

// To get MMS Length 
$smsLength = $sms->getLength();

// To get Message Length
$smsContentLength = $sms->getMessageLength();
```

### For Send Email

```
<?php

// ...

// MMS
$service = new Quentinix\AllMySMS\Service\Message\OutGoing($client);
$email = new \Quentinix\ALlMySMS\Model\Email();

// Required
$email->setFrom('my@email.fr');
$email->setRecipient('email@test.fr');
$email->setSubject('My Subject');
$email->setContentHtml('My HTML content');

// Optional
$email->setFrom('my@email.fr', 'myAlias');
$email->setAlias('myAlias');
$email->setDate('+ 1 hour');
// or
$email->setDate('2017-09-01 00:00:00');
$email->setContentText('My Text content');
$email->setCampaignName('My Campaign Name');
$email->setReplyTo('replay@email.fr');

// Send Email
$service->sendEmail($email);

