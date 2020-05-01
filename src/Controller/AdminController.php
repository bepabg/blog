<?php

namespace App\Controller;


use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;


class AdminController extends AbstractController
{


    /**
     * @Route("/blog", name="blog_list")
     */
    public function blogAction()
    {

        $pages = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findBy(array(), array('id'=> 'DESC'));
        return $this->render('blog.html.twig', array('blog' => $pages));

    }

    /**
     * @Route("/blog/new", name="blog_new")
     */
    public function blognewAction(Request $request)
    {

        $pages = new Blog();
        $slugger = new AsciiSlugger();
        $form = $this->createForm('App\Form\BlogType', $pages);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $locales = $this->getParameter('locales');
            foreach ($locales as $locale) {
                if ($pages->translate($locale)->getSlug() != null) {
                    $newslug = $slugger->slug($pages->translate($locale)->getSlug(), '-', $locale)->lower();
                    $pages->translate($locale)->setSlug($newslug);
                } else {
                    $newslug = $slugger->slug($pages->translate($locale)->getTitle(), '-', $locale)->lower();
                    $pages->translate($locale)->setSlug($newslug);
                }
                $em->persist($pages);
                $em->flush();

                $this->addFlash('success', 'Added Successful!');
                return $this->redirectToRoute('blog_list');
            }
        }

        return $this->render('blognew.html.twig', array(
            'Page' => $pages,
            'new_form' => $form->createView()
        ));
    }

    /**
     * @Route("/blog/edit/{id}", name="blog_edit", methods={"GET", "POST"})
     */
    public function blogeditAction(Request $request, Blog $post)
    {
        $editForm = $this->createForm('App\Form\BlogType', $post);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Edited Successful!');
            return $this->redirectToRoute('blog_list');
        }

        return $this->render('blogedit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * @Route("/blog/delete/{id}", name="blog_delete", methods={"GET", "POST", "DELETE"})
     */
    public function blogdeleteAction(Blog $post)
    {
        if (!$post) {
            throw $this->createNotFoundException('Record not found');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        $this->addFlash('success', 'Deleted Successful!');
        return $this->redirectToRoute('blog_list');

    }


}
