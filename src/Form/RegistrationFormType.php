<?php
/**
 * @author bricelab <bricehessou@gmail.com>
 * @version 0.1
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'form.field.register.email'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'form.field.register.firstname',
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'form.field.register.lastname',
                'required' => true,
            ])
            /* ->add('country', CountryType::class, [
                'label' => 'form.field.register.country',
                'required' => true,
            ])
            ->add('city', TextType::class, [
                'label' => 'form.field.register.city',
                'required' => false,
            ]) */
            ->add('birthday', DateType::class, [
                'label' => 'form.field.register.birthday',
                'widget' => 'single_text',
                'choice_translation_domain' => true,
                'required' => false,
            ])
            /* ->add('sexe', ChoiceType::class, [
                'label' => 'form.field.register.sexe',
                'expanded' => false,
                'multiple' => false,
                'choices' => [
                    //'form.field.register.sexe' => null,
                    'form.field.register.sexe.male' => ''.User::SEXE["MALE"],
                    'form.field.register.sexe.female' => User::SEXE["FEMALE"],
                ],
            ]) */
            /* ->add('agreeTerms', CheckboxType::class, [
                'label' => 'form.field.register.agreeterms',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms',
                    ]),
                ],
            ]) */
            ->add('plainPassword', PasswordType::class, [
                'label' => 'form.field.register.password',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'maxMessage' => 'Your password should not exceed {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
