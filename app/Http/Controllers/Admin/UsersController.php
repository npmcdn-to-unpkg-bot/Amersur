<?php namespace Amersur\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Amersur\Http\Controllers\Controller;

use Amersur\Entities\User;
use Amersur\Entities\UserProfile;
use Amersur\Repositories\UserRepo;
use Amersur\Repositories\UserProfileRepo;

class UsersController extends Controller {

    protected $rulesUser = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        'type' => 'required|in:admin,editor'
    ];

    protected $rulesProfile = [
        'nombre' => 'required',
        'apellidos' => 'required'
    ];

    protected $userRepo;
    protected $userProfileRepo;

    public function __construct(UserRepo $userRepo, 
                                UserProfileRepo $userProfileRepo)
    {
        $this->userRepo = $userRepo;
        $this->userProfileRepo = $userProfileRepo;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $users = $this->userRepo->findUsersAndPaginate();

        return view('admin.users.list', compact('users'));
	}

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $dataProfile = $request->only('nombre', 'apellidos');
        $dataUser = $request->only('email', 'password', 'type');

        $this->validate($request, $this->rulesProfile);
        $this->validate($request, $this->rulesUser);

        $user = new User($dataUser);
        $user->active = 1;
        $user->save();

        $emailUser = User::whereEmail($request->input('email'))->first();
        $actCodigo = $this->userRepo->CodigoAleatorio(50,true, true, false);

        $userProfile = new UserProfile($dataProfile);
        $userProfile->user_id = $emailUser->id;
        $userProfile->activacion_codigo = $actCodigo;
        $userProfile->save();

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.user.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = $this->userRepo->findOrFail($id);

        return view('admin.users.show', compact('user'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = $this->userRepo->findOrFail($id);

        return view('admin.users.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
    {
        $user = UserProfile::whereUserId($id)->first();

        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required'
        ];

        $this->validate($request, $rules);

        $user->fill($request->all());
        $user->save();

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.user.index');
    }

    /**
     * Funcion para cambiar contraseña de Perfil de usuario logeado
     */
    public function updatePassword($id, Request $request)
    {
        $user = User::findOrFail($id);

        $rules = [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        $this->validate($request, $rules);

        $user->fill($request->all());
        $user->save();

        //REDIRECCIONAR A PAGINA PARA VER DATOS
        return redirect()->route('admin.user.index');
    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


    /**
     * Funcion para mostar Perfil de usuario logeado
     */

    public function profile()
    {
        $user = Auth::user();

        return view('admin.users.profile', compact('user'));

    }

    /**
     * Funcion para cambiar datos de Perfil de usuario logeado
     */
    public function profileData()
    {
        $user = Auth::user();

        $profile = UserProfile::whereUserId($user->id)->first();

        $data = Input::all();

        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes())
        {
            $profile->fill($data);
            $profile->save();

            //REDIRECCIONAR A PAGINA PARA VER DATOS
            return redirect()->route('admin.user.profile');
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }
    }

    /**
     * Funcion para cambiar contraseña de Perfil de usuario logeado
     */

    public function profileChangePassword()
    {
        $user = Auth::user();

        $data = Input::all();

        $rules = [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes())
        {
            $user->fill($data);
            $user->save();

            //REDIRECCIONAR A PAGINA PARA VER DATOS
            return redirect()->route('admin.user.profile');
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }
    }


}
