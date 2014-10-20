<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

/**
 * UniquekeyToUserTransformer
 *
 * @author aguigand <aguigand@umanit.fr>
 */
class UniquekeyToUserTransformer implements DataTransformerInterface
{

    /** @var ObjectManager */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforme une clef unique (string) en utilisateur (User)
     * 
     * @param type $uniqueKey
     * @return User
     * @throws TransformationFailedException
     */
    public function reverseTransform($uniqueKey)
    {
        if (!$uniqueKey) {
            return null;
        }
        // Récupération de l'utilisateur
        $user = $this->om
            ->getRepository('AppBundle:User')
            ->findOneBy(array('uniqueKey' => $uniqueKey))
        ;

        if (null === $user) {
            throw new TransformationFailedException(sprintf(
                'L\'utilisateur portant la clef "%s" ne peut pas être trouvé !', $uniqueKey
            ));
        }

        return $user;
    }

    /**
     * Transforme un utilisateur en uniqueKey
     * 
     * @param type $user
     * @return string
     */
    public function transform($user)
    {
        if (null === $user) {
            return "";
        }

        return $user->getUniqueKey();
    }

}
