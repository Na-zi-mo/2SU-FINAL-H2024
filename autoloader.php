<?php
register_autoloaders();

function register_autoloaders()
{
    spl_autoload_register('autoload_dao');
    spl_autoload_register('autoload_modeles');
    spl_autoload_register('autoload_vues');
    spl_autoload_register('autoload_controleurs');
}

function inclureFichier($fichier)
{
    if (is_readable($fichier))
    {
        require_once $fichier;
    }
}

function autoload_dao($class)
{
    $fichier = 'dao/' . $class . '.php';
    inclureFichier($fichier);
}

function autoload_modeles($class)
{
    $fichier = 'modeles/' . $class . '.php';
    inclureFichier($fichier);
}

function autoload_vues($class)
{
    $fichier = 'vues/' . $class . '.php';
    inclureFichier($fichier);
}

function autoload_controleurs($class)
{
    $fichier = 'controleurs/' . $class . '.php';
    inclureFichier($fichier);
}
