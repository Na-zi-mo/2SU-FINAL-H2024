<?php
require_once 'autoloader.php';
require_once 'GestionnaireRoute.php';

const NOM_BD = "final";
const ADRESSE_HOTE_BD = "localhost";
const NOM_UTILISATEUR_BD = "etd";
const MDP_BD = "etd123";

$config = new ConfigDao(NOM_BD, NOM_UTILISATEUR_BD, MDP_BD, ADRESSE_HOTE_BD);

try
{
    $gestionnaireRoute = new GestionnaireRoute('DefautControleur', $config);
    $gestionnaireRoute->traiterRequeteHttp();
}
catch (Throwable $ex)
{
    // Idéalement, nous devrions indiquer un message "neutre et non alarmant" à l'utilisateur.
    // En même temps, nous devrions envoyer un courriel à l'administrateur du site web pour 
    // lui indiquer qu'une erreur importante est survenue. Également, nous pourrions écrire 
    // l'erreur dans un log
    echo 'Une erreur est survenue : ' . $ex->getMessage();
}
