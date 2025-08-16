<?php

class Proyecto {
    public $id, $nombre, $fecha_inicio, $estado, $responsable, $monto;

    public function __construct($id, $nombre, $fecha_inicio, $estado, $responsable, $monto) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha_inicio = $fecha_inicio;
        $this->estado = $estado;
        $this->responsable = $responsable;
        $this->monto = $monto;
    }

    public static function all() {
        $proyectos = $_SESSION['proyectos'] ?? [
            new Proyecto(1, "Proyecto Alpha", "2025-06-01", "En progreso", "Juan Pérez", 15000),
            new Proyecto(2, "Proyecto Beta", "2025-07-15", "Finalizado", "María López", 23000),
            new Proyecto(3, "Proyecto Gamma", "2025-08-01", "Pendiente", "Carlos Ruiz", 12000),
        ];
        $_SESSION['proyectos'] = $proyectos;
        return $proyectos;
    }

    public static function create($data) {
        $proyectos = self::all();
        $nuevoId = count($proyectos) + 1;
        $nuevo = new Proyecto($nuevoId, $data['nombre'], $data['fecha_inicio'], $data['estado'], $data['responsable'], $data['monto']);
        $_SESSION['proyectos'][] = $nuevo;
        return $nuevo;
    }
}
