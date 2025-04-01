#include "mainwindow.h"
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
