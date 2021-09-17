<?php

namespace App\Http\Controllers;

use App\Components\Biblioteca;
use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UsuarioController extends Controller
{
    /**
     * Instância dos usuários
    */
    protected $usuarios;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Usuario $usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->usuarios->all();
        $model = [];
        $options = [
            'viewName' => '_grid',
        ];

        return view('usuarios.index', compact('model', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Usuario();
        $options = [
            'viewName' => '_form',
            'method' => Biblioteca::METHOD_POST,
            'route'  => route('usuario.store')
        ];

        return view('usuarios.index', compact('model', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        try
        {
            $model = new Usuario;
            $model->fill($request->all());

            /** Salvamos a imagem enviada */
            if($image = $request->file('image')) {
                $destinationPath = 'image/usuarios/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $model->des_path_image = "$profileImage";
            }

            $model->save();

            return redirect(route('usuario.index'))->with('success', trans('messages.saved'));

        } catch (Exception $ex)
        {
            if(env('AMBIENTE') === 'DSV')
            {
                return back()->with('error', $ex->getMessage());
            } else {
                return back()->with(trans('messages.create_failed'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idUsuario = Biblioteca::desencriptar($id);
        $model = $this->usuarios->findOrFail($idUsuario);

        $options = [
            'viewName' => '_visualizar',
            'method' => Biblioteca::METHOD_SHOW,
        ];

        return view('usuarios.index', compact('model', 'options'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idUsuario = Biblioteca::desencriptar($id);
        $model = $this->usuarios->findOrFail($idUsuario);

        $options = [
            'viewName' => '_form',
            'method' => Biblioteca::METHOD_UPDATE,
            'route'  => route('usuario.update', $model->id),
        ];

        return view('usuarios.index', compact('model', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $id)
    {
        try
        {
            $model = $this->usuarios->findOrFail($id);

            $data = $request->all();
            if(isset($data['password']))
            {
                $data['password'] = Hash::make($data['password']);
            } else {
                $data['password'] = $model->password;
            }

            /** Salvamos a imagem enviada */
            if ($image = $request->file('image')) {
                $destinationPath = 'image/usuarios/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $data['des_path_image'] = "$profileImage";
            } else {
                unset($data['des_path_image']);
            }

            $model->fill($data)->update();
            return redirect(route('usuario.index'))->with('success', trans('messages.edited'));

        } catch (Exception $ex)
        {
            if(env('AMBIENTE') === 'DSV')
            {
                return back()->with('error', $ex->getMessage());
            } else {
                return back()->with(trans('messages.update_failed'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $idUsuario = Biblioteca::desencriptar($id);
            $model = $this->usuarios->findOrFail($idUsuario);

            $model->delete();

            return response(['message' => trans('messages.deleted'), 'response' => 'ok']);

        } catch (Exception $ex) {
            return response(['message' => trans('messages.delete_failed')]);
        }
    }

    /**
     * Função para retornarmos os registros
     * utilizando datatable
     */
    public function ajaxDataTable()
    {
        $usuarios = $this->usuarios->select();
        $dataTable = DataTables::of($usuarios);

        // Colunas de ação
        $dataTable
        ->addColumn('action', function ($usuario) {
            $actionColumns = '<a href="'. route('usuario.show', ['usuario' => Crypt::encryptString($usuario->id)]) .'" class="m-r-5 button-view" title='. trans('labels.show') . ' data-toggle="tooltip" data-placement="top">
                            <i class="anticon anticon-eye"></i>
                            <span class="m-l-3">' . trans('labels.show') . '</span>
                        </a>';

            $actionColumns .= '<a href="'. route('usuario.edit', ['usuario' => Crypt::encryptString($usuario->id)]) .'" class="m-r-5 button-edit" title='. trans('labels.edit') . ' data-toggle="tooltip" data-placement="top">
                        <i class="anticon anticon-edit"></i>
                        <span class="m-l-3">' . trans('labels.edit') . '</span>
                    </a>';

            $actionColumns .= '<a class="delete-button button-delete" data-name="'. $usuario->des_nome . '" data-id="' . $usuario->id . '" data-method="DELETE" data-item="' . trans('labels.usuario') . '"
                        title="' . trans('labels.delete') . '" data-toggle="tooltip" data-placement="top" onclick="deleteRegister(this)"
                        href="#"
                        data-href="' . route('usuario.destroy', ['usuario' => Crypt::encryptString($usuario->id)]) . '">
                            <i class="anticon anticon-delete"></i>
                            <span class="m-l-3">' . trans('labels.delete') . '</span>
                </a>';

            return $actionColumns;
        });

        return $dataTable->rawColumns(['action'])->make(true);
    }
}
