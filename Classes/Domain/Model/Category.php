<?php

namespace Undkonsorten\Addressmgmt\Domain\Model;

use TYPO3\CMS\Extbase\Annotation as Extbase;

class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category
{

    /**
     * @var Category|null
     * @Extbase\ORM\Lazy
     */
    protected $parent;
}
