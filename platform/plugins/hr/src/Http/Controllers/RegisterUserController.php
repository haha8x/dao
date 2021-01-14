<?php

namespace Botble\Hr\Http\Controllers;

use Botble\ACL\Http\Controllers\UserController;
use Botble\ACL\Http\Requests\CreateUserRequest;
use Botble\ACL\Services\CreateUserService;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Hr\Forms\RegisterUserForm;

class RegisterUserController extends UserController
{
    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle('Đăng ký tài khoản');

        return $formBuilder->create(RegisterUserForm::class)->renderForm();
    }

    /**
     * @param CreateUserRequest $request
     * @param CreateUserService $service
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(CreateUserRequest $request, CreateUserService $service, BaseHttpResponse $response)
    {
        $user = $service->execute($request);

        event(new CreatedContentEvent(USER_MODULE_SCREEN_NAME, $request, $user));

        return $response
            ->setMessage('Đăng ký tài khoản thành công');
    }
}
