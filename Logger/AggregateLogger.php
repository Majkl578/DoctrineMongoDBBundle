<?php

namespace Doctrine\Bundle\MongoDBBundle\Logger;

/**
 * An aggregate query logger.
 *
 */
class AggregateLogger implements LoggerInterface
{
    /** @var LoggerInterface[] */
    private $loggers;

    /**
     * Constructor.
     *
     * @param LoggerInterface[] $loggers An array of LoggerInterface objects
     */
    public function __construct(array $loggers)
    {
        $this->loggers = $loggers;
    }

    /**
     * {@inheritdoc}
     */
    public function logQuery(array $query)
    {
        foreach ($this->loggers as $logger) {
            $logger->logQuery($query);
        }
    }
}
