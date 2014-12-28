<?php
namespace Mefi\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class PostAdmin
 *
 * @package Mefi\BlogBundle\Admin
 */
class PostAdmin extends Admin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
    );

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
                ->add('category', null, array('label' => 'Téma', 'required' => true))
                ->add('lead', 'textarea', array('label' => 'Előszó', 'attr' => array('rows' => 15)))
                ->add('description', 'textarea', array('label' => 'Tartalom'))
            ->end()
            ->with('Aknakereső')
                ->add('is_visible', 'checkbox', array('label' => 'Publikus?'))
                ->add('is_open', 'checkbox', array('label' => 'Kommentálható?'))
            ->end()
            ->with('Extrák')
                ->add('created_by', 'text', array('label' => 'Szerző', 'data' => 'Mefi'))
                ->add('published_at', 'datetime', array('label' => 'Megjelenés ideje', 'data' => new \DateTime()))
                ->add('slug', 'text', array('label' => 'Slug (barátságos URL)'))
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
            ->add('category')
            ->add('published_at')
            ->add('is_visible')
            ->add('is_open')
            ->add('lead')
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
            ->add('category', null, array('label' => 'Téma'))
            ->add('published_at', 'datetime', array('label' => 'Megjelenik'))
            ->add('is_visible', 'boolean', array('label' => 'Publikus'))
            ->add('is_open', 'boolean', array('label' => 'Kommentálható'))
        ;
    }
}