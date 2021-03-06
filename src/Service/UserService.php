<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\DeveloperGroup;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

use Carbon\Carbon;

/**
 * PackageService serves to perform package operations such as creation, lookup, etc.
 */
class UserService {

    private $em;
    private $security;

    /**
     * Initializes this instance when needed by a request.
     *
     * @param EntityManagerInterface $em Provides access to database backed entities.
     * @param Security $security Provides access to currently logged in user, if any, to check permissions.
     */
    public function __construct(EntityManagerInterface $em, Security $security) {
        $this->security = $security;
        $this->em = $em;
    }
    
    /**
     * Generates a list of packages by various search criteria.
     *
     * @param [type] $params
     * @return Array Array of packages matching criteria
     */
    public function lookupBy($params) {
        if (empty($params)) {
            return [];
        }

        $qb = $this->em->createQueryBuilder();
    }

    /**
     * Finishes setup for a user, typically on the first time they log in.
     *
     * @param User $user The user to finish setting up
     */
    public function finishSetup(User $user) {
        //make sure user has personal DeveloperGroup
        if (is_null($user->getPersonalGroup())) {
            $grp = new DeveloperGroup();

            $user->setPersonalGroup($grp);
            $grp->setPersonalUser($user);

            $this->em->persist($user);
            $this->em->persist($grp);
            $this->em->flush();
        }
    }
}