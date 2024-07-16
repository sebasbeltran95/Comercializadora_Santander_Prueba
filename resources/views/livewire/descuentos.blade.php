<div>
    @section('title', 'Descuentos')
    <div class="container-fluid">
        <div class="row text-center mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="display-1">Descuentos</h1>
                <button class="btn btn-primary rounded-circle " data-bs-toggle="modal"
                    data-bs-target="#modalCrearTipoDoc">+</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table  table-hover table-bordered">
                        <thead>
                            <th colspan="4">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Ingrese el No de descuento"
                                        wire:model="search">
                                </div>
                            </th>
                            <tr>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Descuento</th>
                                <th class="text-center">Fecha Ingreso</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->descuentos as $p)
                                <tr>
                                    <td class="text-center">{{ $product::find($p->producto_id)->nombre }}</td>
                                    <td class="text-center">{{ $p->descuento }}%</td>
                                    <td class="text-center">{{ $p->created_at }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm btn-warning"
                                                wire:click="datacliente({{ $p }})" data-bs-toggle="modal"
                                                data-bs-target="#Modaleditar"><i class="fas fa-user-edit"></i></button>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                wire:click="$emit('deletePost',{{ $p->id }})"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $this->descuentos->links() }}
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
                            <label class="@error('producto_id') text-danger @enderror">Producto</label>
                            <select class="form-select @error('producto_id') text-danger @enderror"
                                wire:model="producto_id">
                                <option value="">Seleccione una opción...</option>
                                @foreach ($produc as $pr)
                                    <option value="{{ $pr->id }}">{{ $pr->nombre }}</option>
                                @endforeach
                            </select>
                            <i class="text-danger">
                                @error('producto_id')
                                    {{ $message }}
                                @enderror
                            </i>
                        </div>
                        <div class="form-group mb-2">
                            <label class="@error('descuento') text-danger @enderror">Descuento</label>
                            <input type="number" class="form-control @error('descuento') text-danger @enderror"
                                wire:model="descuento">
                            <i class="text-danger">
                                @error('descuento')
                                    {{ $message }}
                                @enderror
                            </i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar
                            Descuento</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fin modal crear Cliente --}}


        {{--  editar   --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="Modaleditar" tabindex="-1" wire:ignore.self>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar Producto</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <select class="form-select" wire:model="producto_idx">
                                            <option value="">Seleccione una opción...</option>
                                            @foreach ($produc as $pr)
                                                <option value="{{ $pr->id }}">{{ $pr->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Descuento</label>
                                        <input type="number" class="form-control" wire:model="descuentox">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" wire:click="actualizar">Editar
                                        Producto</button>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  editar   --}}
    </div>
    @push('js')
        <script>
            Livewire.on('ok', msj => {
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
                        livewire.emitTo('descuentos', 'delete', postId);

                        Swal.fire({
                            title: "!Eliminado!",
                            text: "Se elimino el Descuento",
                            icon: "success"
                        });
                    }
                });
            });
        </script>
    @endpush
