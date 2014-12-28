<?php

namespace Mefi\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $category_id;

    /**
     * @var boolean
     */
    private $is_visible;

    /**
     * @var string
     */
    private $created_by;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $lead;

    /**
     * @var string
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="Post")
     *
     * @var \Mefi\BlogBundle\Entity\Category
     */
    private $category;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category_id
     *
     * @param integer $categoryId
     * @return Post
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set is_visible
     *
     * @param boolean $isVisible
     * @return Post
     */
    public function setIsVisible($isVisible)
    {
        $this->is_visible = $isVisible;

        return $this;
    }

    /**
     * Get is_visible
     *
     * @return boolean
     */
    public function getIsVisible()
    {
        return $this->is_visible;
    }

    /**
     * Set created_by
     *
     * @param string $createdBy
     * @return Post
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;

        return $this;
    }

    /**
     * Get created_by
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set lead
     *
     * @param string $lead
     * @return Post
     */
    public function setLead($lead)
    {
        $this->lead = $lead;

        return $this;
    }

    /**
     * Get lead
     *
     * @return string
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Post
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param \Mefi\BlogBundle\Entity\Category $category
     * @return Post
     */
    public function setCategory(\Mefi\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Mefi\BlogBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
    }
    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var string
     */
    private $slug;


    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * @var \DateTime
     */
    private $visible_at;


    /**
     * Set visible_at
     *
     * @param \DateTime $visibleAt
     * @return Post
     */
    public function setVisibleAt($visibleAt)
    {
        $this->visible_at = $visibleAt;

        return $this;
    }

    /**
     * Get visible_at
     *
     * @return \DateTime
     */
    public function getVisibleAt()
    {
        return $this->visible_at;
    }
    /**
     * @var boolean
     */
    private $is_open;


    /**
     * Set is_open
     *
     * @param boolean $isOpen
     * @return Post
     */
    public function setIsOpen($isOpen)
    {
        $this->is_open = $isOpen;

        return $this;
    }

    /**
     * Get is_open
     *
     * @return boolean
     */
    public function getIsOpen()
    {
        return $this->is_open;
    }
    /**
     * @var \DateTime
     */
    private $published_at;


    /**
     * Set published_at
     *
     * @param \DateTime $publishedAt
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->published_at = $publishedAt;

        return $this;
    }

    /**
     * Get published_at
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }
}
