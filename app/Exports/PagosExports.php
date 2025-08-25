<?php

namespace App\Exports;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PagosExports implements FromCollection, WithHeadings
{
    protected $tipo;
    protected $inicio;
    protected $fin;

    public function __construct($tipo, $inicio, $fin)
    {
        $this->tipo = $tipo;
        $this->inicio = $inicio;
        $this->fin = $fin;
    }

    public function collection()
    {
         $query = Pago::join('estudiantes', 'pagos.estudiante_documento', '=', 'estudiantes.documento');
        //$query = Pago::query();

        if ($this->tipo) {
            $query->where('tipo', $this->tipo);
        }

        if ($this->inicio && $this->fin) {
            $query->whereBetween('pagos.fecha_pago', [$this->inicio, $this->fin]);
        }

         return $query->select(
            'pagos.id',
            \DB::raw("CONCAT(estudiantes.nombre_1, ' ', estudiantes.apellido_1) as nombre_completo"),
            'pagos.estudiante_documento',
            'pagos.tipo',
            'pagos.valor',
            'pagos.fecha_pago',
            'pagos.estado'
        )->get();
        //return $query->get([
           // 'id',
           // 'estudiante_documento',
            //'tipo',
            //'valor',
            //'fecha_pago',
            //'estado'
        //]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre Completo',
            'Documento Estudiante',
            'Tipo de Pago',
            'Valor',
            'Fecha de Pago',
            'Estado'
        ];
    }
}
