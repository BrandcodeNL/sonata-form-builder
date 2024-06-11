<?php

namespace Pirastru\FormBuilderBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\Form\Validator\ErrorElement;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormBuilderAdmin extends AbstractAdmin
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('recipient')
            ->add('name')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('name', null, [
                'route' => [
                    'name' => 'edit',
                ],
            ])
            ->add('recipient')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('json', HiddenType::class)
            ->add('name', TextType::class)
            ->add('subject', TextType::class, [
                'help' => "You can use &lt;Internal Key&gt; to add variables to your subject. Example: This email is from &lt;Name&gt;"
            ])
            ->add('reply_to', TextType::class ,[
                'help' => "You can use &lt;Internal Key&gt; to add variables to your reply to field. Example: &lt;Email&gt;",
                'required' => false,
            ])
            ->add('recipient', CollectionType::class, array(
                    'entry_type' => EmailType::class,
                    'label' => 'Recipient(s)',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'entry_options' => array(
                        'label' => 'Email',
                        'required' => false,
                    ),
                )
            )
            ->add('recipientCC', CollectionType::class, array(
                    'entry_type' => EmailType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'entry_options' => array(
                        'label' => 'Email',
                        'required' => false,
                    ),
                )
            )
            ->add('recipientBCC', CollectionType::class, array(
                    'entry_type' => EmailType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'entry_options' => array(
                        'label' => 'Email',
                        'required' => false,
                    ),
                )
            )
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name')
            ->add('recipient')
            ->add('submit', null, array('template' => '@PirastruFormBuilder/CRUD/table_show_field.html.twig'))
        ;
    }

    /**
     * @param ErrorElement $errorElement
     * @param mixed $object
     */
    public function validate(ErrorElement $errorElement, $object): void
    {
        $errorElement
            ->with('name')
            ->assertNotBlank()
            ->end()
            ->with('subject')
            ->assertNotBlank()
            ->end()
        ;
    }
}
