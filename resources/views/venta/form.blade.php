<?php
use App\Models\Product;
$products = Product::pluck('Nombre', 'id')->all();
$precios = Product::pluck('Precio_venta', 'id')->all(); // Agrega esta línea para obtener los precios de venta de los productos
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha', 'Fecha') }}</label>
    <div>
        <x-flat-picker name="fecha" :value="$venta->fecha" />
        {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Fecha de la venta.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label for="metodo_pago" class="form-label">Método de pago</label>
    <select id="metodo_pago" class="form-select" name="metodo_pago">
        <option value="efectivo">Efectivo</option>
        <option value="tarjeta">Tarjeta</option>
        <option value="qr">QR</option>
    </select>
    <div class="invalid-feedback">
        Por favor seleccione un método de pago.
    </div>
    <small class="form-hin...
        $('#pagoEfectivoDiv').hide();t">Seleccione cómo desea realizar el pago.</small>
</div>

<!-- División para pago en efectivo, incluyendo los campos para billetes y monedas -->
<div id="pagoEfectivoDiv" style="display:none;">
    <h5>Billetes recibidos:</h5>
    <?php foreach ([200, 100, 50, 20, 10] as $billete) : ?>
    <div class="form-group mb-2">
        <label for="billete<?= $billete ?>" class="form-label">Billetes de Bs<?= $billete ?></label>
        <input type="number" class="form-control" id="billete<?= $billete ?>" name="billetes[<?= $billete ?>]"
            data-value="<?= $billete ?>" placeholder="Cantidad de billetes de Bs<?= $billete ?>">
    </div>
    <?php endforeach; ?>

    <h5>Monedas recibidas:</h5>
    <?php foreach ([5, 2, 1, 0.50] as $moneda) : ?>
    <div class="form-group mb-2">
        <label for="moneda<?= str_replace('.', '', $moneda) ?>" class="form-label">Monedas de Bs<?= $moneda ?></label>
        <input type="number" class="form-control" id="moneda<?= str_replace('.', '', $moneda) ?>"
            name="monedas[<?= $moneda ?>]" data-value="<?= $moneda ?>"
            placeholder="Cantidad de monedas de Bs<?= $moneda ?>">
    </div>
    <?php endforeach; ?>

    <div class="form-group mb-3">
        <label for="cambio" class="form-label">Cambio</label>
        <input type="text" class="form-control" id="cambio" name="cambio" placeholder="Cambio a devolver">
        <small class="form-hint">Ingrese el cambio a devolver al cliente.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Nombre', 'Nombre') }}</label>
    <div>
        {{ Form::text('Nombre', $venta->cliente, ['class' => 'form-control' . ($errors->has('cliente') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('cliente', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Nombre .</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('NIT', 'NIT') }}</label>
    <div>
        {{ Form::text('NIT', null, ['class' => 'form-control' . ($errors->has('NIT') ? ' is-invalid' : ''), 'placeholder' => 'NIT']) }}
        {!! $errors->first('NIT', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingrese el NIT del cliente.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('CI', 'Cédula de Identidad') }}</label>
    <div>
        {{ Form::text('CI', null, ['class' => 'form-control' . ($errors->has('CI') ? ' is-invalid' : ''), 'placeholder' => 'CI']) }}
        {!! $errors->first('CI', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingrese la cédula de identidad del cliente.</small>
    </div>
</div>


<div class="form-group mb-3">
    <label class="form-label">Total del Carrito</label>
    <input type="text" class="form-control" id="inputTotalCarrito" name="total" readonly>

</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="#" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#metodo_pago').change(function() {
            var metodoPago = $(this).val();
            if (metodoPago === 'efectivo') {
                $('#pagoEfectivoDiv').show();
                calcularCambio(); 
            } else {
                $('#pagoEfectivoDiv').hide();
            }
        });
    
        $('#pagoEfectivoDiv').find('input[type="number"]').on('input', calcularCambio);
    
        function calcularCambio() {
            var totalEfectivo = 0;
            $('#pagoEfectivoDiv input[type="number"]').each(function() {
                var valor = parseFloat($(this).data('value')); 
                var cantidad = parseInt($(this).val()) || 0;
                totalEfectivo += valor * cantidad;
            });
    
            var totalCarrito = parseFloat($('#inputTotalCarrito').val()) || 0;
    
            var cambio = totalEfectivo - totalCarrito;
    
            $('#cambio').val(cambio.toFixed(2));
        }
        
        $('#metodo_pago').trigger('change'); 
    });
    </script>
    









<!-- Tu código HTML sigue aquí -->
