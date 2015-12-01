<?php

namespace Ais\KontrakMahasiswaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class KontrakMahasiswaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matakuliah_id')
            ->add('mahasiswa_id')
            ->add('semester_id')
            ->add('kelas_id')
            ->add('nilai_tugas')
            ->add('nilai_uas')
            ->add('nilai_uts')
            ->add('nilai_huruf')
            ->add('nilai_angka')
            ->add('is_active')
            ->add('is_delete')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ais\KontrakMahasiswaBundle\Entity\KontrakMahasiswa',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
