<?php

namespace App\Services\Authentication;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
use App\Repositories\User\UserRepositoryImplement;
use App\Repositories\Authentication\AuthenticationRepository;

class AuthenticationServiceImplement extends Service implements AuthenticationService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  private $userRepository;

  public function __construct(AuthenticationRepository $mainRepository, UserRepositoryImplement $userRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->userRepository = $userRepository;
  }

  public function authenticateEmail($payload)
  {
    try {
      $account = $this->userRepository->findBy("email", $payload['email']);

      if ($account && Hash::check($payload['password'], $account->password)) {
        return $account;
      }

      throw new AuthenticationException();
    } catch (\Throwable $th) {
      throw new AuthenticationException();
    }
  }

  public function signUp($payload)
  {
    try {
      $account = $this->userRepository->create($payload);
      return $this->userRepository->find($account->id);
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
