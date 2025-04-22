#include <iostream>
#include <string>

using namespace std;

// Déclaration anticipée
bool verifierConnexion(const string& nomUtilisateur, const string& motDePasse);

// Fonction pour simuler la déconnexion
void deconnecterUtilisateur() {
    cout << "Utilisateur déconnecté." << endl;
}

// Fonction pour simuler la redirection vers la page de connexion
void redirigerVersPageConnexion() {
    cout << "Redirection vers la page de connexion..." << endl;
    afficherFormulaireConnexion(); // On appelle ici le formulaire de connexion
}

// Fonction d'affichage du formulaire de connexion
void afficherFormulaireConnexion() {
    cout << "Affichage du formulaire de connexion..." << endl;

    string nomUtilisateur, motDePasse;
    cout << "Nom d'utilisateur : ";
    cin >> nomUtilisateur;

    cout << "Mot de passe : ";
    cin >> motDePasse;

    if (verifierConnexion(nomUtilisateur, motDePasse)) {
        cout << "Connexion réussie !" << endl;
    } else {
        cout << "Échec de la connexion. Veuillez réessayer." << endl;
    }
}

// Fonction pour vérifier les identifiants
bool verifierConnexion(const string& nomUtilisateur, const string& motDePasse) {
    return (nomUtilisateur == "admin" && motDePasse == "1234");
}

// Fonction principale pour gérer le clic sur le bouton "Déconnexion"
void onBoutonDeconnexionClic() {
    deconnecterUtilisateur();
    redirigerVersPageConnexion();
}

// Fonction main
int main() {
    string action;
    cout << "Voulez-vous vous déconnecter ? (oui/non) : ";
    cin >> action;

    if (action == "oui") {
        onBoutonDeconnexionClic();
    } else {
        cout << "Déconnexion annulée." << endl;
    }

    return 0;
}

