<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Telefone;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){

      $usuario=session('dados');
      //  dd($usuario);
         return view('welcome',['usuario'=>$usuario]);
    }

    public function arquivo(Pessoa $pessoa){
      $arquivoaberto = fopen('Projeto.txt',"a");// a é somente pra escrita; cria txt Projeto
			$celulares = implode(",", $pessoa->getTelefones()); // array pra string
			fwrite($arquivoaberto, $pessoa->getNome() . "->" . $pessoa->getCPF() . "->" . $celulares. "\n"); // escrevo no arquivo
			fclose($arquivoaberto);
    }

    public function store(Request $request) {

        
        

        
        $telefones=array();
          if(!empty($request->t1)){
            $telefone = new Telefone;

            $telefone->telefone = $request->t1;
            $telefone->descricao = $request->d1;
        
            $telefones[]="$telefone->telefone-$telefone->descricao";
          } 
          if(!empty($request->t2)){
            $telefone = new Telefone;
            $telefone->telefone = $request->t2;
            $telefone->descricao = $request->d2;
            
            $telefones[]="$telefone->telefone-$telefone->descricao";
          }
          if(!empty($request->t3)){
            $telefone = new Telefone;
            $telefone->telefone = $request->t3;
            $telefone->descricao = $request->d3;

            $telefones[]="$telefone->telefone-$telefone->descricao";
          }  
          if(!empty($request->t4)){
            $telefone = new Telefone;
            $telefone->telefone = $request->t4;
            $telefone->descricao = $request->d4;
            
           $telefones[]="$telefone->telefone-$telefone->descricao";
          } 
          if(!empty($request->t5)){
            $telefone = new Telefone;
            
            $telefone->telefone = $request->t5;
            $telefone->descricao = $request->d5;
        
            $telefones[]="$telefone->telefone-$telefone->descricao";
          } 
          // $pessoa=array();
          // $pessoa[]=$request->nome;
          // $pessoa[]=$request->cpf;
          // $pessoa[]=$telefones;
           $pessoa = new Pessoa();
          $pessoa->cria($request->nome,$request->cpf,$telefones);
         
         // return redirect()->action([PessoaController::class,'__construct'], [$pessoa->nome,$pessoa->cpf,$telefones]);
         // return redirect()->route('/lerArquivo', [$pessoa->nome,$pessoa->cpf,$telefones]);
         //return route('lerArquivo',[$pessoa]);
        return redirect('escreverArquivo')->with('pessoa',$pessoa);

    }
}
