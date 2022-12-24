<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    // consulta de todos os produtos
    public function index(){
        $produtos = Produto::all();

        if(!empty($produtos)){
            return response()->json($produtos, 200);
        }else{
            return response()->json(["message" => "Nenhum produto encontrado!", "status" => 0], 202);
        }
    }

    // cadastro de produtos
    public function store(Request $request){

        try{
            $produtos = $request->products;
            
            foreach($produtos as $prod){
                $tags = implode(",", $prod["tags"]);
                Produto::create(["id" => $prod["id"], "nome" => $prod["name"], "tags" => $tags]);
            }
    
            return response()->json(["message" => "Todos os registro foram inseridos corretamente!", "status" => 1], 201);
        }catch(Exception $ex){
            return response()->json(["message" => "Algum erro ocorreu, contate o suporte!", "status" => 0], 501);
        }
    }

    // retorna um produto de acordo com o ID informado
    public function show(Produto $id){
        return Produto::find($id);
    } 
    
    // retorna um unico produto de acordo com o id passado
    public function searchId(Produto $id){
        return response()->json(Produto::find($id), 200);
    }

    // retorna os produtos que possuem o nome passado por GET
    public function searchName($name){
        return response()->json(Produto::where("nome", "like", "%{$name}%")->get(), 200);
    }

    public function searchTag($tags){
        return response()->json(Produto::where("tags", "like", "%{$tags}%")->get(), 200);

    }
}
