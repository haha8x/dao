<?php

namespace Botble\ACL\Forms;

use Botble\ACL\Http\Requests\UpdateProfileRequest;
use Botble\ACL\Models\User;
use Botble\Base\Forms\FormAbstract;

class ProfileForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new User)
            ->setFormOption('template', 'core/base::forms.form-no-wrap')
            ->setFormOption('id', 'profile-form')
            ->setFormOption('class', 'row')
            ->setValidatorClass(UpdateProfileRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => 'Name',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 30,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('email', 'text', [
                'label'      => trans('core/acl::users.email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/acl::users.email_placeholder'),
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->setActionButtons(view('core/acl::users.profile.actions')->render());
    }
}
