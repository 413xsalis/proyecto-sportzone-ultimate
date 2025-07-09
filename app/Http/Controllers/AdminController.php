<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Asegúrate de importar el modelo Product


class AdminController extends Controller
{

    public function index(){
        return view ('administrador.admin.principal');
    }

      public function principal()
    {
        return view('administrador.admin.principal');
    }

        public function formulario()
    {
        return view('administrador.Formulario_empleados.principal');
    }

        public function create()
    {
        return view('administrador.Gestion_usuarios.create');
    }








    
    /**
     * Muestra la gestión de usuarios con productos
     */
    public function gestion()
    {
        $Users = User::all(); // Obtener todos los productos
        return view('administrador.Gestion_usuarios.principal', compact('Users'));
    }





}
