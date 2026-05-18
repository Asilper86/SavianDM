<?php

namespace App\Livewire\Forms\Empresas;

use App\Models\Empresa;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateEmpresasForm extends Form
{
    #[Validate(['required', 'string', 'min:4', 'max:200'])]
    public string $nombre = '';
    #[Validate(['numeric', 'min:0'])]
    public ?float $hectarea = 0.0;

    public ?Empresa $empresa = null;

    public array $centros_trabajo = [];

    public function setEmpresa(Empresa $empresa){
        $this->empresa=$empresa;
        $this->nombre=$empresa->nombre;
        $this->hectarea=$empresa->hectarea;
        
        $this->centros_trabajo = $empresa->centrosTrabajo->map(function($centro) {
            return ['id' => $centro->id, 'nombre' => $centro->nombre];
        })->toArray();

        if (empty($this->centros_trabajo)) {
            $this->centros_trabajo[] = ['id' => null, 'nombre' => ''];
        }
    }

    public function editarForm(){
        $this->validate();
        
        $this->empresa->update([
            'nombre' => $this->nombre,
            'hectarea' => $this->hectarea,
        ]);

        $idsToKeep = [];
        foreach($this->centros_trabajo as $centro) {
            if(!empty(trim($centro['nombre']))) {
                if (!empty($centro['id'])) {
                    $centroModel = $this->empresa->centrosTrabajo()->find($centro['id']);
                    if ($centroModel) {
                        $centroModel->update(['nombre' => trim($centro['nombre'])]);
                        $idsToKeep[] = $centroModel->id;
                    }
                } else {
                    $newCentro = $this->empresa->centrosTrabajo()->create(['nombre' => trim($centro['nombre'])]);
                    $idsToKeep[] = $newCentro->id;
                }
            }
        }
        
        $this->empresa->centrosTrabajo()->whereNotIn('id', $idsToKeep)->delete();
    }

    public function cancelarForm(){
        $this->reset('nombre', 'hectarea', 'centros_trabajo');
        $this->centros_trabajo = [];
        $this->resetValidation();
    }
}
