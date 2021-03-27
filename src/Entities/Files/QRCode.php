<?php

namespace Accu\Postmen\Entities\Files;

/**
 * QR Code file object
 *
 * @package Files\QRCode
 * @see https://docs.postmen.com/api.html#a-qr-code-file-object
 */
final class QRCode extends FileObject
{
    public const JSON_SCHEMA = '/qrcode_file';

    /**@var string QRCode file type */
    protected $file_type = 'png';

    /** @var string */
    protected $paper_size = '1x1';
}
