<?php
namespace App\Http\Controllers\Auth;
use App\Models\Client;
use App\Models\User;
use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, ClientRepository $clientRepository)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $data['user']['password'] = bcrypt($data['password']);
        $data['user']['name'] = $data['name'];
        $data['user']['email'] = $data['email'];
        $user = $this->userRepository->create($data['user']);
        $data['user_id'] = $user->id;
        $this->clientRepository->create($data);
        return $user;
    }
}