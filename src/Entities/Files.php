<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;
use UnexpectedValueException;

/**
 * Files object which stores the various file types provided by the Postmen API.
 *
 * @see https://docs.postmen.com/api.html#a-files-object
 */
final class Files extends PostmenEntity
{
    use JsonSchema;

    public const JSON_SCHEMA = '/files';

    /** @var Files\CustomsDeclaration */
    private $customs_declaration;

    /** @var Files\Label */
    private $label;

    /** @var Files\Invoice */
    private $invoice;

    /** @var Files\QRCode */
    private $qr_code;

    public function getCustomsDeclaration(): ?Files\CustomsDeclaration
    {
        return $this->customs_declaration;
    }

    public function setCustomsDeclaration(Files\CustomsDeclaration $customsDeclaration): Files
    {
        $this->customs_declaration = $customsDeclaration;
        return $this;
    }

    public function getLabel(): ?Files\Label
    {
        return $this->label;
    }

    public function setLabel(Files\Label $label): Files
    {
        $this->label = $label;
        return $this;
    }

    public function getInvoice(): ?Files\Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Files\Invoice $invoice): Files
    {
        $this->invoice = $invoice;
        return $this;
    }

    public function getQRCode(): ?Files\QRCode
    {
        return $this->qr_code;
    }

    public function setQRCode(Files\QRCode $qrCode): Files
    {
        $this->qr_code = $qrCode;
        return $this;
    }

    /**
     * @param array $data
     * @return PostmenEntity|Files
     */
    public static function fromData(array $data)
    {
        $instance = new self();

        foreach ($data as $fileType => $payload) {
            try {
                $file = Files\FileFactory::make($fileType, $payload);
            } catch (UnexpectedValueException $exception) {
                continue;
            }

            if ($file instanceof Files\Label) {
                $instance->setLabel($file);
            } elseif ($file instanceof Files\Invoice) {
                $instance->setInvoice($file);
            } elseif ($file instanceof Files\CustomsDeclaration) {
                $instance->setCustomsDeclaration($file);
            } elseif ($file instanceof Files\QRCode) {
                $instance->setCustomsDeclaration($file);
            }
        }

        return $instance;
    }
}
