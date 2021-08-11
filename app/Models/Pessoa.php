<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;
    // public $nome;
	// public $cpf;
	// public $telefones=array();
    public function cria($nome,$cpf,$telefones){
        $this->nome=$nome;
		$this->cpf=$cpf;
		$this->telefones=$telefones;
    }

    public function getNome(){
		return $this->nome;
	}
	public function getCPF(){
		return $this->cpf;
	}
	public function getTelefones(){
		return $this->telefones;
	}
}
