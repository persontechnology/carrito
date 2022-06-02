<table class="table table-bordered">
    <thead >
        <tr>
            <td colspan="2">
                <strong>SEÑOR/A:</strong>
                <a href="{{ route('editarUsuario',$factura->cliente->id) }}" class="text-primary">
                    {{ Str::limit(($factura->cliente->apellidos??'').' '.($factura->cliente->nombres??''),110,'..') }}
                </a>
            </td>
            
            <td colspan="2"><strong>FECHA:</strong> {{ $factura->created_at->toDateString() }}</td>
            
        </tr>
        <tr>
            <td colspan="2"><strong>R.U.C:</strong> {{ Str::limit($factura->cliente->identificacion,110,'') }}</td>            
            <td colspan="2"><strong>TELÉFONO:</strong> {{ Str::limit($factura->cliente->telefono,15,'..') }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>DIRECCIÓN:</strong> {{ Str::limit($factura->cliente->direccion,110,'..') }}</td>
            <td colspan="2"><strong>VENDEDOR:</strong> {{ Str::limit(($factura->vendedor->apellidos??'').' '.($factura->vendedor->nombres??''),15,'..') }}</td>
        </tr>
                
        <tr>
            <td colspan="4"><strong>Documento: </strong>{{ $factura->referencia }}</td>
        </tr>
        <tr>
            <td colspan="4" style="border-color: transparent; border-bottom-color: black;"></td>
        </tr>
    </thead>


    @php($total=0)
    @php($descuento=0)
    <tbody>
        <tr>
            <th class="textoCentrado">CANTIDAD</td>
            <th class="textoCentrado">DETALLE</th>
            <th class="textoCentrado">V.UNITARIO</th>
            <th class="textoCentrado">V.TOTAL {{ $factura->total_factura }}</th>
        </tr>

        @foreach ($factura->facturaDetalles as $item)

        @php($v_total=round(($item->cantidad*$item->valor_unitario)-($item->cantidad*$item->valor_unitario)*($item->descuento/100),2))
        @php($descuento+=round(($item->cantidad*$item->valor_unitario)*($item->descuento/100),2))

                <tr>
                    <td class="textoCentrado" style="text-align: center;">{{ $item->cantidad }}</td>
                    <td class="textoCentrado">
                        <a href="{{ route('editarProducto',$item->producto->id) }}" class="text-primary">
                            {{ Str::limit($item->descripcion,110,'..') }}
                        </a>
                    </td>
                    <td class="textoCentrado" style="text-align: center;">{{ $item->valor_unitario }} </td>
                    <td class="textoCentrado" style="text-align: center;">{{ $v_total }}</td>
                </tr>


            @php($total+=$v_total)
        @endforeach
    </tbody>

    <tfoot>
        <tr >
            <td colspan="2" class="linea">
                
                    <span>
                        <strong>Forma de pago:</strong>
                        {{ $factura->forma_pago }}
                    </span><hr class="new3">
                
            </td>
            <td colspan="2">

                @php($valor_total=round($total,2))
                @php($subtotal= round(($valor_total/(( $factura->iva /100)+1)),2)  )
                @php($iva=round(($valor_total-$subtotal),2))

                SUB TOTAL {{ $factura->iva }} % <strong class="float-right" id="sub_total_factura">{{ $subtotal }}</strong><br>
                SUB TOTAL 0 % <strong class="float-right">0.00</strong><br>
                DESCUENTO <strong class="float-right">{{ $descuento }}</strong><br>
                SUB TOTAL <strong class="float-right">0.00</strong><br>
                IVA {{ $factura->iva }} % <strong class="float-right" id="iva_factura">{{ $iva }}</strong><br>
                VALOR TOTAL <strong class="float-right" id="total_factura">{{ $valor_total }}</strong><br>
                
            </td>
        </tr>
    </tfoot>
</table>