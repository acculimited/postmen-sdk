<p align="center"><img src="https://a.storyblok.com/f/80899/x/572adff619/postmen_www_logo.svg" width="400"></p>

<p align="center">
<a href="https://github.com/acculimited/postmen-sdk/actions?query=workflow%3A%22CI%22"><img src="https://github.com/acculimited/postmen-sdk/workflows/CI/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/accu/postmen-sdk"><img src="https://img.shields.io/packagist/dt/accu/postmen-sdk" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/accu/postmen-sdk"><img src="https://img.shields.io/packagist/v/accu/postmen-sdk" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/accu/postmen-sdk"><img src="https://img.shields.io/packagist/l/accu/postmen-sdk" alt="License"></a>
</p>

# Accu Postmen SDK

A composable package that provides a modern client to use with the Postmen.com API.

```php
$client = new \Accu\Postmen\Client(
    (new \Accu\Postmen\Configuration('your-api-key', $testMode = true))
        ->setMaxRetries(1)
);

/** @var \Accu\Postmen\Entities\Label $label */
$label = $client->send((new \Accu\Postmen\Requests\Labels\Create())
    ->addReference('Dispatch #1')
    ->setServiceType('dpd-uk_parcel_1d')
    ->setShipperAccount((new \Accu\Postmen\Entities\ShipperAccount())
        ->setId('your-shipper-account-id')
    )
    ->setShipment((new \Accu\Postmen\Entities\Shipment())
        ->setShipTo((new \Accu\Postmen\Entities\Address())
            ->setContactName('Goods In')
            ->setCompanyName('Accu Limited')
            ->setStreet1('Haggwood Stone Quarry')
            ->setStreet2('Woodhead Road')
            ->setCity('Holmfirth')
            ->setPostalCode('HD9 6PW')
            ->setCountry('GBR')
            ->setEmail('goods-in@accu.co.uk')
            ->setPhone('0123456789')
        )
        ->setShipFrom((new \Accu\Postmen\Entities\Address())
            ->setContactName('Goods Out')
            ->setCompanyName('Accu Limited')
            ->setStreet1('Haggwood Stone Quarry')
            ->setStreet2('Woodhead Road')
            ->setCity('Holmfirth')
            ->setPostalCode('HD9 6PW')
            ->setCountry('GBR')
            ->setEmail('goods-out@accu.co.uk')
            ->setPhone('0123456789')
        )
        ->setDeliveryInstructions('Please ring the bell')
        ->addParcel((new \Accu\Postmen\Entities\Parcel())
            ->setBoxType('custom')
            ->setDimension((new \Accu\Postmen\Entities\Dimension())
                ->setUnit('cm')
                ->setHeight(30)
                ->setWidth(50)
                ->setDepth(30)
            )
            ->addItem((new \Accu\Postmen\Entities\Item())
                ->setSku('APC000001')
                ->setItemId('tiny-screw-1')
                ->setDescription('A small screw')
                ->setWeight((new \Accu\Postmen\Entities\Weight())
                    ->setUnit('kg')
                    ->setValue(0.001)
                )
                ->setQuantity(1000)
                ->setPrice((new \Accu\Postmen\Entities\Money())
                    ->setCurrency('GBP')
                    ->setAmount(0.005)
                )
                ->setOriginCountry('GBR')
                ->setHsCode('7318141090')
            )
            ->setWeight((new \Accu\Postmen\Entities\Weight())
                ->setUnit('kg')
                // Sum of items plus packaging.
                ->setValue(1.2)
            )
        )
    )
);

echo $label->getId(); // the-label-identifier
echo $label->getTrackingNumbers(); // ['tracking-1..', 'tracking-2..', ...]
echo $label->getFiles()->getLabel()->getUrl(); // The shipping labels to be printed
```

## Help and docs

Please use GitHub issues to discuss bugs and new features.

## Installing the Postmen SDK

The recommended way to install the SDK is through
[Composer](https://getcomposer.org/).

```bash
composer require accu/postmen-sdk
```

Brought to you by:
<p align="center"><a href="https://www.accu.co.uk" target="_blank"><img src="https://i.accu.co.uk/brands/AccuPro.svg" width="400"></a></p>
<p align="right">Accuracy. Delivered.</p>
