<?php
require_once 'trajetModel.php';

class TrajetController
{
    private $trajetModel;

    public function __construct()
    {
        $this->trajetModel = new TrajetModel();
    }

    // Méthode pour créer un nouveau trajet avec les étapes spécifiées
    public function createTrajet($etapes)
    {
        // Appeler la méthode correspondante du modèle pour créer le trajet
        $this->trajetModel->createTrajet($etapes);

        // Rediriger ou retourner la réponse appropriée
        // Par exemple, vous pouvez rediriger vers la vue de la carte avec le trajet affiché
    }
}