<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AdmissionApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Student Information
            ->add('student_name', TextType::class, [
                'label' => 'Student Name',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter student full name'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Student name is required']),
                ]
            ])
            ->add('grade', ChoiceType::class, [
                'label' => 'Grade Applying For',
                'choices' => [
                    'Nursery' => 'nursery',
                    'KG (Kindergarten)' => 'kg',
                    'Grade 1' => 'grade_1',
                    'Grade 2' => 'grade_2',
                    'Grade 3' => 'grade_3',
                    'Grade 4' => 'grade_4',
                    'Grade 5' => 'grade_5',
                    'Grade 6' => 'grade_6',
                    'Grade 7' => 'grade_7',
                    'Grade 8' => 'grade_8',
                    'Grade 9' => 'grade_9',
                    'Grade 10 (Coming Soon)' => 'grade_10',
                ],
                'attr' => ['class' => 'form-select'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please select a grade']),
                ]
            ])
            
            // Parent/Guardian Information
            ->add('parent_name', TextType::class, [
                'label' => 'Parent/Guardian Name',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter parent/guardian full name'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Parent/Guardian name is required']),
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'parent@example.com'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Email is required']),
                    new Assert\Email(['message' => 'Please enter a valid email address']),
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Phone Number',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '+92 XXX XXXXXXX'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Phone number is required']),
                ]
            ])
            
            // Additional Information
            ->add('previous_school', TextType::class, [
                'label' => 'Previous School (Optional)',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Name of previous school'
                ]
            ])
            ->add('comments', TextareaType::class, [
                'label' => 'Additional Comments (Optional)',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => 'Any additional information you\'d like to share...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}