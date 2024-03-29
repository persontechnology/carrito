<?php

namespace App\DataTables\Ventas;

use App\Models\Producto;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductosDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
          
           
            ->editColumn('foto',function($pro){
                return view('almacen.productos.foto',['pro'=>$pro])->render();
            })
            ->editColumn('incluye_iva',function($pro){
                return isset($pro->incluye_iva)?'Si':'No';
            })
            ->addColumn('action', function($pro){
                return view('ventas.facturas.selecionarProducto',['pro'=>$pro])->render();
            })
            ->editColumn('categoria_id',function($pro){
                return $pro->categoria->nombre??'';
            })
            ->editColumn('categoria_dos_id',function($pro){
                return $pro->categoria_dos->nombre??'';
            })
            ->editColumn('created_at',function($pro){
                return $pro->created_at;
            })
            ->editColumn('updated_at',function($pro){
                return $pro->updated_at;
            })
            
            ->rawColumns(['action','foto']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Ventas/Producto $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Producto $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ventas-productos-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1)
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->searchable(false)
                  ->title('Opciones')
                  ->addClass('text-center'),
            // Column::make('foto')->searchable(false),
            Column::make('categoria_id')->searchable(false)->title('Cuenta contable'),
            Column::make('categoria_dos_id')->searchable(false)->title('Cuenta contable salida'),
            Column::make('codigo')->title('Código'),
            Column::make('nombre'),
            Column::make('talla')->title('Unidad medida'),
            Column::make('cantidad'),
            Column::make('precio_compra'),
            Column::make('precio_venta'),
            // Column::make('color'),
            // Column::make('cuenta_contable'),
            // Column::make('cuenta_salida'),
            Column::make('incluye_iva'),
            // Column::make('descripcion')->title('Descripción')->searchable(false),
            // Column::make('created_at')->title('Creado'),
            // Column::make('updated_at')->title('Actualizado'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ventas_Productos_' . date('YmdHis');
    }
}
