<?php

namespace Accu\Postmen\Entities\Files;

/**
 * A Customs Declaration file
 *
 * @package Files\Invoice
 * @see https://docs.postmen.com/api.html#a-customs-declaration-file-object
 */
final class CustomsDeclaration extends FileObject
{
    public const JSON_SCHEMA = '/customs_declaration_file';

    /**@var string Label file type */
    protected $file_type = 'pdf';

    /** @var string */
    protected $paper_size = 'a4';
}
