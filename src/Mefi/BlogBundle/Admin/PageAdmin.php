<?php
namespace Mefi\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class PageAdmin
 *
 * @package Mefi\BlogBundle\Admin
 */
class PageAdmin extends Admin
{
    /**
     * Configures created and edit form fields.
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Legfontosabb')
                ->add('title', 'text', array('label' => 'Cím'))
                ->add('description', 'textarea', array('label' => 'Tartalom'))
            ->end()
            ->with('Aknakereső')
                ->add('is_visible', 'checkbox', array('label' => 'Publikus?'))
            ->end()
            ->with('Extrák')
                ->add('created_by', 'text', array('label' => 'Szerző', 'data' => 'Mefi'))
                ->add('slug', 'text', array('label' => 'Slug (barátságos URL)', 'required' => false))
            ->end()
        ;
    }

    /**
     * Configures filters.
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('is_visible')
            ->add('description')
            ->add('created_by')
        ;
    }

    /**
     * Configures list view fields.
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', 'int', array('label' => 'ID'))
            ->addIdentifier('title', 'string', array('label' => 'Cím'))
            ->add('slug', 'string', array('label' => 'Slug'))
            ->add('created_by', 'string', array('label' => 'Szerző'))
            ->add('is_visible', 'boolean', array('label' => 'Publikus'))
        ;
    }
}