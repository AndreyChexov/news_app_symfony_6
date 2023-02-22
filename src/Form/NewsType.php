<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('news_name')
            ->add('news_text', TextareaType::class)
            ->add('news_author', HiddenType::class)
            ->add('news_date', HiddenType::class)
            ->add('news_img', FileType::class)
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'animals' => 'animals',
                    'cars' => 'cars',
                    'cities' => 'cities'
                ]
            ]);

        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
