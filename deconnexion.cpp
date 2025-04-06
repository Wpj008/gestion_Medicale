#include <iostream>
#include <string>

using namespace std;

// D�claration anticip�e
bool verifierConnexion(const string& nomUtilisateur, const string& motDePasse);

// Fonction pour simuler la d�connexion
void deconnecterUtilisateur() {
    cout << "Utilisateur d�connect�." << endl;
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
        cout << "Connexion r�ussie !" << endl;
    } else {
        cout << "�chec de la connexion. Veuillez r�essayer." << endl;
    }
}

// Fonction pour v�rifier les identifiants
bool verifierConnexion(const string& nomUtilisateur, const string& motDePasse) {
    return (nomUtilisateur == "admin" && motDePasse == "1234");
}

// Fonction principale pour g�rer le clic sur le bouton "D�connexion"
void onBoutonDeconnexionClic() {
    deconnecterUtilisateur();
    redirigerVersPageConnexion();
}

// Fonction main
int main() {
    string action;
    cout << "Voulez-vous vous d�connecter ? (oui/non) : ";
    cin >> action;

    if (action == "oui") {
        onBoutonDeconnexionClic();
    } else {
        cout << "D�connexion annul�e." << endl;
    }

    return 0;
}

