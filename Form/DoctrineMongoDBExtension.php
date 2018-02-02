<?php

namespace Doctrine\Bundle\MongoDBBundle\Form;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractExtension;

/**
 * Form extension.
 */
class DoctrineMongoDBExtension extends AbstractExtension
{
    /** @var ManagerRegistry|null */
    protected $registry = null;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    protected function loadTypes()
    {
        return [
            new Type\DocumentType($this->registry),
        ];
    }

    protected function loadTypeGuesser()
    {
        return new DoctrineMongoDBTypeGuesser($this->registry);
    }
}
