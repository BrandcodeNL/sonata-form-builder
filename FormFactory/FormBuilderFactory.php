<?php
/**
 * Created by Andrea Pirastru
 * Date: 03/12/14
 * Time: 12:27.
 */

namespace Pirastru\FormBuilderBundle\FormFactory;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FormBuilderFactory
{
    /**
     * Email Field.
     */
    public function setFieldEmailinput($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, EmailType::class, array(
            'required' => $elem->fields->required->value,
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'help' => $elem->fields->helptext->value,
            'attr' => array_filter($attr),
            'constraints' => array(
                new Email(),
            ),
        ));

        return array('name' =>$key, 'size' => $this->getSelectedValue($elem->fields->inputwidth->value));
    }

    /**
     * Date Field.
     */
    public function setFieldDateinput($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => 'datepicker ' . (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, DateType::class, array(
            'required' => $elem->fields->required->value,
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'help' => $elem->fields->helptext->value,
            'attr' => array_filter($attr),
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy'
        ));

        return array('name' => $key, 'size' => $this->getSelectedValue($elem->fields->inputwidth->value));
    }

    /**
     * Telephone Field.
     */
    public function setFieldTelephoneinput($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, NumberType::class, array(
            'required' => $elem->fields->required->value,
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'help' => $elem->fields->helptext->value,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => $this->getSelectedValue($elem->fields->inputwidth->value));
    }

    /**
     * Postalcode Field.
     */
    public function setFieldPostalcodeinput($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, NumberType::class, array(
            'required' => $elem->fields->required->value,
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'help' => $elem->fields->helptext->value,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => $this->getSelectedValue($elem->fields->inputwidth->value));
    }

    /**
     * Text Field.
     */
    public function setFieldTextinput($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, TextType::class, array(
            'required' => $elem->fields->required->value,
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'help' => $elem->fields->helptext->value,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => $this->getSelectedValue($elem->fields->inputwidth->value));
    }

    /**
     * Textarea Field.
     */
    public function setFieldTextarea($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, TextareaType::class, array(
            'required' => false,
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'help' => $elem->fields->helptext->value,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => $this->getSelectedValue($elem->fields->inputwidth->value));
    }

    /**
     * Select basic Field.
     */
    public function setFieldSelectbasic($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, ChoiceType::class, array(
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'choices' => $this->getChoices($elem->fields->options->value),
            'required' => false,
            'placeholder' => false,
            //'empty_value' => false,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => $this->getSelectedValue($elem->fields->inputsize->value));
    }

    /**
     * Select multiple Field.
     */
    public function setFieldSelectmultiple($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, ChoiceType::class, array(
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'choices' => $this->getChoices($elem->fields->options->value),
            'multiple' => true,
            'required' => false,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => $this->getSelectedValue($elem->fields->inputsize->value));
    }

    /**
     * Multiple Radio Field.
     */
    public function setFieldMultipleradios($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );
        $formBuilder->add($key, ChoiceType::class, array(
            'label' => $elem->fields->label->value,
            'label_attr' => [''],
            'choices' => $this->getChoices($elem->fields->radios->value),
            'multiple' => false,
            //'empty_value' => false,
            'required' => true,
            'expanded' => true,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => 'col-sm-6');
    }

    /**
     * Multiple Checkbox Field.
     */
    public function setFieldMultiplecheckboxes($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
            'type' => 'multipleCheck',
        );
        $formBuilder->add($key, ChoiceType::class, array(
            'label' => $elem->fields->label->value,
            'label_attr' => [''],
            'choices' => $this->getChoices($elem->fields->checkboxes->value),
            'multiple' => true,
            'expanded' => true,
            'required' => false,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => 'col-sm-6');
    }

    /**
     * Multiple Checkbox Inline Field.
     */
    public function setFieldMultiplecheckboxesInline($formBuilder, $key, $elem)
    {
        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
            'type' => 'multipleCheckInline',
        );
        $formBuilder->add($key, ChoiceType::class, array(
            'label' => $elem->fields->label->value,
            'label_attr' => array('class' => 'indent'),
            'choices' => $this->getChoices($elem->fields->checkboxes->value),
            'multiple' => true,
            'expanded' => true,
            'required' => false,
            'attr' => array_filter($attr),
        ));

        return array('name' => $key, 'size' => 'col-sm-6');
    }

    public function setFieldPrivacycheckbox($formBuilder, $key, $elem)
    {
        $label = sprintf("%s <a href='%s'>%s</a>",
            $elem->fields->text->value,
            $elem->fields->url->value,
            $elem->fields->cta->value
        );

        $attr = array(
            'placeholder' => (isset($elem->fields->placeholder) ? $elem->fields->placeholder->value : ""),
            'class' => (isset($elem->fields->class) ? $elem->fields->placeholder->value : ""),
        );

        $formBuilder->add($key, CheckboxType::class, [
            'label' => $label,
            'required' => true,
            'constraints' => array(
                new EqualTo(['value' => 1])
            ),
            'attr' => array_filter($attr),
        ]);

        return array('name' => $key, 'size' => 'col-sm-6');
    }

    /**
     * Return the selected element on a list.
     */
    private function getSelectedValue($select)
    {
        foreach ($select as $elem) {
            if ($elem->selected) {
                return $elem->value;
            }
        }

        return false;
    }

    public function setFieldSinglebutton($formBuilder, $key, $elem)
    {
        $action = $this->getSelectedValue($elem->fields->buttonaction->value);
        $this->createButton($formBuilder, $action, $key, $elem->fields->buttonlabel->value, $elem->fields->class->value);

        return array('name' => $key, 'size' => 'col-sm-6');
    }

    public function setFieldDoublebutton($formBuilder, $key, $elem)
    {
        $action = $this->getSelectedValue($elem->fields->button1action->value);
        $this->createButton($formBuilder, $action, '1_'.$key, $elem->fields->button1label->value);

        $action = $this->getSelectedValue($elem->fields->button2action->value);
        $this->createButton($formBuilder, $action, '2_'.$key, $elem->fields->button2label->value);

        return array(
            'name' => 'button_'.$key, 'size' => 'col-sm-6',
        );
    }

    private function createButton($formBuilder, $action, $key, $value, $class="")
    {
        $buttonType = $this->getButtonType($action);

        $formBuilder->add('button_'.$key, $buttonType, array(
            'label' => $value,
            'attr' => array(
                'class' => $class,
            ),
        ));
    }

    private function getButtonType($action)
    {
        switch ($action) {
            case 'submit':
                return SubmitType::class;
            case 'reset':
                return ResetType::class;
            default:
                return ButtonType::class;
        }
    }

    public function setFieldCaptcha($formBuilder, $key, $elem)
    {
        $formBuilder->add('captcha_'.$key, CaptchaType::class, array(
            'width' => 200,
            'height' => 50,
            'length' => 6,
            'label_attr' => [
                'style' => 'display:none;',
            ],
            'help' => $elem->fields->helptext->value,
        ));

        return array('name' => 'captcha_'.$key, 'size' => 'col-sm-6');
    }

    private function getChoices($choices) {
        $fixedChoices = array();
        foreach ($choices as $choice) {
            $fixedChoices[$choice] = $choice;
        }
        return $fixedChoices;
    }
}
