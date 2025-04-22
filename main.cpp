#include <QCoreApplication>
#include <QDebug>
#include "databasehandler.h"

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    // Connexion à la base de données
    DatabaseHandler &db = DatabaseHandler::instance();
    if (!db.openDatabase()) {
        qCritical() << " Échec de l'ouverture de la base de données.";
        return -1;
    }
    qDebug() << " Connexion à la base de données réussie.";

    // Exemple d'ajout d'employés
    if (db.ajouterEmploye("Jules", "Jean", "Paul", "Médecin")) {
        qDebug() << " Employé Jules ajouté avec succès.";
    } else {
        qWarning() << " Échec de l'ajout de l'employé Jules.";
    }

    if (db.ajouterEmploye("Martin", "Alice", "Sophie", "Infirmier")) {
        qDebug() << "️ Employée Martin ajoutée avec succès.";
    } else {
        qWarning() << " Échec de l'ajout de l'employée Martin.";
    }

    // Mise à jour du mot de passe d'un utilisateur
    QVariantMap data;
    data["mot_de_passe"] = "1234"; //exemple mdp

    QString condition = "email='user@example.com'"; // Exemple email

        if (db.updateRecord("consultations", data, condition)) {
        qDebug() << " Mot de passe mis à jour avec succès pour l'utilisateur.";
    } else {
        qWarning() << " Erreur lors de la mise à jour du mot de passe.";
    }

    // Fermeture propre de la base de données
    db.closeDatabase();
    qDebug() << " Connexion à la base de données fermée.";

    return a.exec();
}
























/*#include "mainwindow.h"
#include <QApplication>
#include "database/databasehandler.h"  // Assurez-vous que le chemin est correct
#include <QDebug>


int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    MainWindow w;

    // Initialisation de la base de données
    DatabaseHandler& dbHandler = DatabaseHandler::instance();
    if (!dbHandler.initializeDatabase()) {
        qCritical() << "Échec de l'initialisation de la base de données!";
        return -1;
    }

    // Test 1: Ajout d'un utilisateur
    QVariantMap newUser;
    newUser["username"] = "testuser";
    newUser["password"] = "testpass123";
    newUser["email"] = "test@example.com";

    if (dbHandler.addRecord("users", newUser)) {
        qDebug() << "Utilisateur ajouté avec succès!";
    } else {
        qDebug() << "Échec de l'ajout de l'utilisateur";
    }

    // Test 2: Récupération des utilisateurs
    QList<QVariantMap> users = dbHandler.getRecords("users");
    qDebug() << "Liste des utilisateurs:";
    for (const QVariantMap &user : users) {
        qDebug() << "ID:" << user["id"]
                 << "Username:" << user["username"]
                 << "Email:" << user["email"];
    }

    // Test 3: Récupération d'un utilisateur spécifique
    QVariantMap user = dbHandler.getRecord("users", "username = 'testuser'");
    if (!user.isEmpty()) {
        qDebug() << "\nUtilisateur trouvé:";
        qDebug() << "ID:" << user["id"]
                 << "Username:" << user["username"]
                 << "Email:" << user["email"];
    } else {
        qDebug() << "Utilisateur non trouvé";
    }

    w.show();
    return a.exec();
}
*/
