<?php

namespace Accu\Postmen\Tests\Unit\Requests;

use Accu\Postmen\Entities\Address;
use Accu\Postmen\Entities\Billing;
use Accu\Postmen\Entities\Customs;
use Accu\Postmen\Entities\Dimension;
use Accu\Postmen\Entities\Files\Invoice;
use Accu\Postmen\Entities\Files\Label as LabelFile;
use Accu\Postmen\Entities\Item;
use Accu\Postmen\Entities\Label;
use Accu\Postmen\Entities\Money;
use Accu\Postmen\Entities\Parcel;
use Accu\Postmen\Entities\Shipment;
use Accu\Postmen\Entities\ShipperAccount;
use Accu\Postmen\Entities\Weight;
use Accu\Postmen\Requests\Labels\Create as CreateLabel;
use PHPUnit\Framework\TestCase;

class CreateLabelTest extends TestCase
{
    public function testRequestGeneratesValidJson()
    {
        $shipment = (new Shipment())
            ->setShipFrom((new Address())
                ->setContactName('Nottingham Inc.')
                ->setCompanyName('Nottingham Inc.')
                ->setStreet1('2511 S. Main St.')
                ->setCity('Grove')
                ->setState('OK')
                ->setPostalCode('74344')
                ->setCountry('USA')
                ->setPhone('1-403-504-5496')
                ->setEmail('test@test.com')
                ->setType('business')
            )
            ->setShipTo((new Address())
                ->setContactName('Rick McLeod (RM Consulting)')
                ->setStreet1('71 Terrace Crescent NE')
                ->setStreet2('This is the second street')
                ->setCity('Medicine Hat')
                ->setState('Alberta')
                ->setPostalCode('T1C1Z9')
                ->setCountry('CAN')
                ->setPhone('1-403-504-5496')
                ->setEmail('test@test.test')
                ->setType('residential')
            )
            ->addParcel((new Parcel())
                ->setDescription('Food XS')
                ->setBoxType('custom')
                ->setWeight((new Weight())
                    ->setValue(2)
                    ->setUnit('kg')
                )
                ->setDimension((new Dimension())
                    ->setDepth(40)
                    ->setHeight(40)
                    ->setWidth(20)
                    ->setUnit('cm')
                )
                ->addItem((new Item())
                    ->setDescription('Food Bar')
                    ->setOriginCountry('USA')
                    ->setQuantity(2)
                    ->setPrice((new Money())
                        ->setAmount(3)
                        ->setCurrency('USD')
                    )
                    ->setWeight((new Weight())
                        ->setValue(0.6)
                        ->setUnit('kg')
                    )
                    ->setSku('Epic_Food_Bar')
                    ->setHsCode('1234.12')
                )
            );

        $labelRequest = new CreateLabel();
        $labelRequest
            ->setShipment($shipment)
            ->setPaperSize('4x8')
            ->setShipperAccount(
                (new ShipperAccount())->setId('00000000-0000-0000-0000-000000000000')
            )
            ->setServiceType('dhl_express_worldwide')
            ->addReference('referenceid')
            ->setCustoms((new Customs())
                ->setPurpose('gift')
                ->setTermsOfTrade('ddu')
                ->setBilling((new Billing())
                    ->setPaidBy('recipient')
                )
            );

        self::assertJsonStringEqualsJsonFile(
            __DIR__ . '/../../resources/create-label-request.json',
            \GuzzleHttp\Utils::jsonEncode($labelRequest, JSON_PRETTY_PRINT)
        );
    }

    public function testResponseMapsALabel()
    {
        $json = \GuzzleHttp\json_decode(
            \file_get_contents(__DIR__ . '/../../resources/create-label-response.json'),
            true
        );

        $label = (new CreateLabel())->mapResponseData($json);

        self::assertInstanceOf(Label::class, $label);
        self::assertEquals('d5a76375-1100-4c14-96c3-3cbb3c35734f', $label->getId());
        self::assertEquals('created', $label->getStatus());

        self::assertInstanceOf(LabelFile::class, $label->getFiles()->getLabel());
        self::assertEquals(
            'https://sandbox-download.postmen.com/label/2020-12-30/label-guid.pdf',
            $label->getFiles()->getLabel()->getUrl()
        );
        self::assertInstanceOf(Invoice::class, $label->getFiles()->getInvoice());
        self::assertEquals('a4', $label->getFiles()->getInvoice()->getPaperSize());

        self::assertEquals('75400d65-1c64-4c57-8507-28332a1629ae', $label->getShipperAccount()->getId());
    }

    public function testLabelResponseValidatesJson()
    {
        $json = \GuzzleHttp\json_decode(
            \file_get_contents(__DIR__ . '/../../resources/create-label-response.json'),
            true
        );

        $label = (new CreateLabel())->mapResponseData($json);
        self::assertJson(json_encode($label));
    }
}
