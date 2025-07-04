<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('administrador.Gestion_usuarios.principal', compact('products'));
    }

    public function create()
    {
        return view('administrador.Gestion_usuarios.create');
    }

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric|min:0'
    ]);

        Product::create($request->all());

              return redirect()->back()->with('success', 'Libro creado con exito');

        // return redirect()->route('administrador.Gestion_usuarios.principal')
        //     ->with('success', 'Producto creado exitosamente.');
    }

    public function show(Product $product)
    {
        return view('administrador.Gestion_usuarios.show', compact('product'));
    }

 public function edit(Product $product)
    {
        return view('administrador.Gestion_usuarios.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);
        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}

