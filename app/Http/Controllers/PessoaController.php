<?php

namespace App\Http\Controllers;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PessoaController extends Controller
{
    public function criaArquivo(){
        $pessoa=session('pessoa');
        $arquivoaberto = fopen('../storage/app/Projeto.txt',"a");// a é somente pra escrita; cria txt Projeto
       // dd($pessoa->getTelefones());
        $celulares = implode(",", $pessoa->getTelefones()); // array pra string
        //Storage::put('Projeto.txt',$pessoa->getNome() . "->" . $pessoa->getCPF() . "->" . $celulares. "\n");

        //Storage::append($arquivoaberto, $pessoa->getNome() . "->" . $pessoa->getCPF() . "->" . $celulares. "\n");
        fwrite($arquivoaberto, $pessoa->getNome() . "->" . $pessoa->getCPF() . "->" . $celulares. "\n"); // escrevo no arquivo
        fclose($arquivoaberto);
        return redirect('lerArquivo');

    }

    public function lerArquivo(){
        //$arquivoaberto=Storage::get('Projeto.txt');
        $arquivoaberto =fopen(storage_path('app/Projeto.txt'), "r");

        //dd($arquivoaberto);
        while(!feof($arquivoaberto)){
            //dd("entrei");
            $arq=fgets($arquivoaberto);
             //dd($arq);
            $novoarq = explode ("->", $arq);
            // for($i=0;$i<sizeof($novoarq);$i++){
            // print_r($novoarq[$i]." - ".$i." <br>");
            // }
         if(isset($novoarq[1])){
            $nome=$novoarq[0]; // primeiro indice do vetor é sempre nome
            $cpf=$novoarq[1]; // segundo é cpf

            
            $celnovo = explode(",", $novoarq[2]); // string dos telefones em vetores
            $usuarioNovo= new Pessoa();
            $usuarioNovo->cria($nome, $cpf, $celnovo);
            
            
            $usuario[]=$usuarioNovo->getAttributes();
        }
        }
         $dados=$usuario;
         //dd($usuario);
         return redirect('/')->with('dados',$dados);
               

    }
}
