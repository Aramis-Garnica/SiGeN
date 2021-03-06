  <link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\PDFStyles_Flujo_Efectivo_Iluminacion.css">


<div align="right">
  <button class="btn btn-success" onclick="GuardarReporte()"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="30px" height="30px" alt="Agregar Producto al Recibo" style="filter: invert(100%)"><b >Guardar Reporte</b></button>
</div>


<table class="tab">
  <tr>
    <td class="tab-logo"><img height="100" width="300" src="..\Resources\Logos\Logo_ISA.png"></td>
    <td class="tab-datos"><b>ILUMINACION SUSTENTABLE AGS, S DE RL DE CV <br> <?php echo $mes." DE ".$anio ?></b></td>
    <td class="tab-datos"><b><label style="text-align: right;">Saldo Inicial (En Banco Mes Anterior)</label> <br>
       $<input type="text" id="saldo_mes_anterior"   value="<?php echo number_format($sal_ban_ant,2,'.',','); ?>"></b></td>
  </tr>
</table>

<table class="tab2">
  <head>
  <tr>
    <td colspan="10"><b>DEPÓSITOS</b></td>
  </tr>
  <th class="tab2-depositos">FECHA</th>
  <th class="tab2-depositos">REF</th>
  <th class="tab2-depositos">IMPORTE</th>
  <th class="tab2-depositos">SUBTOTAL</th>
  <th class="tab2-depositos">IVA</th>
  <th class="tab2-depositos">CLIENTE</th>
  <th class="tab2-depositos">CONCEPTO</th>
  <th class="tab2-depositos2">TOTALES DEPÓSITOS</th>
  <th class="tab2-depositos2">SUBTOTAL</th>
  <th class="tab2-depositos2">IVA</th>
  </head>
  <body>
    <?php  //Lista de Pagos de Proyectos
    $suma_importes=0;
    $saldo_final=0;
    $saldo_final+=$sal_ban_ant;
    $subtotal_depositos=0;
    $subtotal_retiros=0;
    $iva_depositos=0;
    $iva_retiros=0;
      foreach ($ingresos_venta_mov->result() as $row) {
        $suma_importes+=$row->venta_mov_monto;
        ?>
        <tr>
          <td class="tab2-lista" id="<?php echo "depositos_fecha_proy".$row->id_venta_mov;?>"><?php echo $row->venta_mov_fecha; ?></td>
          <td class="tab2-lista">
            <select id="<?php echo "depositos_ref_proy".$row->id_venta_mov;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
          <td class="tab2-lista" onchange="Iva_Cargo()" id="<?php echo "depositos_importe_proy".$row->id_venta_mov;?>"><?php echo number_format($row->venta_mov_monto, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_subtotal_proy".$row->id_venta_mov;?>"><?php echo number_format(($row->venta_mov_monto)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_iva_proy".$row->id_venta_mov;?>"><?php echo number_format(($row->venta_mov_monto/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_cliente_proy".$row->id_venta_mov;?>"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista" id="<?php echo "depositos_concepto_proy".$row->id_venta_mov;?>">Movimiento(Pagos) - <?php echo $row->venta_mov_comentario ?></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
        </tr>
    <?php
      }
     ?>
     
    <?php //Lista de Pagos de Anticipos
      $suma_anticipos=0;
      foreach ($ingresos_anticipos->result() as $row) {
        $suma_anticipos+=$row->pagos_anticipo_cantidad;
        ?>
        <tr>
          <td class="tab2-lista" id="<?php echo "depositos_fecha_anticipo".$row->id_pagos_anticipo;?>"><?php echo $row->pagos_anticipo_fecha; ?></td>
          <td class="tab2-lista">
            <select id="<?php echo "depositos_ref_anticipo".$row->id_pagos_anticipo;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
          <td class="tab2-lista" onchange="Iva_Cargo()" id="<?php echo "depositos_importe_anticipo".$row->id_pagos_anticipo;?>"><?php echo number_format($row->pagos_anticipo_cantidad, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_subtotal_anticipo".$row->id_pagos_anticipo;?>"><?php echo number_format(($row->pagos_anticipo_cantidad)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_iva_anticipo".$row->id_pagos_anticipo;?>"><?php echo number_format(($row->pagos_anticipo_cantidad/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_cliente_anticipo".$row->id_pagos_anticipo;?>"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista" id="<?php echo "depositos_concepto_anticipo".$row->id_pagos_anticipo;?>">Pago Anticipo - <?php echo $row->pagos_anticipo_coment ?></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
        </tr>
      <?php
      }
     ?>

         <?php //Lista de Pagos de SFV
      $suma_sfv=0;
      foreach ($ingresos_sfv->result() as $row) {
        $suma_sfv+=$row->lista_pago_sfv_total;
        ?>
        <tr>
          <td class="tab2-lista" id="<?php echo "depositos_fecha_sfv".$row->id_lista_pago_sfv;?>"><?php echo $row->lista_pago_sfv_fecha; ?></td>
          <td class="tab2-lista">
            <select id="<?php echo "depositos_ref_sfv".$row->id_lista_pago_sfv;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
          <td class="tab2-lista" onchange="Iva_Cargo()" id="<?php echo "depositos_importe_sfv".$row->id_lista_pago_sfv;?>"><?php echo number_format($row->lista_pago_sfv_total, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_subtota_sfv".$row->id_lista_pago_sfv;?>"><?php echo number_format(($row->lista_pago_sfv_total)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_iva_sfv".$row->id_lista_pago_sfv;?>"><?php echo number_format(($row->lista_pago_sfv_total/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_cliente_sfv".$row->id_lista_pago_sfv;?>"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista" id="<?php echo "depositos_concepto_sfv".$row->id_lista_pago_sfv;?>">Pago SFV - <?php echo $row->lista_pago_sfv_coment ?></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
        </tr>
      <?php
      }
     ?>

  </body>
  <?php 
    $total_depositos=($suma_importes+$suma_anticipos+$suma_sfv);
    $subtotal_depositos=($total_depositos)/1.16;
    $iva_depositos=$subtotal_depositos*0.16;
   ?>
  <tfoot>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="tab2-total" id="total_depositos">$<?php echo number_format($total_depositos, 2, '.', ',');?></td>
      <td class="tab2-total" id="subtotal_depositos">$<?php echo number_format($subtotal_depositos, 2, '.', ',');?></td>
      <td class="tab2-total" id="iva_depositos">$<?php echo number_format($iva_depositos, 2, '.', ',');?></td>
    </tr>
  </tfoot>
</table>

<table class="tab3">
  <head>
  <tr>
    <td colspan="10"><b>RETIROS</b></td>
  </tr>
  <th class="tab3-retiros">FECHA</th>
  <th class="tab3-retiros">REF</th>
  <th class="tab3-retiros">IMPORTE</th>
  <th class="tab3-retiros">SUBTOTAL</th>
  <th class="tab3-retiros">IVA</th>
  <th class="tab3-retiros">RETENCION IVA</th>
  <th class="tab3-retiros">RETENCION ISR</th>
  <th class="tab3-retiros">IEPS</th>
  <th class="tab3-retiros">DAP</th>
  <th class="tab3-retiros">CONCEPTO</th>
  <th class="tab3-retiros2">TOTALES RETIROS</th>
  <th class="tab3-retiros2">SUBTOTAL</th>
  <th class="tab3-retiros2">IVA</th>
  </head>
  <body>
   <?php  //Lista de Pagos de Proyectos
      $suma_gastos_venta=0;
      $suma_retencion_iva=0;
      
      foreach ($egresos_gasto_venta->result() as $row) {
        $suma_gastos_venta+=$row->gasto_venta_monto;
    ?>
    <tr>
      <td class="tab3-lista" id="<?php echo "retiros_fecha_gastos".$row->id_gasto_venta;?>"><?php echo $row->gasto_venta_fecha_pago; ?></td>
      <td class="tab3-lista">
            <select id="<?php echo "retiros_ref".$row->id_gasto_venta;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
      </td>
      <td class="tab3-lista" id="<?php echo "retiros_importe_gastos".$row->id_gasto_venta;?>"><?php echo number_format($row->gasto_venta_monto, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_subtotal_gastos".$row->id_gasto_venta;?>"><?php echo number_format($row->gasto_venta_monto/1.16, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_iva_gastos".$row->id_gasto_venta;?>"><?php echo number_format($row->gasto_venta_monto/1.16*0.16, 2, '.', ',');?></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_iva_".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_isr_".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_ieps_".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_dap_".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista" id="<?php echo "retiros_concepto".$row->id_gasto_venta;?>">Costo Venta - <?php echo $row->gasto_venta_concepto ?></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
    </tr>
      <?php
      }
     ?>


   <?php  //Lista de Pagos de Caja Chica
      
      foreach ($egresos_caja_chica->result() as $row) {
        $suma_gastos_venta+=$row->lista_caja_chica_gasto;
    ?>
    <tr>
      <td class="tab3-lista" id="<?php echo "retiros_fecha_caja_chica".$row->id_lista_caja_chica;?>"><?php echo $row->lista_caja_chica_fecha; ?></td>
      <td class="tab3-lista">
            <select id="<?php echo "retiros_ref_caja_chica".$row->id_lista_caja_chica;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
      </td>
      <td class="tab3-lista" id="<?php echo "retiros_importe_caja_chica".$row->id_lista_caja_chica;?>"><?php echo number_format($row->lista_caja_chica_gasto, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_subtotal_caja_chica".$row->id_lista_caja_chica;?>"><?php echo number_format($row->lista_caja_chica_gasto/1.16, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_iva_caja_chica".$row->id_lista_caja_chica;?>"><?php echo number_format($row->lista_caja_chica_gasto/1.16*0.16, 2, '.', ',');?></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_iva_caja_chica".$row->id_lista_caja_chica;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_isr_caja_chica".$row->id_lista_caja_chica;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_ieps_caja_chica".$row->id_lista_caja_chica;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_dap_caja_chica".$row->id_lista_caja_chica;?>"></td>
      <td class="tab3-lista" id="<?php echo "retiros_concepto_caja_chica".$row->id_lista_caja_chica;?>">Caja Chica - <?php echo $row->lista_caja_chica_concepto ?></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
    </tr>
      <?php
      }
     ?>


   <?php  //Lista de Pagos de Viaticos
      
      foreach ($egresos_viatico->result() as $row) {
        $suma_gastos_venta+=$row->lista_viatico_importe;
    ?>
    <tr>
      <td class="tab3-lista" id="<?php echo "retiros_fecha_viaticos".$row->id_lista_viatico;?>"><?php echo $row->lista_viatico_fecha; ?></td>
      <td class="tab3-lista">
            <select id="<?php echo "retiros_ref_viaticos".$row->id_lista_viatico;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
      </td>
      <td class="tab3-lista" id="<?php echo "retiros_importe_viaticos".$row->id_lista_viatico;?>"><?php echo number_format($row->lista_viatico_importe, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_subtotal_viaticos".$row->id_lista_viatico;?>"><?php echo number_format($row->lista_viatico_importe/1.16, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_iva_viaticos".$row->id_lista_viatico;?>"><?php echo number_format($row->lista_viatico_importe/1.16*0.16, 2, '.', ',');?></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_iva_viaticos".$row->id_lista_viatico;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_isr_viaticos".$row->id_lista_viatico;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_ieps_viaticos".$row->id_lista_viatico;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_dap_viaticos".$row->id_lista_viatico;?>"></td>
      <td class="tab3-lista" id="<?php echo "retiros_concepto_viaticos".$row->id_lista_viatico;?>">Viaticos - <?php echo $row->lista_viatico_concepto ?></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
    </tr>
      <?php
      }
     ?>


   <?php  //Lista de Pagos de Otros Gastos
      
      foreach ($egresos_otros_gastos->result() as $row) {
        $suma_gastos_venta+=$row->saldo;
    ?>
    <tr>
      <td class="tab3-lista" id="<?php echo "retiros_fecha_otros_gastos".$row->id_OGasto;?>"><?php echo $row->fecha_pago_factura; ?></td>
      <td class="tab3-lista">
            <select id="<?php echo "retiros_ref_otros_gastos".$row->id_OGasto;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
      </td>
      <td class="tab3-lista" id="<?php echo "retiros_importe_otros_gastos".$row->id_OGasto;?>"><?php echo number_format($row->saldo, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_subtotal_otros_gastos".$row->id_OGasto;?>"><?php echo number_format($row->saldo/1.16, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_iva_otros_gastos".$row->id_OGasto;?>"><?php echo number_format($row->saldo/1.16*0.16, 2, '.', ',');?></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_iva_otros_gastos".$row->id_OGasto;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_isr_otros_gastos".$row->id_OGasto;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_ieps_otros_gastos".$row->id_OGasto;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_dap_otros_gastos".$row->id_OGasto;?>"></td>
      <td class="tab3-lista" id="<?php echo "retiros_concepto_otros_gastos".$row->id_OGasto;?>">Otros Gastos - <?php echo $row->concepto ?></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
    </tr>
      <?php
      }
     ?>







    <tr>
      <td colspan="5"></td>
      <td class="tab3-lista2" ><input type="text" disabled="true" id="suma_retencion_iva" size="6"></td>
    </tr>
  </body>
  <?php 
    $total_retiros=$suma_gastos_venta;
    $subtotal_retiros=$total_retiros/1.16;
    $iva_retiros=$subtotal_retiros*0.16;
   ?>
  <tfoot>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="tab3-total" id="<?php echo "total_retiros";?>">$<?php echo number_format($total_retiros, 2, '.', ',');?></td>
      <td class="tab3-total" id="<?php echo "subtotal_retiros";?>">$<?php echo number_format($subtotal_retiros, 2, '.', ',');?></td>
      <td class="tab3-total" id="<?php echo "iva_retiros";?>">$<?php echo number_format($iva_retiros, 2, '.', ',');?></td>
    </tr>
    <tr>
      <td class="tab3-lista2" colspan="13"><hr style=";border-color:white;border-width: 4px; width: 100%"></td>

    </tr>
    <?php 
      $saldo_final=$total_depositos+$suma_gastos_venta;
     ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="tab3-lista2"><b>SALDO FINAL</b></td>
      <td ><input class="tab3-final" type="text" disabled="true" id="saldo_final" value="$<?php echo number_format($saldo_final, 2, '.', ',');?>"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
    </tr>
    <tr>
      <td><input hidden="true" id="saldo_final_sin_formato" type="number" value="<?php echo $saldo_final ?>"></td>
    </tr>
    <?php 
      $iva_neteo=($iva_depositos-$iva_retiros);
    ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="tab3-lista2"></td>
      <td></td>
      <td class="tab3-lista2"><b>NETEO DE IVA</b></td>
      <td class="tab3-lista2"><input class="tab3-final" type="text" disabled="true" id="neto_iva" value="<?php echo number_format($iva_neteo, 2, '.', ',');?>"></td>
    </tr>
    <?php 
      if ($iva_neteo>0.01) {
        $tipo_iva="IVA A CARGO";
      }else{
        $tipo_iva="IVA A FAVOR";
      }
      if ($iva_neteo<0) {
        $iva_cargo=$iva_neteo*-1;
      }else{
        $iva_cargo=$iva_neteo;
      }
     ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="tab3-lista2"></td>
      <td></td>
      <td class="tab3-lista2" id="tipo_iva"><b><?php echo $tipo_iva ?></b></td>
      <td class="tab3-lista2"><input class="tab3-final" type="text" disabled="true" id="cargo_iva" value="<?php echo number_format($iva_cargo, 2, '.', ',');?>"></td>
    </tr>
    <tr>
      <td class="tab3-lista2" colspan="4"></td>
      <td class="tab3-lista2" colspan="9"><hr style=";border-color:black;border-width: 4px; width: 100%"></td>
    </tr>
    <tr>
      <td colspan="9"></td>
      <td>IVA RETENCION</td>
      <td colspan="2"></td>
      <td style="text-align: center" id="iva_retencion">0.00</td>
    </tr>
    <tr>
      <td colspan="9"></td>
      <td>IVA TOTAL A CARGO</td>
      <td colspan="2"></td>
      <td style="text-align: center" id="iva_total_cargo"></td>
    </tr>
    <tr>
      <td colspan="9"></td>
      <td>(-) IVA A FAVOR PERIODOS ANTERIORES</td>
      <td colspan="2"></td>
      <td style="text-align: center"><input type="text" onblur="SeparaMiles(this.id)" id="iva_favor_periodos_anteriores"></td>
    </tr>
    <tr>
      <td colspan="9"></td>
      <td bgcolor="#FFFF00">IVA NETO A CARGO</td>
      <td bgcolor="#FFFF00" colspan="2"></td>
      <td bgcolor="#FFFF00" style="text-align: center"><input type="text" id="iva_neto_cargo" disabled="true"></td>
    </tr>
    <tr>
      <td colspan="13"><br><br></td>
    </tr>
  </tfoot>
</table>


<script type="text/javascript">
 $(document).ready(function(){

  //alert("entró iva cargo");
   if($("#tipo_iva").text()=="IVA A CARGO"){
        $val1=$("#cargo_iva").val();
        $val2=$("#iva_retencion").text();


        $val1=$val1.replace(/\,/g, '');
        $val2=$val2.replace(/\,/g, '');
        $suma=parseFloat($val1)+parseFloat($val2);
        $suma=$suma.toLocaleString("en");
        $("#iva_total_cargo").text(parseFloat($suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      }else{
        $val2=$("#iva_retencion").text();
        $val2=$val2.replace(/\,/g, '');
         $suma=parseFloat($val2);
         $("#iva_total_cargo").text(parseFloat($suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      }
      $iva_cargo_total=$("#iva_total_cargo").text();
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores=0;
      }

      //$iva_favor_periodos_anteriores=$iva_favor_periodos_anteriores.replace(/\,/g, '');
      $iva_cargo_total=$iva_cargo_total.replace(/\,/g, '');
      $suma=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
      $suma=$suma.toLocaleString("en");
    $("#iva_neto_cargo").val(parseFloat($suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  $("#suma_retencion_iva").change(function(){
      if($("#tipo_iva").text()=="IVA A CARGO"){
        $val1=$("#cargo_iva").val();
        $val2=$("#iva_retencion").text();

        $suma=parseFloat($val1)+parseFloat($val2);
        $("#iva_total_cargo").text($suma.toFixed(2));
      }else{
        $val2=$("#iva_retencion").text();
         $suma=pparseFloat($val2);
        $("#iva_total_cargo").text($suma.toFixed(2));
      }
  });

  //Función para actualizar el saldo final
  $('#saldo_mes_anterior').change(function(){
    var saldo=$('#saldo_mes_anterior').val();
    if (saldo==""||isNaN(saldo)) {
      saldo=0;
     }
    var saldo_total=$("#saldo_final_sin_formato").val();
    var saldo2=parseFloat(saldo_total)+parseFloat(saldo); 
    //alert(new Intl.NumberFormat("en-US").format(saldo2));
    //saldo2=saldo2.toFixed(2);
    var resultado=saldo2.toLocaleString("en");
    $("#saldo_final").val("$"+parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });

  });

 document.getElementById("saldo_mes_anterior").onblur =function (){
 if(this.value==""){
  this.value=0;
 }    
    this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function SeparaMiles($id){
  valor=$("#"+$id).val();
    valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
  if(valor==""||isNaN(valor)){
    //alert("entro");
    valor=0.00;
    //alert(valor);
  }
  var resultado=valor.toLocaleString("en");
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  identifica_id=$id.split("_"); //retiros_reten_iva_

  if(identifica_id[2]=="iva"){
    var retencion_iva_suma=0;
    //alert("1.- "+retencion_iva_suma);

    //recorremos los inputs de retiros_reten_iva para sumarlos; estos son los de egresos de Gasto Venta
    <?php
    foreach ($egresos_gasto_venta->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_".$row->id_gasto_venta;?>").val();
      if(valor_a_sumar==""){
        valor_a_sumar="0,000.00";
      }
      //alert("valor a sumar: "+valor_a_sumar);
      sumando=valor_a_sumar.replace(/\./g, '');
      retencion_iva_suma+=parseFloat(sumando.replace(/\,/g, ''));
      //alert("suma total: "+(retencion_iva_suma)/100);
     <?php
      }
     ?>


   
    <?php
    foreach ($egresos_caja_chica->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_caja_chica".$row->id_lista_caja_chica;?>").val();
      if(valor_a_sumar==""||isNaN(valor)){//Verificamos si el dato es vacio o no numérico lo cambiamos por ceros
        valor_a_sumar="0,000.00";
      }
      sumando=valor_a_sumar.replace(/\./g, ''); //eliminamos los puntos decimales
      retencion_iva_suma+=parseFloat(sumando.replace(/\,/g, '')); //eliminamos las comas y realizamos la suma
    <?php
    }
    ?>

    //recorremos los inputs de retiros_reten_iva para sumarlos; estos son los de egresos de Caja Chica
    <?php
    foreach ($egresos_viatico->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_viaticos".$row->id_lista_viatico;?>").val();
      if(valor_a_sumar==""||isNaN(valor)){//Verificamos si el dato es vacio o no numérico lo cambiamos por ceros
        valor_a_sumar="0,000.00";
      }
      sumando=valor_a_sumar.replace(/\./g, ''); //eliminamos los puntos decimales
      retencion_iva_suma+=parseFloat(sumando.replace(/\,/g, '')); //eliminamos las comas y realizamos la suma
    <?php
    }
    ?>


    //recorremos los inputs de retiros_reten_iva para sumarlos; estos son los de egresos de Caja Chica
    <?php
    foreach ($egresos_otros_gastos->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_otros_gastos".$row->id_OGasto;?>").val();
      if(valor_a_sumar==""||isNaN(valor)){//Verificamos si el dato es vacio o no numérico lo cambiamos por ceros
        valor_a_sumar="0,000.00";
      }
      sumando=valor_a_sumar.replace(/\./g, ''); //eliminamos los puntos decimales
      retencion_iva_suma+=parseFloat(sumando.replace(/\,/g, '')); //eliminamos las comas y realizamos la suma
    <?php
    }
    ?>



     retencion_iva_suma=retencion_iva_suma/100;
     retencion_iva_suma=retencion_iva_suma.toLocaleString("en");
     $("#suma_retencion_iva").val(parseFloat(retencion_iva_suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
           //alert("entra 1 retencion iva"+retencion_iva_suma);
     if(parseFloat(retencion_iva_suma.replace(/\,/g, ''))>0.01){
      //alert("entra retencion iva"+retencion_iva_suma);
        $("#iva_retencion").text(parseFloat(retencion_iva_suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
     }else{
      $("#iva_retencion").text("0.00");
     }

       //alert("entró iva cargo");
   if($("#tipo_iva").text()=="IVA A CARGO"){

        $val1=$("#cargo_iva").val();
        $val2=$("#iva_retencion").text();

        $val1=$val1.replace(/\,/g, '');
        $val2=$val2.replace(/\,/g, '');
        $suma=parseFloat($val1)+parseFloat($val2);
        $suma=$suma.toLocaleString("en");
        $("#iva_total_cargo").text(parseFloat($suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      }else{

        $val2=$("#iva_retencion").text();
         $suma=parseFloat($val2);
        $("#iva_total_cargo").text($suma.toFixed(2));
      }

      $iva_cargo_total=$("#iva_total_cargo").text();
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores="0,000.00";
      }

      $iva_favor_periodos_anteriores=$iva_favor_periodos_anteriores.replace(/\,/g, '');
      $iva_cargo_total=$iva_cargo_total.replace(/\,/g, '');
      //alert("iva favor "+$iva_favor_periodos_anteriores+" iva cargo "+$iva_cargo_total);
      $suma_cargo=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
      //alert("1 "+$suma_cargo);
      $suma_cargo=$suma_cargo.toLocaleString("en");
    $("#iva_neto_cargo").val(parseFloat($suma_cargo.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }

  if(identifica_id[1]=="favor"){  //iva_favor_periodos_anteriores
      $iva_cargo_total=$("#iva_total_cargo").text();
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores="0,000.00";
      }
      $iva_favor_periodos_anteriores=$iva_favor_periodos_anteriores.replace(/\,/g, '');
      $iva_cargo_total=$iva_cargo_total.replace(/\,/g, '');
      $suma=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
      $suma=$suma.toLocaleString("en");
    $("#iva_neto_cargo").val(parseFloat($suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }
}

function Separa_Miles2($id){ //Funcion para separar la cantidad ingresada con indicadores en miles
  valor=$("#"+$id).val();//obtenemos el id del input del cual se ingresa un valor
  valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
  if(valor==""||isNaN(valor)){//verificamos si el valor ingresado es vacío o si es una cadena no numérica para cambiarlo por ceros
    valor=0.00;
  }
//cambiamos la cadena a tipo String con el formato de indioma Inglés ya que este contiene semapador de miles con comas
  var resultado=valor.toLocaleString("en");
  //Regresamos el valor de la variable al input pero ya con un formato de separador de miles y 2 decimales
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));


  identifica_id=$id.split("_"); //retiros_reten_iva_ Separamos el String del id recibido en un arreglo

if(identifica_id[2]=="iva"){ //Verificamos si en la posicion 2 del arreglo el string es igual a "iva", para hacer la suma de la retencion de iva
  retencion_iva_suma=0; //iniciamos la variable para la suma de retencion de iva
    <?php
    //recorremos los inputs de retiros_reten_iva para sumarlos; estos son los de egresos de gasto venta
    foreach ($egresos_gasto_venta->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_".$row->id_gasto_venta;?>").val();
      if(valor_a_sumar==""||isNaN(valor)){//Verificamos si el dato es vacio o no numérico lo cambiamos por ceros
        valor_a_sumar="0,000.00";
      }
      sumando=valor_a_sumar.replace(/\./g, ''); //eliminamos los puntos decimales
      retencion_iva_suma+=parseFloat(sumando.replace(/\,/g, '')); //eliminamos las comas y realizamos la suma
    <?php
    }
    ?>

    //recorremos los inputs de retiros_reten_iva para sumarlos; estos son los de egresos de Caja Chica
    <?php
    foreach ($egresos_caja_chica->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_caja_chica".$row->id_lista_caja_chica;?>").val();
      if(valor_a_sumar==""||isNaN(valor)){//Verificamos si el dato es vacio o no numérico lo cambiamos por ceros
        valor_a_sumar="0,000.00";
      }
      sumando=valor_a_sumar.replace(/\./g, ''); //eliminamos los puntos decimales
      retencion_iva_suma+=parseFloat(sumando.replace(/\,/g, '')); //eliminamos las comas y realizamos la suma
    <?php
    }
    ?>




    retencion_iva_suma=retencion_iva_suma/100; //dividimos entre 100 para determinar los puntos decimales
    //cambiamos la cadena a tipo String con el formato de indioma Inglés ya que este contiene semapador de miles con comas
    retencion_iva_suma=retencion_iva_suma.toLocaleString("en");
    //Ingresamos el valor de la suma de retención de iva al input de retencion de iva suma, con el formato de separador de miles y 2 decimales
    $("#suma_retencion_iva").val(parseFloat(retencion_iva_suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

    //Verificamos si la suma de retención de iva es mayo a 0.01, ingresamos el valor de la suma al input de iva_retencion
    if(parseFloat(retencion_iva_suma.replace(/\,/g, ''))>0.01){
      $("#iva_retencion").text(parseFloat(retencion_iva_suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }else{
      $("#iva_retencion").text("0.00");
    }


  }//Fin del if(identifica_id[2]=="iva")
}

function GuardarReporte(){        //Función para guardar los datos del flujo de efectivo

  //alert("Opción de guardado aun está en desarrollo. Disculpe las demoras"); 

  //Obtenemos los datos generales del reporte
  mes="<?php echo $mes ?>";

  anio="<?php echo $anio ?>";

  saldo_inicial=$("#saldo_mes_anterior").val().replace(/\,/g, '');

  saldo_final=$("#saldo_final").val().split("$");
  saldo_final[1]=saldo_final[1].replace(/\,/g, '');
  
  total_depositos=$("#total_depositos").text().split("$");
  total_depositos[1]=total_depositos[1].replace(/\,/g, '');

  subtotal_depositos=$("#subtotal_depositos").text().split("$");
  subtotal_depositos[1]=subtotal_depositos[1].replace(/\,/g, '');
  
  iva_depositos=$("#iva_depositos").text().split("$");
  iva_depositos[1]=iva_depositos[1].replace(/\,/g, '');
  
  total_retiros=$("#total_retiros").text().split("$");
  total_retiros[1]=total_retiros[1].replace(/\,/g, '');
  
  subtotal_retiros=$("#subtotal_retiros").text().split("$");
  subtotal_retiros[1]=subtotal_retiros[1].replace(/\,/g, '');
  
  iva_retiros=$("#iva_retiros").text().split("$");
  iva_retiros[1]=iva_retiros[1].replace(/\,/g, '');
  
  neto_iva=$("#neto_iva").val().replace(/\,/g, '');
  
  tipo_iva=$("#tipo_iva").text();

  iva_cargo_favor=$("#cargo_iva").val().replace(/\,/g, '');

  iva_retencion=$("#iva_retencion").text().replace(/\,/g, '');
  iva_total_cargo=$("#iva_total_cargo").text().replace(/\,/g, '');
  iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val().replace(/\,/g, '');
  if(iva_favor_periodos_anteriores==""){
    iva_favor_periodos_anteriores=0.00;
  }
  iva_neto_cargo=$("#iva_neto_cargo").val().replace(/\,/g, '');

  //alert(saldo_inicial);
  //alert(mes+" "+anio+" "+saldo_inicial+" "+saldo_final[1]+" "+total_depositos[1]+" "+subtotal_depositos[1]+" "+iva_depositos[1]);
  //alert(total_retiros[1]+" "+subtotal_retiros[1]+" "+iva_retiros[1]);
  //alert(neto_iva+" "+tipo_iva+" "+iva_cargo_favor+" "+iva_retencion+" "+iva_total_cargo+" "+iva_favor_periodos_anteriores+" "+iva_neto_cargo);

  $.ajax({
    type:"POST",
    url:"<?php echo base_url();?>Iluminacion/Save_Reporte_flujo",
    data:{mes:mes, anio:anio, saldo_ini:saldo_inicial, saldo_fin:saldo_final[1], total_depositos:total_depositos[1], subtotal_depositos:subtotal_depositos[1], iva_depositos:iva_depositos[1], total_retiros:total_retiros[1], subtotal_retiros:subtotal_retiros[1], iva_retiros:iva_retiros[1], neto_iva:neto_iva, tipo_iva:tipo_iva, iva_cargo_favor:iva_cargo_favor, iva_retencion:iva_retencion, iva_total_cargo:iva_total_cargo, iva_favor_periodos_anteriores:iva_favor_periodos_anteriores, iva_neto_cargo:iva_neto_cargo},
    success:function(result){
      //alert(result);
    if(result){
      if (result=="existe") {
        alert('Registro Actualizado');
      }else{
        alert('Registro Guardado');
      }
      
    }else{
        alert('Falló el servidor. Registro no actualizado');
      }
    }
  });



  /*
  depositos_flujo_fecha
  depositos_flujo_ref
  depositos_flujo_importe
  depositos_flujo_subtotal
  depositos_flujo_iva
  depositos_flujo_cliente
  depositos_flujo_concepto
  */  

/*
    <?php
    foreach ($ingresos_venta_mov->result() as $row) {
      $depositos = array('fecha' => $depositos_fecha_proy.$row->id_venta_mov);


      }      
     ?> 

     valor=<?php echo $depositos[0]->fecha ?>;
     alert(valor);


*/

  //alert(mes+anio+" "+saldo_inicial+" "+saldo_final[1]+" tdep: "+total_depositos[1]+"iva "+iva_depositos[1]+" "+subtotal_depositos[1]+" tret: "+total_retiros[1]+" subt: "+subtotal_retiros[1]+" ivaret: "+iva_retiros[1]);
  //alert(neto_iva+" "+tipo_iva+" "+iva_cargo_favor+" "+iva_retencion+" "+iva_total_cargo+" "+iva_favor_periodos_anteriores+" "+iva_neto_cargo);
   
}




</script>
