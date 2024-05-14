<?php

namespace Pirastru\FormBuilderBundle\Admin;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Sonata\Form\Type\DateTimePickerType;

class SubmittedFormAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->clearExcept(array('show', 'edit'));
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
        ->add('createdAt', DateTimePickerType::class)
        ->add('submittedValues', CollectionType::class, array(
            'type_options' => array(
                // Prevents the "Delete" option from being displayed
                'delete' => false,
            )
        ), array(
            'edit' => 'inline',
            'inline' => 'table',
            'sortable' => 'position',
        ))
        ;
    }
}
