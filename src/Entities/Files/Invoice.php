<?php

namespace Accu\Postmen\Entities\Files;

/**
 * An Invoice file
 *
 * @package Files\Invoice
 * @see https://docs.postmen.com/api.html#a-invoice-file-object
 */
final class Invoice extends FileObject
{
    public const JSON_SCHEMA = '/invoice_file';

    /**@var string Label file type */
    protected $file_type = 'pdf';

    /** @var string */
    protected $paper_size = 'a4';
}
