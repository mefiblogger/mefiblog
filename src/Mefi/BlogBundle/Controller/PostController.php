<?php

namespace Mefi\BlogBundle\Controller;

use Doctrine\ORM\NoResultException;
use Mefi\BlogBundle\Helper\HungarianHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    const TEMPLATE_PREFIX = 'MefiBlogBundle:Default:';

    /**
     * Returns the PostRepository.
     *
     * @return \Mefi\BlogBundle\Entity\PostRepository
     */
    protected function getRepository()
    {
        return $this->getDoctrine()->getRepository('MefiBlogBundle:Post');
    }

    /**
     * Shortcut for templates.
     *
     * @param string $template
     * @param string $namespace
     *
     * @return string MefiblogBundle:$namespace$template.html.twig
     */
    protected function getTemplate($template, $namespace = 'Post')
    {
        return 'MefiBlogBundle:' . $namespace . ':' . $template . '.html.twig';
    }

    /**
     * Listing the last 25 posts.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function startpageAction()
    {
        $posts = $this->getRepository()->findAllVisibleAndPublshed();

        return $this->render($this->getTemplate('startpage', 'Default'), array('posts' => $posts));
    }

    /**
     * Listing a post with the given id.
     *
     * @param int $id
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAction($id)
    {
        $id = intval($id);

        try {
            $post = $this->getRepository()->findOneVisibleAndPublshedById($id);

            return $this->render($this->getTemplate('post'), array('post' => $post));
        }
        catch (NoResultException $e) {
            throw $this->createNotFoundException('A keresett bejegyzés nem található.');
        }
    }

    /**
     * Listing the last 25 posts in the given category.
     *
     * @param int $categoryId
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction($categoryId)
    {
        $categoryId = intval($categoryId);

        $category = $this->getDoctrine()->getRepository('MefiBlogBundle:Category')->findOneBy(array(
            'id' => $categoryId
        ));

        if ($category) {
            $posts = $this->getRepository()->findAllVisibleAndPublshedByCategory($categoryId);

            return $this->render($this->getTemplate('category'), array('posts' => $posts, 'category' => $category));
        }

        throw $this->createNotFoundException('A keresett téma nem található.');
    }

    /**
     * Listing all posts in the given year and month.
     *
     * @param int $date Year and month in Ym format (201001)
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function archiveAction($date)
    {
        if (6 == strlen($date)) {
            $year = intval(substr($date, 0, 4));
            $month = intval(substr($date, 4, 2));

            $posts = $this->getRepository()->findAllVisibleAndPublshedByYearAndMonth($year, $month);

            if ($posts) {
                return $this->render($this->getTemplate('archive'), array('posts' => $posts));
            }
        }

        throw $this->createNotFoundException('A megadott időben nem voltak bejegyzések.');
    }
}
