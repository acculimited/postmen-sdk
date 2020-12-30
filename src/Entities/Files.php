<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\JsonSerializer;
use Accu\Postmen\Utility\PostmenEntity;
use UnexpectedValueException;

/**
 * Files object which stores the various file types provided by the Postmen API.
 *
 * @see https://docs.postmen.com/api.html#a-files-object
 */
final class Files extends PostmenEntity
{
    use JsonSerializer;

    /**@var Files\Label */
    private $label;

    /** @var Files\Invoice */
    private $invoice;

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
            }
        }

        return $instance;
    }
}
