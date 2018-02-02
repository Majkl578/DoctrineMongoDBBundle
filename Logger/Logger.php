<?php

namespace Doctrine\Bundle\MongoDBBundle\Logger;

use Psr\Log\LoggerInterface as PsrLogger;

/**
 * A lightweight query logger.
 */
class Logger implements LoggerInterface
{
    /** @var PsrLogger */
    private $logger;

    /** @var string */
    private $prefix;

    /** @var int */
    private $batchInsertThreshold;

    public function __construct(PsrLogger $logger = null, $prefix = 'MongoDB query: ')
    {
        $this->logger = $logger;
        $this->prefix = $prefix;
    }

    public function setBatchInsertThreshold($batchInsertThreshold)
    {
        $this->batchInsertThreshold = $batchInsertThreshold;
    }

    /**
     * {@inheritdoc}
     */
    public function logQuery(array $query)
    {
        if ($this->logger === null) {
            return;
        }

        if (isset($query['batchInsert']) && $this->batchInsertThreshold !== null && $this->batchInsertThreshold <= $query['num']) {
            $query['data'] = '**' . $query['num'] . ' item(s)**';
        }

        array_walk_recursive($query, function (&$value, $key) {
            if ($value instanceof \MongoBinData) {
                $value = base64_encode($value->bin);
                return;
            }
            if (is_float($value) && is_infinite($value)) {
                $value = ($value < 0 ? '-' : '') . 'Infinity';
                return;
            }
            if (is_float($value) && is_nan($value)) {
                $value = 'NaN';
                return;
            }
        });

        $this->logger->debug($this->prefix . json_encode($query));
    }
}
