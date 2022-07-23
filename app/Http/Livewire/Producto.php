<?php

namespace App\Http\Livewire;

use App\Models\Producto as ModelsProducto;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use PDF;

class Producto extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // para filtros
    
    public $codigo;
    public $mostrar='10';
    public $todo=false;
    // querys
    protected $queryString = [
        'codigo' => ['except' => ''],
        'mostrar'=>['except'=>'10']
    ];

    public function render()
    {
        $data = array('productos' =>$this->listado() );
        return view('livewire.producto',$data);
    }

    public function listado()
    {
        

        if($this->todo==true){
            $productos=ModelsProducto::where(function($query) {
                if($this->codigo){
                    $query->where('codigo','like','%'.$this->codigo.'%');
                }
            })->latest()->get();
        }else{
            $productos=ModelsProducto::where(function($query) {
                if($this->codigo){
                    $query->where('codigo','like','%'.$this->codigo.'%');
                }
            })->latest()->paginate($this->mostrar);
        }
        return $productos;
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function updatedMostrar($value)
    {
        $this->mostrar=$value;
    }

    public function updatedTodo($value)
    {
        $this->todo=$value;
    }

    public function pdf()
    {
        $options = [
            'orientation'   => 'portrait',
            'header-html'   => view()->make('pdf.header')->render(),
            'footer-html'   => view()->make('pdf.footer')->render()
          ];
        
        $data = array('productos' => $this->listado() );
        $pdf = PDF::loadView('livewire.pdfProducto', $data)->setOptions($options)->output();
       
        return response()->streamDownload(
            fn () => print($pdf),
            "Pdf".Carbon::now().".pdf"
       );

    }
}
