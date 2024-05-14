<?php

namespace Pirastru\FormBuilderBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollectionInterface;


class SubmittedValueAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->clearExcept(array('show'));
    }
    
    protected function configureFormFields(FormMapper $formMapper): void
    {   
        $formMapper
            ->add('fieldKey')
            ->add('fieldValue')
        ;
    }


    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('fieldKey')
            ->add('fieldValue')
        ;
    }
}