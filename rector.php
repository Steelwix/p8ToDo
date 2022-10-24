<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Symfony\Set\SymfonySetList;
use Rector\Symfony\Set\SymfonyLevelSetList;
use Rector\Symfony\Set\LevelSetList;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Symfony\Set\SensiolabsSetList;


return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->symfonyContainerXml(__DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml');
    $rectorConfig->sets([
        SensiolabsSetList::FRAMEWORK_EXTRA_61,
        SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES,
        DoctrineSetList::ANNOTATIONS_TO_ATTRIBUTES
    ]);
};
