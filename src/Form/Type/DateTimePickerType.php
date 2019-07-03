<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class DateTimePickerType extends AbstractType
{
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'widget' => 'single_text',
				'format' => 'dd/MM/yyyy HH:mm',
				'attr' => array(
					'class'=>'datetimepicker',
				)
			)
		);
	}

	public function getParent()
	{
		return DateTimeType::class;
	}
}