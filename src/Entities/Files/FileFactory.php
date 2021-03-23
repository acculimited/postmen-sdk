<?php

namespace Accu\Postmen\Entities\Files;

use UnexpectedValueException;

class FileFactory
{
    public const FILE_TYPE_MAP = [
        'customs_declaration' => CustomsDeclaration::class,
        'invoice' => Invoice::class,
        'label' => Label::class,
    ];

    public static function make(string $fileType, ?array $data): FileObject
    {
        if ($data === null) {
            throw new UnexpectedValueException('No payload data to parse');
        }

        $fileClass = self::FILE_TYPE_MAP[$fileType] ?? null;

        if (! $fileClass) {
            throw new UnexpectedValueException("Unrecognised file type: [{$fileType}]");
        }

        $file = new $fileClass();
        $file
            ->setPaperSize($data['paper_size'] ?? null)
            ->setUrl($data['url'] ?? null)
            ->setFileType($data['file_type'] ?? 'pdf');

        return $file;
    }
}
