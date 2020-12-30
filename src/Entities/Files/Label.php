<?php

namespace Accu\Postmen\Entities\Files;

/**
 * Label file
 *
 * @package Files\Label
 * @see https://docs.postmen.com/api.html#a-label-file-object
 */
final class Label extends FileObject
{

    /**@var string Label file type */
    protected $file_type = 'pdf';

    /** @var string */
    protected $paper_size = 'default';
}
