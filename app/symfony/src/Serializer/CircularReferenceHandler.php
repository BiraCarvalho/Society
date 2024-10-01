<?php
namespace App\Serializer;

class CircularReferenceHandler
{
    public function __invoke($object)
    {
        // Retorna um identificador único (por exemplo, o ID da entidade)
        return $object->getId();
    }
}
