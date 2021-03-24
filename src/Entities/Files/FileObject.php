<?php

namespace Accu\Postmen\Entities\Files;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * Abstract file object
 *
 * @package Files\FileObject
 * @see https://docs.postmen.com/api.html#a-files-object
 */
abstract class FileObject extends PostmenEntity
{
    use JsonSchema;

    /**@var string */
    protected $file_type = 'pdf';

    /** @var string */
    protected $paper_size = 'default';

    /** @var string */
    protected $url;

    public function getFileType(): string
    {
        return $this->file_type;
    }

    public function setFileType(string $file_type): self
    {
        $this->file_type = $file_type;
        return $this;
    }

    public function getPaperSize(): string
    {
        return $this->paper_size;
    }

    public function setPaperSize(string $paper_size): self
    {
        $this->paper_size = $paper_size;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }
}
