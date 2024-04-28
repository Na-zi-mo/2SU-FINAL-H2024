<?php

function garderXnombreCaracteres($texte, $nombreCaracteres)
{
    if (strlen($texte) <= $nombreCaracteres)
    {
        return $texte;
    }
    
    return substr($texte, 0, $nombreCaracteres) . '...';
}