<div>
    @section('title', 'Ventas')
    <div class="container-fluid">
       <div class="row text-center mb-3">
           <div class="col-md-12 d-flex justify-content-between align-items-center">
               <h1 class="display-1">Ventas</h1>
               <button class="btn btn-primary rounded-circle " data-bs-toggle="modal"
                   data-bs-target="#modalCrearTipoDoc">+</button>
           </div>
       </div>
       <div class="row">
           <div class="col-12">
               <div class="table-responsive">
                   <table class="table  table-hover table-bordered">
                       <thead>
                           <th colspan="7">
                               <div class="input-group input-group-sm">
                                   <input type="text" class="form-control"
                                   placeholder="Ingrese el No de Stock"
                                   wire:model="search">
                               </div>
                           </th>
                           <tr>
                               <th class="text-center">Producto</th>
                               <th class="text-center">Cliente</th>
                               <th class="text-center">Stock</th>
                               <th class="text-center">Descuento</th>
                               <th class="text-center">Valor Unitario</th>
                               <th class="text-center">Valor Total</th>
                               <th class="text-center">Fecha Ingreso</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse ($this->ventas as $p)
                               <tr>
                                    <td class="text-center">{{ $product::find($p->id_producto)->nombre}}</td>
                                    <td class="text-center">{{ $clientt::find($p->id_cliente)->nombre_completo}}</td>
                                    <td class="text-center">{{ $p->n_stock }}</td>
                                    <td class="text-center">{{ $p->descuento }}%</td>
                                    <td class="text-center">{{ number_format($p->valor_unitario) }}</td>
                                    <td class="text-center">{{ number_format($p->valor_total) }}</td>
                                    <td class="text-center">{{ $p->created_at }}</td>
                               </tr>
                           @empty
                               <tr>
                                   <td colspan="7" class="text-center">No hay registros</td>
                               </tr>
                           @endforelse
                       </tbody>
                   </table>
                   {{ $this->ventas->links() }}
               </div>
           </div>
       </div>
 
       {{-- Modal crear Cliente --}}
       <div class="modal fade" id="modalCrearTipoDoc" tabindex="-1" wire:ignore.self>
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Crear Producto</h4>
                   </div>
                   <div class="modal-body">
                        <div class="form-group">
                            <label class="@error('id_producto') text-danger @enderror">Producto</label>
                            <select class="form-select @error('id_producto') text-danger @enderror"
                                wire:model="id_producto">
                                <option value="">Seleccione una opción...</option>
                                @foreach ($produc as $pr)
                                    <option value="{{ $pr->id }}">{{ $pr->nombre }}</option>
                                @endforeach
                            </select>
                            <i class="text-danger">
                                @error('id_producto')
                                    {{ $message }}
                                @enderror
                            </i>
                        </div>
                        <div class="form-group">
                            <label class="@error('id_cliente') text-danger @enderror">Cliente</label>
                            <select class="form-select @error('id_cliente') text-danger @enderror"
                                wire:model="id_cliente">
                                <option value="">Seleccione una opción...</option>
                                @foreach ($client as $cl)
                                    <option value="{{ $cl->id }}">{{ $cl->nombre_completo }}</option>
                                @endforeach
                            </select>
                            <i class="text-danger">
                                @error('id_cliente')
                                    {{ $message }}
                                @enderror
                            </i>
                        </div>
                         <div class="form-group mb-2">
                             <label class="@error('n_stock') text-danger @enderror">Stock</label>
                             <input type="number" class="form-control @error('n_stock') text-danger @enderror" wire:model="n_stock">
                             <i class="text-danger">
                                 @error('n_stock') {{ $message }} @enderror
                             </i>
                         </div>
                   </div>
                   <div class="modal-footer">
                       <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar Producto</button>
                       <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                   </div>
               </div>
           </div>
       </div>
       {{-- Fin modal crear Cliente --}}
</div>
@push('js')
<script>
    Livewire.on('ok', msj =>{
        Swal.fire(
            msj[0],
            msj[1],
            msj[2],
        )
    });
    livewire.on('deletePost', postId => {
        Swal.fire({
            title: "¿Estas Seguro?",
            text: "¿Desea Eliminar este registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "SI"
        }).then((result) => {
            if (result.isConfirmed) {
                livewire.emitTo('ventas', 'delete', postId);

                Swal.fire({
                title: "!Eliminado!",
                text: "Se elimino la Venta",
                icon: "success"
                });
            }
        });
    });
</script>
@endpush