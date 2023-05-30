<?php

class preferenceController
{
    private $preferenceModel;

    public function __construct($preferenceModel)
    {
        $this->preferenceModel = $preferenceModel;
    }

    // Méthode pour traiter les préférences renseignées par l'utilisateur lors de la saisie d'un trajet
    public function processPreferencesAction($preferences)
    {
        // Appeler la méthode du modèle pour traiter les préférences
        $processedPreferences = $this->preferenceModel->processPreferences($preferences);

        // Autres actions à effectuer en fonction des préférences traitées
        // Par exemple, mettre à jour d'autres informations du trajet, afficher un message de confirmation, etc.

        // Rediriger ou renvoyer une réponse appropriée à l'utilisateur
    }
}
