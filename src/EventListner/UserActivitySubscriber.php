<?php


namespace App\EventListner;


use App\Entity\User;
use App\Entity\UserActivityLog;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;




class UserActivitySubscriber implements EventSubscriberInterface
{

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getSubscribedEvents() : array
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {

        $entityName = get_class($args->getObject());
        $entity = $args->getObject();
        if(!$entity instanceof User){
            return;
        }
        //dump($args->getObject());
        $this->logActivity('persist',$entity,$entityName);


    }


    private function logActivity($oparetion,$entity,$entityName){
        $activityLog = new UserActivityLog();
        $activityLog->setOperation($oparetion);
        $activityLog->setCreatedAt(new \DateTimeImmutable('now'));
        $activityLog->setEntityName($entityName);
        $activityLog->setCreatedBy($entity);

        $this->entityManager->persist($activityLog);
        $this->entityManager->flush();
    }

}