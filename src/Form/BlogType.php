<?php

namespace App\Form;


use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Blog;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use kcfinder\text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogType extends AbstractType {

    public function  buildForm(FormBuilderInterface $builder, array $options)
    {




        $builder->add('translations', TranslationsType::class, array(
        'fields' => array(
            'title' => array('field_type' => TextType::class, 'attr' => array('class' => 'form-control middle'),'label' => 'Title:'),
            'slug' => array('field_type' => TextType::class, 'attr' => array('class' => 'form-control middle'),'label' => 'Slug:', 'required' => false),
            'description' => array('field_type' => TextareaType::class, 'label' => 'Съдържание:', 'required' => false),
            'tagsText' => array('field_type' => TextType::class,  array('label' => 'Тагове:', 'label_attr'=>array('class'=>'bold col-form-label tag-class'))),

        )));
//        $builder
//            ->add('tagsText', TextType::class, ['required' => false, 'label' => 'Tags'])
//        ;

        $builder->add('imageFile', VichImageType::class, array(
            'required' => false,
            'imagine_pattern' => 'my_thumb_horizontal',
            'allow_delete' => false,
            'download_uri' => false,
            'label' => 'Image:',
            'label_attr'=> array('class' => 'bold '),
            'help' => 'Recommended size: 770 x 470 px',
            'attr' => array('class'=> 'edit-no-validate')
        ));

    }




    public function  configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                'data_class' => Blog::class,
         ]);
    }
}
