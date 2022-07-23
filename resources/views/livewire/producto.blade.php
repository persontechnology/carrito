<div class="card">
    <div class="card-header header-elements-sm-inline">
        <div class="form-group col-md-3">
            <input type="search" wire:model="codigo" class="form-control" id="inputZip" placeholder="Buscar por código...">
        </div>
        <!-- Default checked -->
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="defaultChecked2" wire:model="todo">
            <label class="custom-control-label" for="defaultChecked2">Descargar todo</label>
        </div>
        <button class="btn btn-link" wire:click="pdf" wire:loading.attr="disabled">
            Descargar PDF <i class="fas fa-file-pdf ml-1"></i>
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cuenta contable</th>
                    <th>Cuanta contable salida</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Talla</th>
                    <th>Cantidad</th>
                    <th>Precio compra</th>
                    <th>Precio venta</th>
                    <th>Incluye iva</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $pro)
                <tr>
                    <td>{{ $pro->categoria->nombre??'' }}</td>
                    <td>{{ $pro->categoria_dos->nombre??'' }}</td>
                    <td>{{ $pro->codigo }}</td>
                    <td>{{ $pro->nombre }}</td>
                    <td>{{ $pro->talla }}</td>
                    <td>{{ $pro->cantidad }}</td>
                    <td>{{ $pro->precio_compra }}</td>
                    <td>{{ $pro->precio_venta }}</td>
                    <td>{{ isset($pro->incluye_iva)?'Si':'No' }}</td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">
        @if ($todo==false)
            {{ $productos->links() }}    
        @endif
        
    </div>
</div>