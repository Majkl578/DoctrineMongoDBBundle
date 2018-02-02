<?php

namespace Doctrine\Bundle\MongoDBBundle\Cursor;

/**
 * Contract for tailable cursor processors.
 */
interface TailableCursorProcessorInterface
{
    public function process($document);
}
