<?php
/**
 * YAWIK
 *
 * @filesource
 * @license MIT
 * @copyright https://yawik.org/COPYRIGHT.php
 */

/** */
namespace Jobs\Form\Hydrator\Strategy;

use Laminas\Hydrator\Strategy\StrategyInterface;
use Organizations\Repository\Organization as OrganizationRepository;

/**
 * ${CARET}
 *
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 * @todo write test
 */
class OrganizationNameStrategy implements StrategyInterface
{
    /**
     *
     *
     * @var OrganizationRepository
     */
    private $repository;

    public function __construct(OrganizationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function extract($value)
    {
        if ($value instanceof \Organizations\Entity\Organization) {
            return $value->getId();
        }

        return null;
    }

    public function hydrate($value)
    {
        return $this->repository->find($value);
    }
}
