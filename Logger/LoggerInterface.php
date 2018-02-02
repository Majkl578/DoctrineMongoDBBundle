<?php

namespace Doctrine\Bundle\MongoDBBundle\Logger;

/**
 * Logger for the Doctrine MongoDB ODM.
 *
 * The {@link logQuery()} method must be configured as the logger callable in
 * the service container.
 */
interface LoggerInterface
{
    /**
     * @param mixed[] $query
     */
    public function logQuery(array $query);
}
